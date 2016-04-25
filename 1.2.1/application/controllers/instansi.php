<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Instansi extends CI_Controller {

		public function __construct()
	       {
	  			parent::__construct();
					$this->load->model('m_instansi');
		}
	function index(){
		if(isset($_POST['simpan'])){
    			$id_instansi = $this->input->post('id_instansi');
			$nama_instansi = $this->input->post('nama_instansi');

		$data=array(
      			'id_instansi' => $id_instansi,
			'nama_instansi' => $nama_instansi,
		);

			$where=array(
				'id_instansi'=>$id_instansi,
			);
			if(post('parameter')=='tambah'){
				$this->m_instansi->insert($data,$where);
			}
			else{
				$this->m_instansi->update($data,$where);
			}
			redirect('instansi');
		}
		elseif(isset($_GET['hapus'])){
			$where=array(
      				'id_instansi' => $this->input->get('id'),
			);
			$this->m_instansi->delete($where);
      redirect('instansi');

		}
		else{
			$get_data=$this->m_instansi->get_data();
			$template = array(
				'table_open' => '<table border="0" cellpadding="4" cellspacing="0" class="table table-bordered table-hover" id="table">',
			);
			$this->table->set_template($template);
			$this->table->set_heading('No','nama instansi','Aksi');
			$i=1;
			foreach($get_data->result() as $row){
				$this->table->add_row(array('data'=>$i,'width'=>'50px','align'=>'center'),$row->nama_instansi,array('data'=>'<button data-toggle="dropdown" class="btn btn-info dropdown-toggle" type="button"><i class="fa fa-gear"></i> Pilih <span class="caret"></span></button>
               <ul class="dropdown-menu">
                 <li><a href="'.site_url('instansi?ubah&id='.$row->id_instansi).'"><i class="fa fa-edit"></i> Ubah</a></li>
                 <li><a href="'.site_url('instansi?hapus&id='.$row->id_instansi).'" onclick="return confirm(\'Yakin menghapus data?\')"><i class="fa fa-trash-o"></i> Hapus</a></li>
               </ul>','width'=>'10px','align'=>'center'));
				$i++;
			}
			$databody['table']=$this->table->generate();
			$data['title']='Data Master Instansi';
			$data['body']=$this->load->view('v_instansi',$databody,true);
			$this->load->view('html/html',$data);
		}
	}
	function ajax(){
		if($this->input->get('term')){
				$this->db->like(array('nama_instansi'=>$this->input->get('term')));
				$get=$this->db->get('instansi');
				if($get->num_rows>0){
					foreach ($get->result() as $row) {
						$res[]='"'.$row->nama_instansi.'"';
					}
					$imp=implode(',',$res);
					echo '['.$imp.']';
				}
		}
	}
}
