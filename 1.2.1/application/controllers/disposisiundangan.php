<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Disposisiundangan extends CI_Controller {

		public function __construct()
	       {
	  			parent::__construct();
					$this->load->model('m_disposisiundangan');
					$this->load->model('m_suratmasukundangan');
		}
	function index(){
		if(isset($_GET['from'])){
			$go=$_GET['from'];
		}
		else{
			$go='suratmasuk';
		}

		if(isset($_GET['id_surat_masuk_undangan'])){
			$this->session->set_userdata("id_surat_masuk_undangan",$_GET['id_surat_masuk_undangan']);
		}
		elseif($this->session->userdata("id_surat_masuk_undangan")!=''){
			$this->session->userdata("id_surat_masuk_undangan");
		}
		else{
			redirect($go);
		}
		$id_surat_masuk_undangan=$this->session->userdata("id_surat_masuk_undangan");
		$get_detail=$this->m_suratmasukundangan->get_data($id_surat_masuk_undangan);
		if($get_detail->num_rows()==0){
			redirect($go);
		}


		if(isset($_POST['simpan'])){
			$id_disposisi_surat_masuk_undangan = $this->input->post('id_disposisi_surat_masuk_undangan');
			$id_surat_masuk_undangan = $this->input->post('id_surat_masuk_undangan');
			$id_bidang = $this->input->post('id_bidang');
			$id_pegawai = $this->input->post('id_pegawai');
			$keterangan = $this->input->post('keterangan');
			$tanggal_disposisi = date_ymd($this->input->post('tanggal_disposisi'));

			$data=array(
				'id_disposisi_surat_masuk_undangan' => $id_disposisi_surat_masuk_undangan,
				'id_surat_masuk_undangan' => $id_surat_masuk_undangan,
				'id_bidang' => $id_bidang,
				'keterangan' => $keterangan,
				'tanggal_disposisi' => $tanggal_disposisi,
			);

			$where=array(
				'id_disposisi_surat_masuk_undangan'=>$id_disposisi_surat_masuk_undangan,
			);
			if(post('parameter')=='tambah'){
				foreach ($id_bidang as $id_bidang) {
					$data['id_bidang']=$id_bidang;
					$data['id_pegawai']=0;
					$this->m_disposisiundangan->insert($data,$where);
				}
				if(count($id_pegawai)>0){
					foreach ($id_pegawai as $id_pegawai) {
						$ex=explode('&', $id_pegawai);
						$data['id_bidang']=$ex[0];
						$data['id_pegawai']=$ex[1];
						$this->m_disposisiundangan->insert($data,$where);
					}
				}
				//ubah status jadi disposisi
				if(count($id_bidang>0)){
					$where=array(
						'id_surat_masuk_undangan' => $id_surat_masuk_undangan,
					);
					$this->m_suratmasukundangan->update(array('status'=>'disposisi'),$where);
					$this->session->set_flashdata('info',info_success(icon('check').' Undangan dengan Nomor Agenda '.$id_surat_masuk_undangan.' sudah didisposisi'));
				}

			}
			else{
				$this->m_disposisiundangan->update($data,$where);
			}
			redirect($go);
		}
		elseif(isset($_GET['hapus'])){
			$where=array(
      				'id_disposisi_surat_masuk_undangan' => $this->input->get('id'),
			);
			$this->m_disposisiundangan->delete($where);
      redirect('disposisiundangan');

		}
		elseif(isset($_GET['bataldisposisi'])){
			$where=array(
      				'id_surat_masuk_undangan' => $id_surat_masuk_undangan,
			);
			$this->m_suratmasukundangan->update(array('status'=>'proses'),$where);
			$this->m_disposisiundangan->delete($where);
      redirect($go);

		}
		elseif(isset($_GET['konfirmasi'])){
			$where=array(
      				'id_surat_masuk_undangan' => $id_surat_masuk_undangan,
			);
			$this->session->set_flashdata('info',info_success(icon('check').' Surat Masuk dengan Nomor Agenda '.$id_surat_masuk_undangan.' sudah dikonfirmasi'));
			$this->m_suratmasukundangan->update(array('status'=>'konfirmasi'),$where);
			$this->m_suratmasukundangan->update2(array('tanggal_konfirmasi'=>date("Y-m-d")),$where);
      redirect($go);

		}
		else{
			$get_data=$this->m_disposisiundangan->get_data();
			$template = array(
				'table_open' => '<table border="0" cellpadding="4" cellspacing="0" class="table table-bordered table-hover" id="table">',
			);
			$this->table->set_template($template);
			$this->table->set_heading('No','surat masuk','nama bidang','keterangan','tanggal disposisi','Aksi');
			$i=1;
			foreach($get_data->result() as $row){
				$this->table->add_row(array('data'=>$i,'width'=>'50px','align'=>'center'),$row->id_surat_masuk_undangan,$row->id_bidang,$row->keterangan,$row->tanggal_disposisi,array('data'=>'<button data-toggle="dropdown" class="btn btn-info dropdown-toggle" type="button"><i class="fa fa-gear"></i> Pilih <span class="caret"></span></button>
               <ul class="dropdown-menu">
                 <li><a href="'.site_url('disposisiundangan?ubah&id='.$row->id_disposisi_surat_masuk_undangan).'"><i class="fa fa-edit"></i> Ubah</a></li>
                 <li><a href="'.site_url('disposisiundangan?hapus&id='.$row->id_disposisi_surat_masuk_undangan).'" onclick="return confirm(\'Yakin menghapus data?\')"><i class="fa fa-trash-o"></i> Hapus</a></li>
               </ul>','width'=>'10px','align'=>'center'));
				$i++;
			}
			$databody['id_surat_masuk_undangan']=$id_surat_masuk_undangan;
			$databody['tampil']=$get_detail;
			$databody['from']=$go;
			$databody['table']=$this->table->generate();
			$data['title']='Data Disposisi Surat Masuk';
			$data['body']=$this->load->view('v_disposisiundangan',$databody,true);
			$this->load->view('html/html',$data);
		}
	}
}
