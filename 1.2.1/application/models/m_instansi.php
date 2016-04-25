<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_instansi extends CI_Model {
	function get_data(){
                $this->db->order_by('id_instansi','DESC');
		$data=$this->db->get('instansi');
		return $data;
	}
	function insert($data,$where){
		$this->db->insert('instansi',$data);
		$this->session->set_flashdata('info',info_success(icon('check').' Data Sukses Disimpan'));
	}
	function update($data,$where){
		$cek=$this->db->get_where('instansi',$where);
		if($cek->num_rows()>0){
			$this->db->update('instansi',$data,$where);
			$this->session->set_flashdata('info',info_success(icon('check').' Data Sukses Diubah'));
		}
		else{
			$this->session->set_flashdata('info',info_danger(icon('times').' Gagal Sukses Diubah [\'data tidak ditemukan\']'));
		}
	}
	function delete($where){
		$this->db->delete('instansi',$where);
		$this->session->set_flashdata('info',info_success(icon('check').' Data Sukses Dihapus'));
	}
}
