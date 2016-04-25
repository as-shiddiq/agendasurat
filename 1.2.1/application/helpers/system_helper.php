<?php
  function tahun_perencanaan(){
    $nfw=&get_instance();
    $data=$nfw->db->get("sistem");
    if($data->num_rows()>0){
      $row=$data->row();
      return $row->tahun_perencanaan;
    }
    else{
      return date('Y');
    }
  }
  function aktif_lockscreen(){
    $nfw=&get_instance();
    $data=$nfw->db->get("sistem");
    if($data->num_rows()>0){
      $row=$data->row();
      return $row->aktif_lockscreen;
    }
    else{
      return 'N';
    }
  }
  function lama_waktu_lockscreen(){
    $nfw=&get_instance();
    $data=$nfw->db->get("sistem");
    if($data->num_rows()>0){
      $row=$data->row();
      return ($row->lama_waktu_lockscreen<10)?"10":$row->lama_waktu_lockscreen;
    }
    else{
      return '10';
    }
  }

  function toromawi($month){
    switch ($month) {
      case '1':
        $kode='I';
        break;
      case '2':
        $kode='II';
        break;
      case '3':
        $kode='III';
        break;
      case '4':
        $kode='IV';
        break;
      case '5':
        $kode='V';
        break;
      case '6':
        $kode='VI';
        break;
      case '7':
        $kode='VII';
        break;
      case '8':
        $kode='VIII';
        break;
      case '9':
        $kode='IX';
        break;
      case '10':
        $kode='X';
        break;
      case '11':
        $kode='XI';
        break;
      case '12':
        $kode='XII';
        break;
    }
    return $kode;
  }
 ?>
