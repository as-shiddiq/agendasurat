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
    </style>
  </head>
  <body>
    <h3>Lembar Konfirmasi Terima Disposisi Surat Masuk Sekretariat <?php echo nama_hari(date("Y-m-d"))?>, <?php echo standar_tanggal(date("Y-m-d"))?></h3>
    <?php
      //get surat yang belum di disposisi
      $data=$this->db->query("SELECT a.id_surat_masuk as id_surat,a.nomor_agenda,a.pengirim,a.tanggal_surat,a.id_surat_masuk,a.nomor_surat,a.perihal,a.status,'suratmasuk' as jenis
                              FROM surat_masuk a LEFT JOIN disposisi_surat_masuk b ON a.id_surat_masuk=b.id_surat_masuk
                              LEFT JOIN bidang c ON c.id_bidang=b.id_bidang
                              WHERE c.id_parent_bidang!=0 AND a.status='disposisi'
                              GROUP BY a.id_surat_masuk
                              UNION
                              SELECT  a.id_surat_masuk_undangan as id_surat,a.nomor_agenda,a.pengirim,a.tanggal_surat,a.id_surat_masuk_undangan,a.nomor_surat,a.perihal,a.status, 'undangan' as jenis
                              FROM surat_masuk_undangan a LEFT JOIN disposisi_surat_masuk_undangan b ON a.id_surat_masuk_undangan=b.id_surat_masuk_undangan
                              LEFT JOIN bidang c ON c.id_bidang=b.id_bidang
                              WHERE c.id_parent_bidang!=0 AND a.status='disposisi'
                              GROUP BY a.id_surat_masuk_undangan");
      if($data->num_rows()>0){

        $template = array(
          'table_open' => '<table border="0" cellpadding="4" cellspacing="0" class="table table-bordered table-hover">',
        );
        $this->table->set_template($template);
        $this->table->set_heading('No',array("data"=>'nomor agenda',"width"=>"30px"),'pengirim','nomor surat','tanggal surat','perihal','tujuan disposisi','TTD');
        $i=1;
        foreach($data->result() as $row){

          if($row->jenis=='suratmasuk'){
            $disposisi='';
            $getdisposisi=$this->m_disposisisuratmasuk->get_data($row->id_surat);
            if($getdisposisi->num_rows()>0){
              foreach ($getdisposisi->result() as $disposisirow) {
                $disposisi.='- '.$disposisirow->nama_bidang.'<br>';
              }
            }
            else{
              $disposisi='<i style="color:red">Belum ditentukan</i>';
            }
          }
          else{
            $disposisi='';
            $getdisposisi=$this->m_disposisiundangan->get_data($row->id_surat);
            if($getdisposisi->num_rows()>0){
              foreach ($getdisposisi->result() as $disposisirow) {
                $disposisi.='- '.$disposisirow->nama_bidang.'<br>';
              }
            }
            else{
              $disposisi='<i style="color:red">Belum ditentukan</i>';
            }
          }

          $this->table->add_row(array('data'=>$i,'width'=>'50px','align'=>'center'),array("data"=>substr($row->nomor_agenda,4),"align"=>"center"),$row->pengirim,$row->nomor_surat,standar_tanggal($row->tanggal_surat),$row->perihal,$disposisi,'');
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
