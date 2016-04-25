<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Update extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
   {
            parent::__construct();

			if($this->session->userdata('logged')==NULL){
				redirect(site_url('login'));
			}
			$this->load->model('m_disposisisuratmasuk');
			$this->load->model('m_disposisiundangan');
   }

	public function index($a='')
	{
		$crud['action']="update";
		$action=$crud['action'];
		//other configuration

		$crud['title']='Beranda';
		$data['crud']='';
		$data['body']=$this->load->view('v_update',$crud,true);
		$this->load->view('html/html',$data);
	}
	public function proses(){
		if($this->session->userdata("url")!=''){
			$nama_versi=$this->session->userdata("nama_versi");
			$url=dechash($this->session->userdata("url")).$nama_versi.'/'.$nama_versi.'.zip';
			$to='system/update/update.zip';
			if(copy($url,$to)){
			$zip = new ZipArchive;
			$file = $to;
			chmod($file,0777);
			if ($zip->open($file) === TRUE) {
    				$zip->extractTo('./');
    				$zip->close();
    				//cek apakah ada pembaruan disisi database
    				if($this->session->userdata("sql")=="true"){
						$sql= file('system/update/sql.ini');

						foreach ($sql as $query){
							$this->db->query(trim($query));
						}
    				}
					$versi		= file('system/update/versi.ini');
					foreach ($versi as $get) {
						# code...
						$ex=explode("||", $get);
						$data=array(
							"id_versi"=>$ex[0],
							"nama_versi"=>$ex[1],
							"tanggal_update"=>$ex[2],
							"changelog"=>$ex[3],
						);
						$this->db->insert("versi",$data);
					}

					/**END CHANGELOG**/
    				unlink($file);
					$this->session->set_flashdata('info',info_success(icon('check').' update sistem ke versi '.$nama_versi.', sukses dilakukan'));

    			}
    			else{
					$this->session->set_flashdata('info',info_danger(icon('check').' update sistem ke versi '.$nama_versi.', gagal dilakukan, terjadi kesalahan'));
    			}
			}
			else{
				$this->session->set_flashdata('info',info_danger(icon('check').' update sistem ke versi '.$nama_versi.', gagal dilakukan, file pembaruan tidak ditemukan'));
			}

			$url=$this->session->unset_userdata("updating");
			$url=$this->session->unset_userdata("proses-update");
			redirect('update');

		}
		if(isset($_POST['update'])){
			$version=$this->input->post("version");
				//laod
			include 'system/update/'.$version.'.php';

			$string_query	= rtrim($sql, "\n;" );
			$array_query	= explode(";", $string_query);

			foreach ($array_query as $query){
				$this->db->query(trim($query));
			}

			$data=array(
				"id_versi"=>"",
				"nama_versi"=>$version,
				"changelog"=>$changelog,
				"tanggal_versi"=>$tanggal_versi,
				"tanggal_update"=>date("Y-m-d")
			);
			$this->db->insert("versi",$data);
			$this->session->set_flashdata('info',info_success(icon('check').' update sistem ke versi '.$version.', sukses dilakukan'));
			redirect('update');
		}
	}

	public function checkupdate(){
		if(isset($_POST['data'])){
			$url=dechash($_POST['data']);
			$to='system/update/update.ini';
			if(copy($url,$to)){
				$get=file($to);
				$nama_versi=trim($get[0]);
				$sql=trim($get[1]);
				$file=trim($get[2]);
				//cek update 
				$cek=$this->db->get_where("versi",array("nama_versi"=>$nama_versi));
				if($cek->num_rows()==0){
					$this->session->set_userdata("updating",info_warning('Ditemukan pembaruan, nama versi : <b>'.$nama_versi.'</b> , '.anchor(site_url("update/proses/"),'Klik disini','btn btn-info btn-xs').' untuk melakukan pembaruan'));
					$this->session->set_userdata("url",$file);
					if($sql!="null"){
						$this->session->set_userdata("sql",$sql);
					}
					else{
						$this->session->unset_userdata("sql");
					}
					$this->session->set_userdata("nama_versi",$nama_versi);
				}
				else{
					$this->session->set_userdata("updating",info_warning('Pembaruan tidak ditemukan'));
				}
				echo 'success';
			}
			else{
				echo 'error';
			}

		}
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
