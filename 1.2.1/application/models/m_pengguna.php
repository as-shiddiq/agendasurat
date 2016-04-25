<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_pengguna extends CI_Model {

	function get_data(){
		$this->db->order_by('id_pengguna','DESC');
		$data=$this->db->get('pengguna');
		return $data;
	}
	function insert($data,$where){
		$cek=$this->db->get_where('pengguna',array("nama_pengguna"=>$this->input->post('nama_pengguna')));
		if($cek->num_rows()==0){
			$this->db->insert('pengguna',$data);
			$this->session->set_flashdata('info',info_success(icon('check').' Data Sukses Disimpan'));
		}
		else{
			$this->session->set_flashdata('info',info_danger(icon('times').' Gagal Disimpan [\'data duplikat\']'));
		}
	}
	function update($data,$where,$where2){
		$cek=$this->db->get_where(pengguna,$where);
		if($cek->num_rows()>0){
			if($this->input->post('nama_pengguna') != $this->input->post('def')){
				if($this->db->get_where('pengguna',array('nama_pengguna'=>$this->input->post('nama_pengguna')))->num_rows()>0){
					$this->session->set_flashdata('info',info_danger(icon('times').' Gagal Disimpan [\'data duplikat\']'));
				}
				else{
					$this->db->update('pengguna',$data,$where);
					$this->session->set_flashdata('info',info_success(icon('check').' Data Sukses Diubah'));
				}
			}
			else{
				$this->db->update('pengguna',$data,$where);
				$this->session->set_flashdata('info',info_success(icon('check').' Data Sukses Diubah'));
			}
		}
		else{
			$this->session->set_flashdata('info',info_danger(icon('times').' Gagal Sukses Diubah [\'data tidak ditemukan\']'));
		}
	}
	function delete($where){
		$this->db->delete('pengguna',$where);
		$this->session->set_flashdata('info',info_success(icon('check').' Data Sukses Dihapus'));
	}
}
