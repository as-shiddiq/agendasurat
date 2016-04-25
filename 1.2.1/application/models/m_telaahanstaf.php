<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_telaahanstaf extends CI_Model {
	function get_data(){
    $this->db->order_by('id_telaahan_staf','DESC');
		$data=$this->db->get('telaahan_staf');
		return $data;
	}
	function insert($data,$where){
		$this->db->insert('telaahan_staf',$data);
		$this->session->set_flashdata('info',info_success(icon('check').' Data Sukses Disimpan'));
	}
	function update($data,$where){
		$cek=$this->db->get_where('telaahan_staf',$where);
		if($cek->num_rows()>0){
			$this->db->update('telaahan_staf',$data,$where);
			$this->session->set_flashdata('info',info_success(icon('check').' Data Sukses Diubah'));
		}
		else{
			$this->session->set_flashdata('info',info_danger(icon('times').' Gagal Sukses Diubah [\'data tidak ditemukan\']'));
		}
	}
	function delete($where){
		$this->db->delete('telaahan_staf',$where);
		$this->session->set_flashdata('info',info_success(icon('check').' Data Sukses Dihapus'));
	}
}
