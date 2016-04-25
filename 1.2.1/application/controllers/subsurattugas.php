<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Subsurattugas extends CI_Controller {

		public function __construct()
	       {
	  			parent::__construct();
					$this->load->model('m_subsurattugas');
		}
		function index(){
			$this->id();
		}
	function id($a=''){
		if($a==''){
			redirect("surattugas");
		}
		if(isset($_POST['simpan'])){
			$id_sub_surat_tugas = $this->input->post('id_sub_surat_tugas');
			$id_surat_tugas = $this->input->post('id_surat_tugas');
			$id_pegawai = $this->input->post('id_pegawai');

		$data=array(
			'id_sub_surat_tugas' => $id_sub_surat_tugas,
			'id_surat_tugas' => $id_surat_tugas,
			'id_pegawai' => $id_pegawai,
		);

			$where=array(
				'id_sub_surat_tugas'=>$id_sub_surat_tugas,
			);
			if(post('parameter')=='tambah'){
				$this->m_subsurattugas->insert($data,$where);
			}
			else{
				$this->m_subsurattugas->update($data,$where);
			}
			redirect('surattugas');
		}
		elseif(isset($_GET['hapus'])){
			$where=array(
      				'id_sub_surat_tugas' => $this->input->get('id'),
			);
			$this->m_subsurattugas->delete($where);
      redirect('surattugas');

		}
		else{
			$get_data=$this->m_subsurattugas->get_data();
			$template = array(
				'table_open' => '<table border="0" cellpadding="4" cellspacing="0" class="table table-bordered table-hover" id="table">',
			);
			$this->table->set_template($template);
			$this->table->set_heading('No','id surat tugas','id pegawai','Aksi');
			$i=1;
			foreach($get_data->result() as $row){
				$this->table->add_row(array('data'=>$i,'width'=>'50px','align'=>'center'),$row->id_surat_tugas,$row->id_pegawai,array('data'=>'<button data-toggle="dropdown" class="btn btn-info dropdown-toggle" type="button"><i class="fa fa-gear"></i> Pilih <span class="caret"></span></button>
               <ul class="dropdown-menu">
                 <li><a href="'.site_url('subsurattugas?ubah&id='.$row->id_sub_surat_tugas).'"><i class="fa fa-edit"></i> Ubah</a></li>
                 <li><a href="'.site_url('subsurattugas?hapus&id='.$row->id_sub_surat_tugas).'" onclick="return confirm(\'Yakin menghapus data?\')"><i class="fa fa-trash-o"></i> Hapus</a></li>
               </ul>','width'=>'10px','align'=>'center'));
				$i++;
			}
			$databody['id_surat_tugas']=$a;
			$databody['table']=$this->table->generate();
			$data['title']='Data Penugasan Untuk';
			$data['body']=$this->load->view('v_subsurattugas',$databody,true);
			$this->load->view('html/html',$data);
		}
	}
}
