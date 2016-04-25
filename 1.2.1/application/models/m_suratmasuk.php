<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_suratmasuk extends CI_Model {
	function get_data($id_surat_masuk=''){
  	$this->db->order_by('id_surat_masuk','DESC');
		if($id_surat_masuk!=''){
			$this->db->where("id_surat_masuk",$id_surat_masuk);
		}
		$data=$this->db->get('surat_masuk');
		return $data;
	}
	function insert($data,$where){
		$this->db->insert('surat_masuk',$data);
		$this->session->set_flashdata('info',info_success(icon('check').' Data Sukses Disimpan'));
	}
	function update($data,$where){
		$cek=$this->db->get_where('surat_masuk',$where);
		if($cek->num_rows()>0){
			$this->db->update('surat_masuk',$data,$where);
			$this->session->set_flashdata('info',info_success(icon('check').' Data Sukses Diubah'));
		}
		else{
			$this->session->set_flashdata('info',info_danger(icon('times').' Gagal Sukses Diubah [\'data tidak ditemukan\']'));
		}
	}
	function update2($data,$where){
		$cek=$this->db->get_where('disposisi_surat_masuk',$where);
		if($cek->num_rows()>0){
			$this->db->update('disposisi_surat_masuk',$data,$where);
			$this->session->set_flashdata('info',info_success(icon('check').' Data Sukses Diubah'));
		}
		else{
			$this->session->set_flashdata('info',info_danger(icon('times').' Gagal Sukses Diubah [\'data tidak ditemukan\']'));
		}
	}
	function delete($where){
		$this->db->delete('surat_masuk',$where);
		$this->session->set_flashdata('info',info_success(icon('check').' Data Sukses Dihapus'));
	}
}
