<?php
  //get surat yang belum di disposisi
  $data=$this->db->get_where("surat_masuk_undangan",array("status"=>'proses'));
  if($data->num_rows()>0){
    $template = array(
      'table_open' => '<table border="0" cellpadding="4" cellspacing="0" class="table table-bordered table-hover" id="table">',
    );
    $this->table->set_template($template);
    $this->table->set_heading('No','nomor agenda','pengirim','nomor surat','tanggal surat','tempat','tanggal undagan','waktu','perihal','status','tanggal simpan','');
    $i=1;
    foreach($data->result() as $row){
      $tanggal_undangan=($row->tanggal_sampai==$row->tanggal_mulai)?standar_tanggal($row->tanggal_mulai):standar_tanggal($row->tanggal_mulai).' s/d '.standar_tanggal($row->tanggal_sampai);
      $this->table->add_row(array('data'=>$i,'width'=>'50px','align'=>'center'),substr($row->nomor_agenda,4),$row->pengirim,$row->nomor_surat,standar_tanggal($row->tanggal_surat),$row->tempat,$tanggal_undangan,$row->waktu,$row->perihal,$row->status,standar_tanggal($row->tanggal_simpan),array("data"=>'<a href="'.site_url('disposisiundangan?tambah&from=home&id_surat_masuk_undangan='.$row->id_surat_masuk_undangan).'" onclick="return confirm(\'Data Sudah Di disposisi?\')" class="btn btn-info"><i class="fa fa-check"></i> Disposisi</a>','align'=>'center','width'=>"100px"
    ));
      $i++;
    }
    echo $this->table->generate();
    $this->table->clear();
  }
  else{
    echo '<i class="fc-red">Data tidak ditemukan</i>';
  }


 ?>
