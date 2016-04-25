<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_sppd extends CI_Model {
	function get_data(){
		$data=$this->db->query("SELECT *
														FROM sppd a LEFT JOIN pegawai b ON a.id_pegawai=b.id_pegawai
														ORDER BY a.id_sppd DESC");
		return $data;
	}
	function insert($data,$where){
		$this->db->insert('sppd',$data);
		$this->session->set_flashdata('info',info_success(icon('check').' Data Sukses Disimpan'));
	}
	function update($data,$where){
		$cek=$this->db->get_where('sppd',$where);
		if($cek->num_rows()>0){
			$this->db->update('sppd',$data,$where);
			$this->session->set_flashdata('info',info_success(icon('check').' Data Sukses Diubah'));
		}
		else{
			$this->session->set_flashdata('info',info_danger(icon('times').' Gagal Sukses Diubah [\'data tidak ditemukan\']'));
		}
	}
	function delete($where){
		$this->db->delete('sppd',$where);
		$this->session->set_flashdata('info',info_success(icon('check').' Data Sukses Dihapus'));
	}
}
