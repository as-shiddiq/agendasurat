<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Suratkeluar extends CI_Controller {

		public function __construct()
	       {
	  			parent::__construct();
					$this->load->model('m_suratkeluar');
		}
	function index(){
		if(isset($_POST['simpan'])){
			$id_surat_keluar = $this->input->post('id_surat_keluar');
			$nomor_agenda = $this->input->post('nomor_agenda');
			$tujuan = $this->input->post('tujuan');
			$tanggal_surat = date_ymd($this->input->post('tanggal_surat'));
			$perihal = $this->input->post('perihal');
			$nomor_surat = $this->input->post('nomor_surat');
			$tanggal_simpan = date_ymd($this->input->post('tanggal_simpan'));

		$data=array(
			'id_surat_keluar' => $id_surat_keluar,
			'nomor_agenda' => tahun_perencanaan().$nomor_agenda,
			'tujuan' => $tujuan,
			'tanggal_surat' => $tanggal_surat,
			'perihal' => $perihal,
			'nomor_surat' => $nomor_surat,
			'tanggal_simpan' => $tanggal_simpan,
		);

			$where=array(
				'id_surat_keluar'=>$id_surat_keluar,
			);
			if(post('parameter')=='tambah'){
				$this->m_suratkeluar->insert($data,$where);
			}
			else{
				$this->m_suratkeluar->update($data,$where);
			}
			redirect('suratkeluar');
		}
		elseif(isset($_GET['hapus'])){
			$where=array(
      				'id_surat_keluar' => $this->input->get('id'),
			);
			$this->m_suratkeluar->delete($where);
                        redirect('suratkeluar');

		}
		else{
			$get_data=$this->m_suratkeluar->get_data();
			$template = array(
				'table_open' => '<table border="0" cellpadding="4" cellspacing="0" class="table table-bordered table-hover" id="table">',
			);
			$this->table->set_template($template);
			$this->table->set_heading('No','nomor agenda','tujuan','tanggal surat','perihal','nomor surat','tanggal simpan','Aksi');
			$i=1;
			foreach($get_data->result() as $row){
				$this->table->add_row(array('data'=>$i,'width'=>'50px','align'=>'center'),substr($row->nomor_agenda,4),$row->tujuan,standar_tanggal($row->tanggal_surat),$row->perihal,$row->nomor_surat,standar_tanggal($row->tanggal_simpan),array('data'=>'<button data-toggle="dropdown" class="btn btn-info dropdown-toggle" type="button"><i class="fa fa-gear"></i> Pilih <span class="caret"></span></button>
               <ul class="dropdown-menu">
                 <li><a href="'.site_url('suratkeluar?ubah&id='.$row->id_surat_keluar).'"><i class="fa fa-edit"></i> Ubah</a></li>
                 <li><a href="'.site_url('suratkeluar?hapus&id='.$row->id_surat_keluar).'" onclick="return confirm(\'Yakin menghapus data?\')"><i class="fa fa-trash-o"></i> Hapus</a></li>
               </ul>','width'=>'10px','align'=>'center'));
				$i++;
			}
			$databody['table']=$this->table->generate();
			$data['title']='Data Agenda Surat Keluar';
			$data['body']=$this->load->view('v_suratkeluar',$databody,true);
			$this->load->view('html/html',$data);
		}
	}
}
