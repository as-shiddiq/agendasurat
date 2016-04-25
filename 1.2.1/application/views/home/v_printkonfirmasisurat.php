<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
      body{
        font-size: 10px;
        font-family: helvetica
      }
      table{
        border-spacing: 0;
        width: 100%
      }
      table thead tr th{
        text-align: center;
      }
      table tbody tr td,
      table thead tr th{
        border-right: 1px solid #000;
        border-top:1px solid #000;
        padding: 3px;
        vertical-align: top
      }
      table tbody tr td:first-child,
      table thead tr th:first-child{
        border-left: 1px solid #000;
      }
      table tbody tr:last-child td,
      table thead tr:last-child th{
        border-bottom: 1px solid #000
      }
      .center{
        text-align: center;
      }
      .yellow td,
      .yellow th{
        background: #ff8
      }
      .white{
        border-color: #fff;
        color: #fff
      }
    </style>
  </head>
  <body>
<?php
  //get surat yang belum di disposisi
  $data2=$this->db->query("SELECT * FROM disposisi_surat_masuk a LEFT JOIN surat_masuk b ON a.id_surat_masuk=b.id_surat_masuk WHERE tanggal_konfirmasi='".date("Y-m-d")."' GROUP BY a.id_surat_masuk");
  $data=$this->db->get_where("surat_masuk",array("status"=>'disposisi'));
  if($data->num_rows()>0){
    if($data2->num_rows()>0){
      echo '
      <h3 class="white">Lembar Konfirmasi Terima Disposisi Surat Masuk '.nama_hari(date("Y-m-d")).', '.standar_tanggal(date("Y-m-d")).'</h3>
      ';
      $template = array(
        'table_open' => '<table border="0" cellpadding="4" cellspacing="0" class="table table-bordered table-hover" id="table">',
        'heading_cell_start'  => '<th class="white">',
       'heading_cell_end'    => '</th>',
      );
    }
    else{
      echo '
      <h3>Lembar Konfirmasi Terima Disposisi Surat Masuk '.nama_hari(date("Y-m-d")).', '.standar_tanggal(date("Y-m-d")).'</h3>
      ';
      $template = array(
        'table_open' => '<table border="0" cellpadding="4" cellspacing="0" class="table table-bordered table-hover" id="table">',
        'heading_cell_start'  => '<th>',
         'heading_cell_end'    => '</th>',
      );
    }
    $this->table->set_template($template);
    $this->table->set_heading('No','nomor agenda','pengirim','nomor surat','tanggal surat','perihal','tujuan disposisi','TTD');
    $i=1;
    foreach($data2->result() as $row){
      $disposisisuratmasuk='';
      $getdisposisisuratmasuk=$this->m_disposisisuratmasuk->get_data($row->id_surat_masuk);
      if($getdisposisisuratmasuk->num_rows()>0){
        foreach ($getdisposisisuratmasuk->result() as $disposisisuratmasukrow) {
          $disposisisuratmasuk.='- '.$disposisisuratmasukrow->nama_bidang.'<br>';
        }
      }
      else{
        $disposisisuratmasuk='<i style="color:red">Belum ditentukan</i>';
      }
      $this->table->add_row(
                            array('data'=>$i,'width'=>'30px','align'=>'center',"class"=>"white"),
                            array('data'=>substr($row->nomor_agenda,4),'width'=>'50px','align'=>'center',"class"=>"white"),
                            array('data'=>$row->pengirim,"class"=>"white"),
                            array('data'=>$row->nomor_surat,"class"=>"white"),
                            array('data'=>standar_tanggal($row->tanggal_surat),"class"=>"white"),
                            array('data'=>$row->perihal,"class"=>"white"),
                            array("data"=>$disposisisuratmasuk,"class"=>"white"),
                            array("data"=>'',"class"=>"white"));
      $i++;
    }



    foreach($data->result() as $row){
      $disposisisuratmasuk='';
      $getdisposisisuratmasuk=$this->m_disposisisuratmasuk->get_data($row->id_surat_masuk);
      if($getdisposisisuratmasuk->num_rows()>0){
        foreach ($getdisposisisuratmasuk->result() as $disposisisuratmasukrow) {
          $disposisisuratmasuk.='- '.$disposisisuratmasukrow->nama_bidang.'<br>';
        }
      }
      else{
        $disposisisuratmasuk='<i style="color:red">Belum ditentukan</i>';
      }
      $this->table->add_row(array('data'=>$i,'width'=>'30px','align'=>'center'),array('data'=>substr($row->nomor_agenda,4),'width'=>'50px','align'=>'center'),$row->pengirim,$row->nomor_surat,standar_tanggal($row->tanggal_surat),$row->perihal,$disposisisuratmasuk,'');
      $i++;
    }
    echo $this->table->generate();
    $this->table->clear();
  }
  else{
    echo '<i class="fc-red">Data tidak ditemukan</i>';
  }


 ?>

</body>
</html>
