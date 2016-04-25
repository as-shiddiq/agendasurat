<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_login extends CI_Model {
  function login($username,$password){
    $cek=$this->db->get_where('pengguna',array('nama_pengguna'=>$username,'password'=>$password));
    if($cek->num_rows()>0){
      return $cek;
    }
    else{
      return false;
    }
  }
}
