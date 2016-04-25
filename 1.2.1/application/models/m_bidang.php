<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_bidang extends CI_Model {
	function get_data(){
		$data=$this->db->query("SELECT a.*,IFNULL(b.nama_bidang,'<i>Tidak Ada</i>') as nama_parent
														FROM bidang a LEFT JOIN bidang b ON a.id_parent_bidang=b.id_bidang
														ORDER BY a.id_bidang DESC");
		return $data;
	}
	function insert($data,$where){
		$this->db->insert('bidang',$data);
		$this->session->set_flashdata('info',info_success(icon('check').' Data Sukses Disimpan'));
	}
	function update($data,$where){
		$cek=$this->db->get_where('bidang',$where);
		if($cek->num_rows()>0){
			$this->db->update('bidang',$data,$where);
			$this->session->set_flashdata('info',info_success(icon('check').' Data Sukses Diubah'));
		}
		else{
			$this->session->set_flashdata('info',info_danger(icon('times').' Gagal Sukses Diubah [\'data tidak ditemukan\']'));
		}
	}
	function delete($where){
		$this->db->delete('bidang',$where);
		$this->session->set_flashdata('info',info_success(icon('check').' Data Sukses Dihapus'));
	}
}
