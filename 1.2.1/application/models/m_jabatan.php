<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_jabatan extends CI_Model {
	function get_data(){
		$data=$this->db->query("SELECT DISTINCT a.*,c.*,b.level as level_jabatan,IFNULL(b.nama_jabatan,'<i>Tidak Ada</i>') as nama_parent_jabatan
														FROM jabatan a LEFT JOIN jabatan b ON a.id_parent_jabatan=b.id_jabatan
														LEFT JOIN bidang c ON a.id_bidang=c.id_bidang
														ORDER BY a.id_jabatan DESC");
		return $data;
	}
	function insert($data,$where){
		$this->db->insert('jabatan',$data);
		$this->session->set_flashdata('info',info_success(icon('check').' Data Sukses Disimpan'));
	}
	function update($data,$where){
		$cek=$this->db->get_where('jabatan',$where);
		if($cek->num_rows()>0){
			$this->db->update('jabatan',$data,$where);
			$this->session->set_flashdata('info',info_success(icon('check').' Data Sukses Diubah'));
		}
		else{
			$this->session->set_flashdata('info',info_danger(icon('times').' Gagal Sukses Diubah [\'data tidak ditemukan\']'));
		}
	}
	function delete($where){
		$this->db->delete('jabatan',$where);
		$this->session->set_flashdata('info',info_success(icon('check').' Data Sukses Dihapus'));
	}
}
