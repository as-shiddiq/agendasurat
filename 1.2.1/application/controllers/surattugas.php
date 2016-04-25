<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Surattugas extends CI_Controller {

		public function __construct()
	       {
	  			parent::__construct();
					$this->load->model('m_surattugas');
					$this->load->model('m_subsurattugas');
		}
	function index(){
		if(isset($_POST['simpan'])){
			$id_surat_tugas = $this->input->post('id_surat_tugas');
			$nomor_agenda = $this->input->post('nomor_agenda');
			$tujuan = $this->input->post('tujuan');
			$tanggal_berlaku = $this->input->post('tanggal_berlaku');
			$ex=explode(' s/d ',$tanggal_berlaku);
			$tanggal_mulai=date_ymd($ex[0]);
			$tanggal_sampai=date_ymd($ex[1]);
			$keperluan = $this->input->post('keperluan');
			$nomor_surat = $this->input->post('nomor_surat');
			$tanggal_simpan = date_ymd($this->input->post('tanggal_simpan'));
			$tanggal_surat = date_ymd($this->input->post('tanggal_surat'));

			//cek nama Instansi
			$cek=$this->db->get_where('instansi',array("nama_instansi"=>$tujuan));
			if($cek->num_rows()==0){
				$this->load->model('m_instansi');
				$this->m_instansi->insert(array('nama_instansi'=>$tujuan),$where);

			}
		$data=array(
			'id_surat_tugas' => $id_surat_tugas,
			'nomor_agenda' => tahun_perencanaan().$nomor_agenda,
			'tujuan' => $tujuan,
			'tanggal_mulai' => $tanggal_mulai,
			'tanggal_sampai' => $tanggal_sampai,
			'keperluan' => $keperluan,
			'nomor_surat' => $nomor_surat,
			'tanggal_simpan' => $tanggal_simpan,
			'tanggal_surat'=>$tanggal_surat
		);

			$where=array(
				'id_surat_tugas'=>$id_surat_tugas,
			);
			if(post('parameter')=='tambah'){
				$this->m_surattugas->insert($data,$where);
			}
			else{
				$this->m_surattugas->update($data,$where);
			}
			redirect('surattugas');
		}
		elseif(isset($_GET['hapus'])){
			$where=array(
      				'id_surat_tugas' => $this->input->get('id'),
			);
			$this->m_surattugas->delete($where);
      redirect('surattugas');

		}
		else{
			$get_data=$this->m_surattugas->get_data();
			$template = array(
				'table_open' => '<table border="0" cellpadding="4" cellspacing="0" class="table table-bordered table-hover" id="table">',
			);
			$this->table->set_template($template);
			$this->table->set_heading('No','nomor agenda','tujuan','lama penugasan','keperluan','nomor surat','tanggal surat','Ditugaskan kepada','tanggal simpan','Aksi');
			$i=1;
			foreach($get_data->result() as $row){
				$subsurattugas='';
				$getsubsurattugas=$this->m_subsurattugas->get_data($row->id_surat_tugas);
				if($getsubsurattugas->num_rows()>0){
					foreach ($getsubsurattugas->result() as $subsurattugasrow) {
						$subsurattugas.='- '.$subsurattugasrow->nama_pegawai.' <a href="'.site_url('subsurattugas/id/'.$row->id_surat_tugas.'?hapus&id='.$subsurattugasrow->id_sub_surat_tugas).'" class="btn btn-xs btn-danger" onclick="return confirm(\'Yakin menghapus data?\')"><i class="fa fa-trash-o"></i></a><br>';
					}
				}
				else{
					$subsurattugas='<i style="color:red">Belum ditentukan</i>';
				}

				if($row->tanggal_sampai==$row->tanggal_mulai){
					$tanggal_berlaku=standar_tanggal($row->tanggal_mulai).'<b> (1 hari)</b>';
				}
				else{
					$hitung=strtotime($row->tanggal_sampai)-strtotime($row->tanggal_mulai);
					$hari = floor($hitung/(60*60*24))+1;

					$tanggal_berlaku=standar_tanggal($row->tanggal_mulai).' s/d '.standar_tanggal($row->tanggal_sampai).' <b>('.$hari.' hari)</b>';
				}

				$this->table->add_row(array('data'=>$i,'width'=>'50px','align'=>'center'),substr($row->nomor_agenda,4),$row->tujuan,$tanggal_berlaku,$row->keperluan,$row->nomor_surat,standar_tanggal($row->tanggal_surat),$subsurattugas,standar_tanggal($row->tanggal_simpan),array('data'=>'<button data-toggle="dropdown" class="btn btn-info dropdown-toggle" type="button"><i class="fa fa-gear"></i> Pilih <span class="caret"></span></button>
               <ul class="dropdown-menu">
							 <li><a href="'.site_url('subsurattugas/id/'.$row->id_surat_tugas).'?tambah"><i class="fa fa-plus"></i> Penugasan Untuk</a></li>
                 <li><a href="'.site_url('surattugas?ubah&id='.$row->id_surat_tugas).'"><i class="fa fa-edit"></i> Ubah</a></li>
                 <li><a href="'.site_url('surattugas?hapus&id='.$row->id_surat_tugas).'" onclick="return confirm(\'Yakin menghapus data?\')"><i class="fa fa-trash-o"></i> Hapus</a></li>
               </ul>','width'=>'10px','align'=>'center'));
				$i++;
			}
			$databody['table']=$this->table->generate();
			$data['title']='Data Agenda Surat Tugas';
			$data['body']=$this->load->view('v_surattugas',$databody,true);
			$this->load->view('html/html',$data);
		}
	}
}
