<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Jabatan extends CI_Controller {

		public function __construct()
	       {
	  			parent::__construct();
					$this->load->model('m_jabatan');
		}
	function index(){
		if(isset($_POST['simpan'])){
			$id_jabatan = $this->input->post('id_jabatan');
			$id_bidang = $this->input->post('id_bidang');
			$nama_jabatan = $this->input->post('nama_jabatan');
			$id_parent_jabatan = ($this->input->post('id_parent_jabatan')=="")?null:$this->input->post('id_parent_jabatan');
			$level = $this->input->post('level');
			$kouta = $this->input->post('kouta');

		$data=array(
			'id_jabatan' => $id_jabatan,
			'id_bidang' => $id_bidang,
			'nama_jabatan' => $nama_jabatan,
			'id_parent_jabatan' => $id_parent_jabatan,
			'level' => $level,
			'kouta' => $kouta,
		);

			$where=array(
				'id_jabatan'=>$id_jabatan,
			);
			if(post('parameter')=='tambah'){
				$this->m_jabatan->insert($data,$where);
			}
			else{
				$this->m_jabatan->update($data,$where);
			}
			redirect('jabatan');
		}
		elseif(isset($_GET['hapus'])){
			$where=array(
      				'id_jabatan' => $this->input->get('id'),
			);
			$this->m_jabatan->delete($where);
                        redirect('jabatan');

		}
		else{
			$get_data=$this->m_jabatan->get_data();
			$template = array(
				'table_open' => '<table border="0" cellpadding="4" cellspacing="0" class="table table-bordered table-hover" id="table">',
			);
			$this->table->set_template($template);
			$this->table->set_heading('No','nama bidang','nama jabatan','parent jabatan','level','Kouta','Aksi');
			$i=1;
			foreach($get_data->result() as $row){
				$this->table->add_row(array('data'=>$i,'width'=>'50px','align'=>'center'),$row->nama_bidang,$row->nama_jabatan,$row->nama_parent_jabatan,$row->level,$row->kouta,array('data'=>'<button data-toggle="dropdown" class="btn btn-info dropdown-toggle" type="button"><i class="fa fa-gear"></i> Pilih <span class="caret"></span></button>
               <ul class="dropdown-menu">
                 <li><a href="'.site_url('jabatan?ubah&id='.$row->id_jabatan).'"><i class="fa fa-edit"></i> Ubah</a></li>
                 <li><a href="'.site_url('jabatan?hapus&id='.$row->id_jabatan).'" onclick="return confirm(\'Yakin menghapus data?\')"><i class="fa fa-trash-o"></i> Hapus</a></li>
               </ul>','width'=>'10px','align'=>'center'));
				$i++;
			}
			$databody['table']=$this->table->generate();
			$data['title']='Data Master Jabatan';
			$data['body']=$this->load->view('v_jabatan',$databody,true);
			$this->load->view('html/html',$data);
		}
	}
}
