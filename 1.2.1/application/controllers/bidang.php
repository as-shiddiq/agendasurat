<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Bidang extends CI_Controller {

		public function __construct()
	       {
	  			parent::__construct();
					$this->load->model('m_bidang');
		}
	function index(){
		if(isset($_POST['simpan'])){
    			$id_bidang = $this->input->post('id_bidang');
			$nama_bidang = $this->input->post('nama_bidang');
			$singkatan_bidang = $this->input->post('singkatan_bidang');
			$kode_surat = $this->input->post('kode_surat');
			$id_parent_bidang = $this->input->post('id_parent_bidang');

		$data=array(
			'id_bidang' => $id_bidang,
			'nama_bidang' => $nama_bidang,
			'singkatan_bidang' => $singkatan_bidang,
			'kode_surat' => $kode_surat,
			'id_parent_bidang' => $id_parent_bidang,
		);

			$where=array(
				'id_bidang'=>$id_bidang,
			);
			if(post('parameter')=='tambah'){
				$this->m_bidang->insert($data,$where);
			}
			else{
				$this->m_bidang->update($data,$where);
			}
			redirect('bidang');
		}
		elseif(isset($_GET['hapus'])){
			$where=array(
      				'id_bidang' => $this->input->get('id'),
			);
			$this->m_bidang->delete($where);
                        redirect('bidang');

		}
		else{
			$get_data=$this->m_bidang->get_data();
			$template = array(
				'table_open' => '<table border="0" cellpadding="4" cellspacing="0" class="table table-bordered table-hover" id="table">',
			);
			$this->table->set_template($template);
			$this->table->set_heading('No','nama bidang','singkatan bidang','kode surat','parent bidang','Aksi');
			$i=1;
			foreach($get_data->result() as $row){
				$this->table->add_row(array('data'=>$i,'width'=>'50px','align'=>'center'),$row->nama_bidang,$row->singkatan_bidang,$row->kode_surat,$row->nama_parent,array('data'=>'<button data-toggle="dropdown" class="btn btn-info dropdown-toggle" type="button"><i class="fa fa-gear"></i> Pilih <span class="caret"></span></button>
               <ul class="dropdown-menu">
                 <li><a href="'.site_url('bidang?ubah&id='.$row->id_bidang).'"><i class="fa fa-edit"></i> Ubah</a></li>
                 <li><a href="'.site_url('bidang?hapus&id='.$row->id_bidang).'" onclick="return confirm(\'Yakin menghapus data?\')"><i class="fa fa-trash-o"></i> Hapus</a></li>
               </ul>','width'=>'10px','align'=>'center'));
				$i++;
			}
			$databody['table']=$this->table->generate();
			$data['title']='Data Master Bidang';
			$data['body']=$this->load->view('v_bidang',$databody,true);
			$this->load->view('html/html',$data);
		}
	}
}
