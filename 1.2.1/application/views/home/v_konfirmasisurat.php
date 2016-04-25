<?php
  //get surat yang belum di disposisi
  $data=$this->db->query("SELECT *
                          FROM surat_masuk a LEFT JOIN disposisi_surat_masuk b ON a.id_surat_masuk=b.id_surat_masuk
                          LEFT JOIN bidang c ON c.id_bidang=b.id_bidang
                          WHERE c.id_parent_bidang=0 AND a.status='disposisi'
                          GROUP BY a.id_surat_masuk
                          ORDER BY a.id_surat_masuk ASC");
  if($data->num_rows()>0){
    echo '<a href="'.site_url('home/printlembarkonfirmasi').'" class="btn btn-info" target="_blank"><i class="fa fa-print"></i> Cetak Lembar Konfirmasi</a><hr>';

    $template = array(
      'table_open' => '<table border="0" cellpadding="4" cellspacing="0" class="table table-bordered table-hover">',
    );
    $this->table->set_template($template);
    $this->table->set_heading('No','nomor agenda','pengirim','nomor surat','tanggal surat','perihal','tujuan disposisi','status','');
    $i=1;
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

      $this->table->add_row(array('data'=>$i,'width'=>'50px','align'=>'center'),substr($row->nomor_agenda,4),$row->pengirim,$row->nomor_surat,standar_tanggal($row->tanggal_surat),$row->perihal,$disposisisuratmasuk,$row->status,
      array('data'=>'<button data-toggle="dropdown" class="btn btn-info dropdown-toggle" type="button"><i class="fa fa-gear"></i> Pilih <span class="caret"></span></button>
             <ul class="dropdown-menu">
               <li><a href="'.site_url('disposisisuratmasuk?bataldisposisi&from=home&id_surat_masuk='.$row->id_surat_masuk).'" onclick="return confirm(\'Terjadi kesalahan disposisi?, Batalkan Disposisi?\')"><i class="fa fa-times"></i> Batal Disposisi</a></li>
               <li><a href="'.site_url('disposisisuratmasuk?konfirmasi&from=homes&id_surat_masuk='.$row->id_surat_masuk).'" onclick="return confirm(\'Surat sudah dkonfirmasi?\')"><i class="fa fa-check"></i> Dikonfirmasi</a></li>
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
