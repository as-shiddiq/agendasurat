<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sppd extends CI_Controller {

		public function __construct()
	       {
	  			parent::__construct();
					$this->load->model('m_sppd');
		}
	function index(){
		if(isset($_POST['simpan'])){
			$id_sppd = $this->input->post('id_sppd');
			$id_pegawai = $this->input->post('id_pegawai');
			$nomor_agenda = $this->input->post('nomor_agenda');
			$tujuan = $this->input->post('tujuan');
			$lama_penugasan = $this->input->post('lama_penugasan');
			$ex=explode(' s/d ',$lama_penugasan);
			$tanggal_mulai = date_ymd($ex[0]);
			$tanggal_sampai = date_ymd($ex[1]);
			$keperluan = $this->input->post('keperluan');
			$nomor_sppd = $this->input->post('nomor_sppd');
			$keterangan = $this->input->post('keterangan');
			$tanggal_simpan = date_ymd($this->input->post('tanggal_simpan'));

		//cek nama Instansi
		$cek=$this->db->get_where('instansi',array("nama_instansi"=>$tujuan));
		if($cek->num_rows()==0){
			$this->load->model('m_instansi');
			$this->m_instansi->insert(array('nama_instansi'=>$tujuan),$where);

		}
		$data=array(
			'id_sppd' => $id_sppd,
			'id_pegawai' => $id_pegawai,
			'nomor_agenda' => tahun_perencanaan().$nomor_agenda,
			'tujuan' => $tujuan,
			'tanggal_mulai' => $tanggal_mulai,
			'tanggal_sampai' => $tanggal_sampai,
			'keperluan' => $keperluan,
			'keterangan' => $keterangan,
			'nomor_sppd' => $nomor_sppd,
			'tanggal_simpan' => $tanggal_simpan,
		);

			$where=array(
				'id_sppd'=>$id_sppd,
			);
			if(post('parameter')=='tambah'){
				$this->m_sppd->insert($data,$where);
			}
			else{
				$this->m_sppd->update($data,$where);
			}
			redirect('sppd');
		}
		elseif(isset($_GET['hapus'])){
			$where=array(
      				'id_sppd' => $this->input->get('id'),
			);
			$this->m_sppd->delete($where);
                        redirect('sppd');

		}
		else{
			$get_data=$this->m_sppd->get_data();
			$template = array(
				'table_open' => '<table border="0" cellpadding="4" cellspacing="0" class="table table-bordered table-hover" id="table">',
			);
			$this->table->set_template($template);
			$this->table->set_heading('No','nama pegawai','nomor agenda','tujuan','lama penugasan','keperluan','keterangan','tanggal simpan','Aksi');
			$i=1;
			foreach($get_data->result() as $row){

				if($row->tanggal_sampai==$row->tanggal_mulai){
					$lama_penugasan=standar_tanggal($row->tanggal_mulai).'<b> (1 hari)</b>';
				}
				else{
					$hitung=strtotime($row->tanggal_sampai)-strtotime($row->tanggal_mulai);
					$hari = floor($hitung/(60*60*24))+1;

					$lama_penugasan=standar_tanggal($row->tanggal_mulai).' s/d '.standar_tanggal($row->tanggal_sampai).' <b>('.$hari.' hari)</b>';
				}
				$this->table->add_row(array('data'=>$i,'width'=>'50px','align'=>'center'),$row->nama_pegawai,substr($row->nomor_agenda,4),$row->tujuan,$lama_penugasan,$row->keperluan,$row->keterangan,standar_tanggal($row->tanggal_simpan),array('data'=>'<button data-toggle="dropdown" class="btn btn-info dropdown-toggle" type="button"><i class="fa fa-gear"></i> Pilih <span class="caret"></span></button>
               <ul class="dropdown-menu">
                 <li><a href="'.site_url('sppd?ubah&id='.$row->id_sppd).'"><i class="fa fa-edit"></i> Ubah</a></li>
                 <li><a href="'.site_url('sppd?hapus&id='.$row->id_sppd).'" onclick="return confirm(\'Yakin menghapus data?\')"><i class="fa fa-trash-o"></i> Hapus</a></li>
               </ul>','width'=>'10px','align'=>'center'));
				$i++;
			}
			$databody['table']=$this->table->generate();
			$data['title']='Data Agenda SPPD';
			$data['body']=$this->load->view('v_sppd',$databody,true);
			$this->load->view('html/html',$data);
		}
	}
}
