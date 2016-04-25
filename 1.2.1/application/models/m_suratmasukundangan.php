<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_suratmasukundangan extends CI_Model {
	function get_data($id_surat_masuk_undangan=''){
  	$this->db->order_by('id_surat_masuk_undangan','DESC');
		if($id_surat_masuk_undangan!=''){
			$this->db->where("id_surat_masuk_undangan",$id_surat_masuk_undangan);
		}
		$data=$this->db->get('surat_masuk_undangan');
		return $data;
	}
	function get_data_kegiatan($tanggal=''){
		$data=$this->db->query("SELECT *
														FROM 	surat_masuk_undangan WHERE tanggal_mulai <='".date_ymd("$tanggal")."' AND tanggal_sampai>='".date_ymd("$tanggal")."' ORDER BY waktu_mulai ASC");
		return $data;
	}
	function insert($data,$where){
		$this->db->insert('surat_masuk_undangan',$data);
		$this->session->set_flashdata('info',info_success(icon('check').' Data Sukses Disimpan'));
	}
	function update($data,$where){
		$cek=$this->db->get_where('surat_masuk_undangan',$where);
		if($cek->num_rows()>0){
			$this->db->update('surat_masuk_undangan',$data,$where);
			$this->session->set_flashdata('info',info_success(icon('check').' Data Sukses Diubah'));
		}
		else{
			$this->session->set_flashdata('info',info_danger(icon('times').' Gagal Sukses Diubah [\'data tidak ditemukan\']'));
		}
	}

	function update2($data,$where){
		$cek=$this->db->get_where('disposisi_surat_masuk_undangan',$where);
		if($cek->num_rows()>0){
			$this->db->update('disposisi_surat_masuk_undangan',$data,$where);
			$this->session->set_flashdata('info',info_success(icon('check').' Data Sukses Diubah'));
		}
		else{
			$this->session->set_flashdata('info',info_danger(icon('times').' Gagal Sukses Diubah [\'data tidak ditemukan\']'));
		}
	}
	function delete($where){
		$this->db->delete('surat_masuk_undangan',$where);
		$this->session->set_flashdata('info',info_success(icon('check').' Data Sukses Dihapus'));
	}
}
