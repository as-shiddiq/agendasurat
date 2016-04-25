<?php
  //get surat yang belum di disposisi
  $data=$this->db->get_where("surat_masuk",array("status"=>'proses'));
  if($data->num_rows()>0){
    $template = array(
      'table_open' => '<table border="0" cellpadding="4" cellspacing="0" class="table table-bordered table-hover">',
    );
    $this->table->set_template($template);
    $this->table->set_heading('No','nomor agenda','pengirim','nomor surat','tanggal surat','perihal','tanggal simpan','status','');
    $i=1;
    foreach($data->result() as $row){
      $this->table->add_row(array('data'=>$i,'width'=>'50px','align'=>'center'),substr($row->nomor_agenda,4),$row->pengirim,$row->nomor_surat,standar_tanggal($row->tanggal_surat),$row->perihal,standar_tanggal($row->tanggal_simpan),$row->status,array("data"=>'<a href="'.site_url('disposisisuratmasuk?tambah&from=home&id_surat_masuk='.$row->id_surat_masuk).'" onclick="return confirm(\'Data Sudah Di disposisi?\')" class="btn btn-info"><i class="fa fa-check"></i> Disposisi</a>','align'=>'center','width'=>"100px"
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
