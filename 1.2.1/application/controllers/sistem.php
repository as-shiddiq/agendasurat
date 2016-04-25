<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sistem extends CI_Controller {

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
		$crud['action']="sistem";
		$action=$crud['action'];
		//other configuration
		if(isset($_POST['attr'])){
			$attr=$this->input->post("attr");
			$val=$this->input->post("val");
			$q=$this->db->update("sistem",array($attr=>$val),array("id_sistem"=>1));
			if($q==true){
				echo 'sukses';
			}
		}
		else{
			$crud['title']='Pengaturan Sistem';
			$data['crud']='';
			$data['body']=$this->load->view('v_sistem',$crud,true);
			$this->load->view('html/html',$data);
		}
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
