<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Suratmasuk extends CI_Controller {

		public function __construct()
	       {
	  			parent::__construct();
					$this->load->model('m_suratmasuk');
		}
	function index(){
		if(isset($_POST['simpan'])){
			$id_surat_masuk = $this->input->post('id_surat_masuk');
			$nomor_agenda = $this->input->post('nomor_agenda');
			$def_nomor_agenda = $this->input->post('def_nomor_agenda');
			$pengirim = $this->input->post('pengirim');
			$nomor_surat = $this->input->post('nomor_surat');
			$tanggal_surat = date_ymd($this->input->post('tanggal_surat'));
			$tanggal_simpan = date_ymd($this->input->post('tanggal_simpan'));
			$perihal = $this->input->post('perihal');
			$status = $this->input->post('status');

			//cek nama Instansi
			$cek=$this->db->get_where('instansi',array("nama_instansi"=>$pengirim));
			if($cek->num_rows()==0){
				$this->load->model('m_instansi');
				$this->m_instansi->insert(array('nama_instansi'=>$pengirim),$where);

			}
			//create folder
			if($nomor_agenda!=$def_nomor_agenda){
				//cek exist
				$dir='./unggah/suratmasuk/'.tahun_perencanaan().'/';
				if(!file_exists($dir.$def_nomor_agenda) OR $def_nomor_agenda==''){
					mkdir($dir.$nomor_agenda,0700,true);
					file_put_contents($dir.$nomor_agenda.'/index.php','Error Akses!!');
				}
				else{
					rename($dir.$def_nomor_agenda,$dir.$nomor_agenda);
				}
			}


		$data=array(
			'id_surat_masuk' => $id_surat_masuk,
			'nomor_agenda' => tahun_perencanaan().$nomor_agenda,
			'pengirim' => $pengirim,
			'nomor_surat' => $nomor_surat,
			'tanggal_surat' => $tanggal_surat,
			'tanggal_simpan' => $tanggal_simpan,
			'perihal' => $perihal,
			'status' => $status,
		);

			$where=array(
				'id_surat_masuk'=>$id_surat_masuk,
			);
			if(post('parameter')=='tambah'){
				$this->m_suratmasuk->insert($data,$where);
			}
			else{
				$this->m_suratmasuk->update($data,$where);
			}
			redirect('suratmasuk');
		}
		elseif(isset($_GET['hapus'])){
			$where=array(
      				'id_surat_masuk' => $this->input->get('id'),
			);
			$this->m_suratmasuk->delete($where);
                        redirect('suratmasuk');

		}
		elseif(isset($_GET['disposisi'])){
			$where=array(
      				'id_surat_masuk' => $this->input->get('id'),
			);
			$this->m_suratmasuk->update(array('status'=>'disposisi'),$where);
			if(isset($_GET['from'])){
				$this->session->set_flashdata('info',info_success(icon('check').' Surat Masuk dengan Nomor Agenda '.$_GET['id'].' sudah didisposisi'));
				redirect($_GET['from']);
			}
			else{
				redirect('suratmasuk');
			}

		}
		else{
			$get_data=$this->m_suratmasuk->get_data();
			$template = array(
				'table_open' => '<table border="0" cellpadding="4" cellspacing="0" class="table table-bordered table-hover" id="table">',
			);
			$this->table->set_template($template);
			$this->table->set_heading('No','nomor agenda','pengirim','nomor surat','tanggal surat','perihal','tanggal simpan','status','Aksi');
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
				$this->table->add_row(array('data'=>$i,'width'=>'50px','align'=>'center'),substr($row->nomor_agenda,4),$row->pengirim,$row->nomor_surat,standar_tanggal($row->tanggal_surat),$row->perihal,standar_tanggal($row->tanggal_simpan),$status,array('data'=>'<button data-toggle="dropdown" class="btn btn-info dropdown-toggle" type="button"><i class="fa fa-gear"></i> Pilih <span class="caret"></span></button>
               <ul class="dropdown-menu">
							 <li><a href="'.site_url('suratmasuk/detail/'.$row->id_surat_masuk).'"><i class="fa fa-search-plus"></i> Detail</a></li>
								 <li><a href="'.site_url('suratmasuk/printdisposisi/'.$row->id_surat_masuk).'" target="_blank"><i class="fa fa-print"></i> Lembar Disposisi</a></li>
                 <li><a href="'.site_url('suratmasuk?ubah&id='.$row->id_surat_masuk).'"><i class="fa fa-edit"></i> Ubah</a></li>
                 <li><a href="'.site_url('suratmasuk?hapus&id='.$row->id_surat_masuk).'" onclick="return confirm(\'Yakin menghapus data?\')"><i class="fa fa-trash-o"></i> Hapus</a></li>
               </ul>','width'=>'10px','align'=>'center'));
				$i++;
			}
			$databody['table']=$this->table->generate();
			$data['title']='Data Agenda Surat Masuk';
			$data['body']=$this->load->view('v_suratmasuk',$databody,true);
			$this->load->view('html/html',$data);
		}
	}

	function printdisposisi($a=''){
		if($a==''){
			redirect("suratmasuk");
		}
		$get=$this->m_suratmasuk->get_data($a);
		if($get->num_rows()==0){
			redirect("suratmasuk");
		}
		$databody['tampil']=$get;
		$data=$this->load->view('suratmasuk/v_printdisposisi',$databody,true);
		generate_pdf($data,'suratmasuk-'.$a,'A4','landscape');
	}

	function detail($id=''){
		if($id==''){
			redirect("suratmasuk");
		}
		elseif(isset($_GET['hapus'])){
			$this->session->set_flashdata('info',info_success(icon('check').' Dokumen sukses dihapus'));
			$where=array("id_dokumen"=>$this->input->get("id"));
			$get=$this->db->get_where("dokumen",$where)->row();
			@unlink("./unggah/".$get->folder."/".$get->foto);
			$this->db->delete("dokumen",$where);
			redirect(site_url('suratmasuk/detail/'.$id));

		}
		else{
			if(isset($_POST['unggah'])){
				$this->unggah();
			}
			$databody['id_surat_masuk']=$id;
			$data['title']='Data Agenda Surat Masuk';
			$data['body']=$this->load->view('suratmasuk/v_detail',$databody,true);
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
			$config['allowed_types'] = 'gif|jpg|png|pdf|jpeg';
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
