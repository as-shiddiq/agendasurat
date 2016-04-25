<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Database extends CI_Controller {

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
       }

	public function index($a='')
	{

		if(isset($_GET['hapus'])){
			$where=array(
				'id_backup'=>$this->input->get('id'),
			);
			$this->db->delete('tbl_backup',$where);
			redirect('database');
		}
		$this->db->order_by("id_backup","DESC");
		$get_data=$this->db->get("backup");
		$template = array(
			'table_open' => '<table border="0" cellpadding="4" cellspacing="0" class="table table-bordered table-hover" id="table">',
		);
		$this->table->set_template($template);
		$this->table->set_heading('No.','Nama File','Tanggal dicadangkan','','');
		$i=1;
		foreach($get_data->result() as $row){

			$this->table->add_row(array('data'=>$i,'width'=>'30px','align'=>'center'),$row->nama_sql,standar_tanggal($row->tanggal_backup),array('data'=>'<a href="'.base_url('sql/'.$row->nama_sql).'" class="btn btn-success btn-xs" target="_blank"><i class="fa fa-download"></i> Simpan</a>','width'=>'10px','align'=>'center'),array('data'=>'<a href="'.site_url('database?hapus&id='.$row->id_backup).'" class="btn btn-danger btn-xs" onclick="return confirm(\'Yakin menghapus data?\')"><i class="fa fa-trash-o"></i> Hapus</a>','width'=>'10px','align'=>'center'));
			$i++;
		}
		$databody['table']=$this->table->generate();
		$crud['action']="home";
		$action=$crud['action'];
		$databody['title']='Database Management Tool';
		$data['crud']='';
		$data['body']=$this->load->view('v_database',$databody,true);
		$this->load->view('html/html',$data);
	}

	function backup(){
		error_reporting(0);
		$nama_file='db-backup-'.md5(date("Y-m-d-h-i-s")).'.sql';
		$data=array(
			'id_backup'=>'',
			'nama_sql'=>$nama_file,
			'tanggal_backup'=>date("Y-m-d")
		);
		$this->db->insert("backup",$data);
		backup_tables('localhost','root','','bappeda_agenda','*','sql/','download',$nama_file);
		$this->session->set_flashdata('info',info_success(icon('check').' Database sukses dicadangkan'));
		redirect('database');

	}

	function import(){
		if(isset($_POST['simpan'])){
			$config['upload_path'] 		= './sql/temp/';
			$config['allowed_types'] 	= 'sql|txt';
			$config['max_size']			= '8000';
			$config['max_width']  		= '10000';
			$config['max_height'] 		= '10000';

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('file')) {
				$up_data	 	= $this->upload->data();

				$direktori		= './sql/temp/'.$up_data['file_name'];

				$isi_file		= file_get_contents($direktori);
				$_satustelu		= substr($isi_file, 0, 103);

				$string_query	= rtrim($isi_file, "\n;&" );
				$array_query	= explode(";&", $string_query);

				foreach ($array_query as $query){
					$this->db->query(trim($query));
				}

				$path			= './sql/temp/';
				$this->load->helper("file"); // load the helper
				delete_files($path, true);
				$this->session->set_flashdata('info',info_success(icon('check').' Database sukses dikembalikan'));

		}
		else{
			$this->session->set_flashdata('info',info_danger(icon('times').' Database gagal dikembalikan | '.$this->upload->display_errors()));
		}
	}
	redirect('database');
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
