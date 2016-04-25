<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class pengguna extends CI_Controller {

		public function __construct()
	       {
	  			parent::__construct();
					$this->load->model('m_pengguna');


		}
	function index(){
		if(isset($_POST['simpan'])){
		$id_pengguna=$this->input->post('id_pengguna');
		$nama_pengguna=$this->input->post('nama_pengguna');
		$password=$this->input->post('password');
		$def=$this->input->post('def');
		$level=$this->input->post('level');

		//cek nama pengguna
		if($def!=$nama_pengguna){
			$cek=$this->db->get_where("pengguna",array("nama_pengguna"=>$nama_pengguna));
			if($cek->num_rows()>0){
				$this->session->set_flashdata('info',info_danger(icon('times').' Gagal Disimpan nama pengguna : <b>'.$nama_pengguna.'</b> sudah digunakan'));
				redirect("pengguna");
			}
		}

		$data=array(
			'id_pengguna'=>$id_pengguna,
			'nama_pengguna'=>$nama_pengguna,
			'password'=>$password,
			'level'=>$level
		);

			$where=array(
				'id_pengguna'=>$this->input->post('id_pengguna'),
			);
			if(post('parameter')=='tambah'){
				$this->m_pengguna->insert($data,$where);
			}
			else{
			$where2=array(
				'nama_pengguna'=>$this->input->post('def'),
			);
				$this->m_pengguna->update($data,$where,$where2);
			}
			redirect('pengguna');
		}
		elseif(isset($_GET['hapus'])){
			$where=array(
				'id_pengguna'=>$this->input->get('id'),
			);
			$this->m_pengguna->delete($where);
			redirect('pengguna');
		}
		else{
			$get_data=$this->m_pengguna->get_data();
			$template = array(
				'table_open' => '<table border="0" cellpadding="4" cellspacing="0" class="table table-bordered table-hover" id="table">',
			);
			$this->table->set_template($template);
			$this->table->set_heading('No.','Nama pengguna','Password','Level','Aksi');
			$i=1;
			foreach($get_data->result() as $row){
				$password=($this->session->userdata('level')=='superadmin')?$row->password:'******';
				$password=($this->session->userdata('id_pengguna')==$row->id_pengguna)?$row->password:$password;
				$this->table->add_row(array('data'=>$i,'width'=>'10px','align'=>'center'),$row->nama_pengguna,$password,$row->level,array('data'=>'<button data-toggle="dropdown" class="btn btn-info dropdown-toggle" type="button"><i class="fa fa-gear"></i> Pilih <span class="caret"></span></button>
               <ul class="dropdown-menu">
                 <li><a href="'.site_url('pengguna?ubah&id='.$row->id_pengguna).'"><i class="fa fa-edit"></i> Ubah</a></li>
                 <li><a href="'.site_url('pengguna?hapus&id='.$row->id_pengguna).'" onclick="return confirm(\'Yakin menghapus data?\')"><i class="fa fa-trash-o"></i> Hapus</a></li>
               </ul>','width'=>'10px','align'=>'center'));
				$i++;
			}
			$databody['table']=$this->table->generate();
			$data['title']='pengguna';
			$data['body']=$this->load->view('v_pengguna',$databody,true);
			$this->load->view('html/html',$data);
		}
	}
}
