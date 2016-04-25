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
    echo '<a href="'.site_url('home/printlembarkonfirmasibidang').'" class="btn btn-info" target="_blank"><i class="fa fa-print"></i> Cetak Lembar Konfirmasi</a><hr>';

    $template = array(
      'table_open' => '<table border="0" cellpadding="4" cellspacing="0" class="table table-bordered table-hover">',
    );
    $this->table->set_template($template);
    $this->table->set_heading('No','nomor agenda','pengirim','nomor surat','tanggal surat','perihal','tujuan disposisi','status','');
    $i=1;
    foreach($data->result() as $row){

      if($row->jenis=='suratmasuk'){
        $disposisi='';
        $from_dis='id_surat_masuk';
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
        $from_dis='id_surat_masuk_undangan';
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

      $this->table->add_row(array('data'=>$i,'width'=>'50px','align'=>'center'),substr($row->nomor_agenda,4),$row->pengirim,$row->nomor_surat,standar_tanggal($row->tanggal_surat),$row->perihal,$disposisi,$row->status,
      array('data'=>'<button data-toggle="dropdown" class="btn btn-info dropdown-toggle" type="button"><i class="fa fa-gear"></i> Pilih <span class="caret"></span></button>
             <ul class="dropdown-menu">
               <li><a href="'.site_url('disposisi'.$row->jenis.'?bataldisposisi&from=home&'.$from_dis.'='.$row->id_surat).'" onclick="return confirm(\'Terjadi kesalahan disposisi?, Batalkan Disposisi?\')"><i class="fa fa-times"></i> Batal Disposisi</a></li>
               <li><a href="'.site_url('disposisi'.$row->jenis.'?konfirmasi&from=homes&'.$from_dis.'='.$row->id_surat).'" onclick="return confirm(\'Surat sudah dkonfirmasi?\')"><i class="fa fa-check"></i> Dikonfirmasi</a></li>
             </ul>','width'=>'10px','align'=>'center'));
      $i++;
    }
    echo $this->table->generate();
    $this->table->clear();
  }
  else{
    echo '<i class="fc-red">Data tidak ditemukan</i>';
  }


 ?>
