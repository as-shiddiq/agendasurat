<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Telaahanstaf extends CI_Controller {

		public function __construct()
	       {
	  			parent::__construct();
					$this->load->model('m_telaahanstaf');
		}
	function index(){
		if(isset($_POST['simpan'])){
			$id_telaahan_staf = $this->input->post('id_telaahan_staf');
			$nomor_agenda = $this->input->post('nomor_agenda');
			$tujuan = $this->input->post('tujuan');
			$tanggal_surat = date_ymd($this->input->post('tanggal_surat'));
			$perihal = $this->input->post('perihal');
			$nomor_surat = $this->input->post('nomor_surat');
			$tanggal_simpan = date_ymd($this->input->post('tanggal_simpan'));

		$data=array(
			'id_telaahan_staf' => $id_telaahan_staf,
			'nomor_agenda' => tahun_perencanaan().$nomor_agenda,
			'tujuan' => $tujuan,
			'tanggal_surat' => $tanggal_surat,
			'perihal' => $perihal,
			'nomor_surat' => $nomor_surat,
			'tanggal_simpan' => $tanggal_simpan,
		);

			$where=array(
				'id_telaahan_staf'=>$id_telaahan_staf,
			);
			if(post('parameter')=='tambah'){
				$this->m_telaahanstaf->insert($data,$where);
			}
			else{
				$this->m_telaahanstaf->update($data,$where);
			}
			redirect('telaahanstaf');
		}
		elseif(isset($_GET['hapus'])){
			$where=array(
      				'id_telaahan_staf' => $this->input->get('id'),
			);
			$this->m_telaahanstaf->delete($where);
                        redirect('telaahanstaf');

		}
		else{
			$get_data=$this->m_telaahanstaf->get_data();
			$template = array(
				'table_open' => '<table border="0" cellpadding="4" cellspacing="0" class="table table-bordered table-hover" id="table">',
			);
			$this->table->set_template($template);
			$this->table->set_heading('No','nomor agenda','tujuan','tanggal surat','perihal','nomor surat','tanggal simpan','Aksi');
			$i=1;
			foreach($get_data->result() as $row){
				$this->table->add_row(array('data'=>$i,'width'=>'50px','align'=>'center'),substr($row->nomor_agenda,4),$row->tujuan,standar_tanggal($row->tanggal_surat),$row->perihal,$row->nomor_surat,standar_tanggal($row->tanggal_simpan),array('data'=>'<button data-toggle="dropdown" class="btn btn-info dropdown-toggle" type="button"><i class="fa fa-gear"></i> Pilih <span class="caret"></span></button>
               <ul class="dropdown-menu">
                 <li><a href="'.site_url('telaahanstaf?ubah&id='.$row->id_telaahan_staf).'"><i class="fa fa-edit"></i> Ubah</a></li>
                 <li><a href="'.site_url('telaahanstaf?hapus&id='.$row->id_telaahan_staf).'" onclick="return confirm(\'Yakin menghapus data?\')"><i class="fa fa-trash-o"></i> Hapus</a></li>
               </ul>','width'=>'10px','align'=>'center'));
				$i++;
			}
			$databody['table']=$this->table->generate();
			$data['title']='Data Agenda Telaahan Staf';
			$data['body']=$this->load->view('v_telaahanstaf',$databody,true);
			$this->load->view('html/html',$data);
		}
	}
}
