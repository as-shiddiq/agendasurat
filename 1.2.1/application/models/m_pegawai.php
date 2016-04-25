<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_pegawai extends CI_Model {
	function get_data(){
		$data=$this->db->query("SELECT a.*, b.nama_jabatan
														FROM pegawai a LEFT JOIN jabatan b ON a.id_jabatan=b.id_jabatan
														ORDER BY a.id_pegawai DESC");
		return $data;
	}
	function insert($data,$where){
		$this->db->insert('pegawai',$data);
		$this->session->set_flashdata('info',info_success(icon('check').' Data Sukses Disimpan'));
	}
	function update($data,$where){
		$cek=$this->db->get_where('pegawai',$where);
		if($cek->num_rows()>0){
			$this->db->update('pegawai',$data,$where);
			$this->session->set_flashdata('info',info_success(icon('check').' Data Sukses Diubah'));
		}
		else{
			$this->session->set_flashdata('info',info_danger(icon('times').' Gagal Sukses Diubah [\'data tidak ditemukan\']'));
		}
	}
	function delete($where){
		$this->db->delete('pegawai',$where);
		$this->session->set_flashdata('info',info_success(icon('check').' Data Sukses Dihapus'));
	}
}
