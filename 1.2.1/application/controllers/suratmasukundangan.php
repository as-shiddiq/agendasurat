<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Suratmasukundangan extends CI_Controller {

		public function __construct()
	       {
	  			parent::__construct();
					$this->load->model('m_suratmasukundangan');
					$this->load->model('m_disposisiundangan');
		}
	function index(){
		if(isset($_POST['simpan'])){
			$id_surat_masuk_undangan = $this->input->post('id_surat_masuk_undangan');
			$nomor_agenda = $this->input->post('nomor_agenda');
			$def_nomor_agenda = $this->input->post('def_nomor_agenda');
			$pengirim = $this->input->post('pengirim');
			$nomor_surat = $this->input->post('nomor_surat');
			$tanggal_surat = $this->input->post('tanggal_surat');
			$tempat = $this->input->post('tempat');
			$tanggal_undangan = $this->input->post('tanggal_undangan');
			$ex=explode(' s/d ',$tanggal_undangan);
			$tanggal_mulai=$ex[0];
			$tanggal_sampai=$ex[1];
			$waktu_mulai=$this->input->post("waktu_mulai");
			$waktu_sampai=$this->input->post("waktu_sampai");
			$waktu = ($waktu_sampai!='' AND $waktu_sampai!='00:00:00')?substr($waktu_mulai,0,5).' s/d '.substr($waktu_sampai,0,5):substr($waktu_mulai,0,5);
			$perihal = $this->input->post('perihal');
			$status = $this->input->post('status');
			$tanggal_simpan = $this->input->post('tanggal_simpan');

			//cek nama Instansi
			$cek=$this->db->get_where('instansi',array("nama_instansi"=>$pengirim));
			if($cek->num_rows()==0){
				$this->load->model('m_instansi');
				$this->m_instansi->insert(array('nama_instansi'=>$pengirim),$where);

			}



			//create folder
			if($nomor_agenda!=$def_nomor_agenda){
				//cek exist
				$dir='./unggah/suratmasukundangan/'.tahun_perencanaan().'/';
				if(!file_exists($dir.$def_nomor_agenda) OR $def_nomor_agenda==''){
					mkdir($dir.$nomor_agenda,0700,true);
					file_put_contents($dir.$nomor_agenda.'/index.php','Error Akses!!');
				}
				else{
					rename($dir.$def_nomor_agenda,$dir.$nomor_agenda);
				}
			}

		$data=array(
			'id_surat_masuk_undangan' => $id_surat_masuk_undangan,
			'nomor_agenda' => tahun_perencanaan().$nomor_agenda,
			'pengirim' => $pengirim,
			'nomor_surat' => $nomor_surat,
			'tanggal_surat' => date_ymd($tanggal_surat),
			'tempat' => $tempat,
			'tanggal_mulai' => date_ymd($tanggal_mulai),
			'tanggal_sampai' => date_ymd($tanggal_sampai),
			'waktu' => $waktu,
			'perihal' => $perihal,
			'status' => $status,
			'waktu_mulai' => $waktu_mulai,
			'waktu_sampai'=>$waktu_sampai,
			'tanggal_simpan' => date_ymd($tanggal_simpan),
		);

			$where=array(
				'id_surat_masuk_undangan'=>$id_surat_masuk_undangan,
			);
			if(post('parameter')=='tambah'){
				$this->m_suratmasukundangan->insert($data,$where);
			}
			else{
				$this->m_suratmasukundangan->update($data,$where);
			}
			redirect('suratmasukundangan');
		}
		elseif(isset($_GET['hapus'])){
			$where=array(
      				'id_surat_masuk_undangan' => $this->input->get('id'),
			);
			$this->m_suratmasukundangan->delete($where);
                        redirect('suratmasukundangan');

		}
		else{
			$get_data=$this->m_suratmasukundangan->get_data();
			$template = array(
				'table_open' => '<table border="0" cellpadding="4" cellspacing="0" class="table table-bordered table-hover" id="table">',
			);
			$this->table->set_template($template);
			$this->table->set_heading('No','nomor agenda','pengirim','nomor surat','tanggal surat','tempat','tanggal undangan','waktu','perihal','status','tanggal simpan','Aksi');
			$i=1;
			foreach($get_data->result() as $row){
				if($row->status=='konfirmasi'){
					$status=italic("Konfirmasi","btn btn-success btn-xs");
				}
				elseif($row->status=='disposisi'){
					$status=italic("Disposisi","btn btn-warning btn-xs");
				}
				else{
					$status=italic("Proses","btn btn-danger btn-xs");
				}
				$tanggal_undangan=($row->tanggal_sampai==$row->tanggal_mulai)?standar_tanggal($row->tanggal_mulai):standar_tanggal($row->tanggal_mulai).' s/d '.standar_tanggal($row->tanggal_sampai);
				$this->table->add_row(array('data'=>$i,'width'=>'50px','align'=>'center'),substr($row->nomor_agenda,4),$row->pengirim,$row->nomor_surat,standar_tanggal($row->tanggal_surat),$row->tempat,$tanggal_undangan,$row->waktu,$row->perihal,$status,standar_tanggal($row->tanggal_simpan),array('data'=>'<button data-toggle="dropdown" class="btn btn-info dropdown-toggle" type="button"><i class="fa fa-gear"></i> Pilih <span class="caret"></span></button>
               <ul class="dropdown-menu">
							 <li><a href="'.site_url('suratmasukundangan/detail/'.$row->id_surat_masuk_undangan).'"><i class="fa fa-search-plus"></i> Detail</a></li>
								 <li><a href="'.site_url('suratmasukundangan/printdisposisi/'.$row->id_surat_masuk_undangan).'" target="_blank"><i class="fa fa-print"></i> Lembar Disposisi</a></li>
                 <li><a href="'.site_url('suratmasukundangan?ubah&id='.$row->id_surat_masuk_undangan).'"><i class="fa fa-edit"></i> Ubah</a></li>
                 <li><a href="'.site_url('suratmasukundangan?hapus&id='.$row->id_surat_masuk_undangan).'" onclick="return confirm(\'Yakin menghapus data?\')"><i class="fa fa-trash-o"></i> Hapus</a></li>
               </ul>','width'=>'10px','align'=>'center'));
				$i++;
			}
			$databody['table']=$this->table->generate();
			$data['title']='Data Agenda Surat Masuk Undangan';
			$data['body']=$this->load->view('v_suratmasukundangan',$databody,true);
			$this->load->view('html/html',$data);
		}
	}
	function printdisposisi($a=''){
		if($a==''){
			redirect("suratmasukundangan");
		}
		$get=$this->m_suratmasukundangan->get_data($a);
		if($get->num_rows()==0){
			redirect("suratmasukundangan");
		}
		$databody['tampil']=$get;
		$data=$this->load->view('suratmasukundangan/v_printdisposisi',$databody,true);
		generate_pdf($data,'suratmasukundangan-'.$a,'A4','landscape');
	}

	function printkegiatan(){
		if(isset($_GET['tanggal'])){
			$get=$this->m_suratmasukundangan->get_data_kegiatan($_GET['tanggal']);
			$databody['tampil']=$get;
			$databody['tanggal']=$_GET['tanggal'];
			$data=$this->load->view('suratmasukundangan/v_printkegiatan',$databody,true);
			generate_pdf($data,'undangan-'.$_GET['tanggal'],'legal','portrait');
		}
		else{
			redirect('suratmasukundangan');
		}
	}

		function detail($id=''){
			if($id==''){
				redirect("suratmasukundangan");
			}
			elseif(isset($_GET['hapus'])){
				$this->session->set_flashdata('info',info_success(icon('check').' Dokumen sukses dihapus'));
				$where=array("id_dokumen"=>$this->input->get("id"));
				$get=$this->db->get_where("dokumen",$where)->row();
				@unlink("./unggah/".$get->folder."/".$get->foto);
				$this->db->delete("dokumen",$where);
				redirect(site_url('suratmasukundangan/detail/'.$id));

			}
			else{
				if(isset($_POST['unggah'])){
					$this->unggah();
				}
				$databody['id_surat_masuk_undangan']=$id;
				$data['title']='Data Agenda Surat Masuk Undangan';
				$data['body']=$this->load->view('suratmasukundangan/v_detail',$databody,true);
				$this->load->view('html/html',$data);
			}
		}

		function unggah(){
				$jenis_dokumen=$this->input->post("jenis_dokumen");
				$id_from=$this->input->post("id_from");
				$folder=$this->input->post("folder");
				$tanggal_unggah=date("Y-m-d");
				$folder=$jenis_dokumen.'/'.tahun_perencanaan().'/'.$folder.'/';
				$config['upload_path'] = './unggah/'.$folder;
				$config['file_name'] = date("YmdHis");
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '10240';
				$this->load->library('upload', $config);
				if ( $this->upload->do_upload()){
					$upload_data=$this->upload->data();
					$data=array(
						'id_dokumen'=>'',
						"id_from"=>$id_from,
						"folder"=>$folder,
						"nama_dokumen"=>$upload_data['file_name'],
						"tanggal_unggah"=>$tanggal_unggah,
						"jenis_dokumen"=>$jenis_dokumen
					);
					$this->db->insert("dokumen",$data);

					$this->session->set_flashdata('info',info_success(icon('check').' Unggah Dokumen Sukses'));
					redirect(site_url($jenis_dokumen.'/detail/'.$id_from));
				}
				else{
					$this->session->set_flashdata('info',info_danger(icon('times').' Unggah Gagal'));
					redirect(site_url($jenis_dokumen.'/detail/'.$id_from));
				}

		}
}
