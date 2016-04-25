<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_surattugas extends CI_Model {
	function get_data(){
                $this->db->order_by('id_surat_tugas','DESC');
		$data=$this->db->get('surat_tugas');
		return $data;
	}
	function insert($data,$where){
		$this->db->insert('surat_tugas',$data);
		$this->session->set_flashdata('info',info_success(icon('check').' Data Sukses Disimpan'));
	}
	function update($data,$where){
		$cek=$this->db->get_where('surat_tugas',$where);
		if($cek->num_rows()>0){
			$this->db->update('surat_tugas',$data,$where);
			$this->session->set_flashdata('info',info_success(icon('check').' Data Sukses Diubah'));
		}
		else{
			$this->session->set_flashdata('info',info_danger(icon('times').' Gagal Sukses Diubah [\'data tidak ditemukan\']'));
		}
	}
	function delete($where){
		$this->db->delete('surat_tugas',$where);
		$this->session->set_flashdata('info',info_success(icon('check').' Data Sukses Dihapus'));
	}
}
