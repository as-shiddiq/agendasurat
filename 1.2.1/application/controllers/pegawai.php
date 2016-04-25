<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pegawai extends CI_Controller {

		public function __construct()
	       {
	  			parent::__construct();
					$this->load->model('m_pegawai');
		}
	function index(){
		if(isset($_POST['simpan'])){
			$id_pegawai = $this->input->post('id_pegawai');
			$id_jabatan = $this->input->post('id_jabatan');
			$nip = $this->input->post('nip');
			$nama_pegawai = $this->input->post('nama_pegawai');
			$status = $this->input->post('status');
			$level=($nip=="")?"PTT":"PNS";

		$data=array(
      			'id_pegawai' => $id_pegawai,
			'id_jabatan' => $id_jabatan,
			'nip' => $nip,
			'nama_pegawai' => $nama_pegawai,
			'status' => $status,
			'level' => $level,
		);

			$where=array(
				'id_pegawai'=>$id_pegawai,
			);
			if(post('parameter')=='tambah'){
				$this->m_pegawai->insert($data,$where);
			}
			else{
				$this->m_pegawai->update($data,$where);
			}
			redirect('pegawai');
		}
		elseif(isset($_GET['hapus'])){
			$where=array(
      				'id_pegawai' => $this->input->get('id'),
			);
			$this->m_pegawai->delete($where);
                        redirect('pegawai');

		}
		else{
			$get_data=$this->m_pegawai->get_data();
			$template = array(
				'table_open' => '<table border="0" cellpadding="4" cellspacing="0" class="table table-bordered table-hover" id="table">',
			);
			$this->table->set_template($template);
			$this->table->set_heading('No','nip','nama pegawai','nama jabatan','status','level','Aksi');
			$i=1;
			foreach($get_data->result() as $row){
				$this->table->add_row(array('data'=>$i,'width'=>'50px','align'=>'center'),$row->nip,$row->nama_pegawai,$row->nama_jabatan,$row->status,$row->level,array('data'=>'<button data-toggle="dropdown" class="btn btn-info dropdown-toggle" type="button"><i class="fa fa-gear"></i> Pilih <span class="caret"></span></button>
               <ul class="dropdown-menu">
                 <li><a href="'.site_url('pegawai?ubah&id='.$row->id_pegawai).'"><i class="fa fa-edit"></i> Ubah</a></li>
                 <li><a href="'.site_url('pegawai?hapus&id='.$row->id_pegawai).'" onclick="return confirm(\'Yakin menghapus data?\')"><i class="fa fa-trash-o"></i> Hapus</a></li>
               </ul>','width'=>'10px','align'=>'center'));
				$i++;
			}
			$databody['table']=$this->table->generate();
			$data['title']='Data Master Pegawai';
			$data['body']=$this->load->view('v_pegawai',$databody,true);
			$this->load->view('html/html',$data);
		}
	}
}
