  <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct()
       {
            parent::__construct();
       }

	public function index($a="",$b="")
	{

		$crud['title']="Masuk";
		$crud['action']="login";

		$action=$crud['action'];

    $username=$this->input->post('nama_admin');
    $password=$this->input->post('password');
    $level=$this->input->post('level');
		//other configuration
		if(isset($_POST['login'])){
			if($username!='' AND $password!=''){
          $cek=$this->m_login->login($username,$password);
          if($cek!=false){
            $row=$cek->row();
              $this->session->set_userdata('logged',true);
              $this->session->set_userdata('level',$row->level);
              $this->session->set_userdata('id_pengguna',$row->id_pengguna);
              $this->session->set_userdata('nama_pengguna',$username);
              redirect('home');
          }
        else{
          $this->session->set_flashdata('info',info_danger(icon('times').' Nama Pengguna atau Password Salah'));
          redirect('login');
        }
      }
      else{
        $this->session->set_flashdata('info',info_danger(icon('times').' Nama Pengguna atau Password Salah'));
        redirect('login');
      }
		}
		else{
		    $this->load->view('v_login',$crud);
		}

	}
  public function lockscreen()
  {
    if(isset($_POST['password'])){
      $password=$this->input->post("password");
      $nama_pengguna=$this->session->userdata("nama_pengguna");
      $cek=$this->db->get_where("pengguna",array("nama_pengguna"=>$nama_pengguna,"password"=>$password));
      if($cek->num_rows()>0){
        echo 'sukses';
      }
    }
  }
	function logout(){
		$this->session->sess_destroy();
		redirect('login');
	}
}
