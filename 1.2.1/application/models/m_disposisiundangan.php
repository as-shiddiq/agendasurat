<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_disposisiundangan extends CI_Model {
	function get_data($id_surat_masuk_undangan=''){
		$data=$this->db->query("SELECT *
								FROM disposisi_surat_masuk_undangan a LEFT JOIN bidang b ON a.id_bidang=b.id_bidang
								WHERE a.id_surat_masuk_undangan='".$id_surat_masuk_undangan."'
								 GROUP BY a.id_bidang
								ORDER BY b.id_bidang ASC");
		return $data;
	}
	function insert($data,$where){
		$this->db->insert('disposisi_surat_masuk_undangan',$data);
		$this->session->set_flashdata('info',info_success(icon('check').' Data Sukses Disimpan'));
	}
	function update($data,$where){
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
		$this->db->delete('disposisi_surat_masuk_undangan',$where);
		$this->session->set_flashdata('info',info_success(icon('check').' Data Sukses Dihapus'));
	}
}
