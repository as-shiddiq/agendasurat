 <?php
   //get surat yang belum di disposisi

   $data=$this->db->query("SELECT *
                           FROM surat_masuk_undangan a LEFT JOIN disposisi_surat_masuk_undangan b ON a.id_surat_masuk_undangan=b.id_surat_masuk_undangan
                           LEFT JOIN bidang c ON c.id_bidang=b.id_bidang
                           WHERE c.id_parent_bidang=0 AND a.status='disposisi'
                           GROUP BY a.id_surat_masuk_undangan
                           ORDER BY a.id_surat_masuk_undangan ASC");
   if($data->num_rows()>0){
     echo '<a href="'.site_url('home/printlembarkonfirmasiundangan').'" class="btn btn-info" target="_blank"><i class="fa fa-print"></i> Cetak Lembar Konfirmasi</a><hr>';
     $template = array(
       'table_open' => '<table border="0" cellpadding="4" cellspacing="0" class="table table-bordered table-hover" id="table">',
     );
     $this->table->set_template($template);
     $this->table->set_heading('No','nomor agenda','pengirim','nomor surat','tanggal surat','tempat','tanggal undagan','waktu','perihal','tujuan disposisi','status','');
     $i=1;
     foreach($data->result() as $row){
       $disposisiundangan='';
       $getdisposisiundangan=$this->m_disposisiundangan->get_data($row->id_surat_masuk_undangan);
       if($getdisposisiundangan->num_rows()>0){
         foreach ($getdisposisiundangan->result() as $disposisiundanganrow) {
           $disposisiundangan.='- '.$disposisiundanganrow->nama_bidang.'<br>';
         }
       }
       else{
         $disposisiundangan='<i style="color:red">Belum ditentukan</i>';
       }

       $tanggal_undangan=($row->tanggal_sampai==$row->tanggal_mulai)?standar_tanggal($row->tanggal_mulai):standar_tanggal($row->tanggal_mulai).' s/d '.standar_tanggal($row->tanggal_sampai);
       $this->table->add_row(array('data'=>$i,'width'=>'50px','align'=>'center'),substr($row->nomor_agenda,4),$row->pengirim,$row->nomor_surat,standar_tanggal($row->tanggal_surat),$row->tempat,$tanggal_undangan,$row->waktu,$row->perihal,$disposisiundangan,$row->status,
       array('data'=>'<button data-toggle="dropdown" class="btn btn-info dropdown-toggle" type="button"><i class="fa fa-gear"></i> Pilih <span class="caret"></span></button>
              <ul class="dropdown-menu">
                <li><a href="'.site_url('disposisiundangan?bataldisposisi&from=home&id_surat_masuk_undangan='.$row->id_surat_masuk_undangan).'" onclick="return confirm(\'Terjadi kesalahan disposisi?, Batalkan Disposisi?\')"><i class="fa fa-times"></i> Batal Disposisi</a></li>
                <li><a href="'.site_url('disposisiundangan?konfirmasi&from=homes&id_surat_masuk_undangan='.$row->id_surat_masuk_undangan).'" onclick="return confirm(\'Surat sudah dkonfirmasi?\')"><i class="fa fa-check"></i> Dikonfirmasi</a></li>
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
