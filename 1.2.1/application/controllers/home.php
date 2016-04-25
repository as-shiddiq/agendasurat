<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

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
		$crud['action']="home";
		$action=$crud['action'];
		//other configuration

		$crud['title']='Beranda';
		$data['crud']='';
		$data['body']=$this->load->view('v_home',$crud,true);
		$this->load->view('html/html',$data);
	}

	function printlembarkonfirmasi(){
			$data=$this->load->view('home/v_printkonfirmasisurat','',true);
			generate_pdf($data,'suratmasukkonfirm-'.date("d-m-Y"),'legal','portrait');
	}

	function printlembarkonfirmasiundangan(){
			$data=$this->load->view('home/v_printkonfirmasiundangan','',true);
			generate_pdf($data,'undangankonfirm-'.date("d-m-Y"),'legal','portrait');
	}

	function printlembarkonfirmasibidang(){
			$data=$this->load->view('home/v_printkonfirmasibidang','',true);
			generate_pdf($data,'undangankonfirmbidang-'.date("d-m-Y"),'legal','portrait');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
