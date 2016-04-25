<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_subsurattugas extends CI_Model {
	function get_data($id_surat_tugas=''){
		if($id_surat_tugas!=''){
			$data=$this->db->query("SELECT *
															FROM sub_surat_tugas a LEFT JOIN pegawai b ON a.id_pegawai=b.id_pegawai
															WHERE a.id_surat_tugas='".$id_surat_tugas."' ORDER BY b.id_pegawai ASC");
		}
		else{
			$this->db->order_by('id_sub_surat_tugas','DESC');
			$data=$this->db->get('sub_surat_tugas');
		}
		return $data;
	}
	function insert($data,$where){
		$this->db->insert('sub_surat_tugas',$data);
		$this->session->set_flashdata('info',info_success(icon('check').' Data Sukses Disimpan'));
	}
	function update($data,$where){
		$cek=$this->db->get_where('sub_surat_tugas',$where);
		if($cek->num_rows()>0){
			$this->db->update('sub_surat_tugas',$data,$where);
			$this->session->set_flashdata('info',info_success(icon('check').' Data Sukses Diubah'));
		}
		else{
			$this->session->set_flashdata('info',info_danger(icon('times').' Gagal Sukses Diubah [\'data tidak ditemukan\']'));
		}
	}
	function delete($where){
		$this->db->delete('sub_surat_tugas',$where);
		$this->session->set_flashdata('info',info_success(icon('check').' Data Sukses Dihapus'));
	}
}
