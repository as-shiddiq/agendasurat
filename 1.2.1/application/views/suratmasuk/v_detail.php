<div class="col-lg-12 bg-white">
  <div class="ibox float-e-margins">
    <div class="ibox-title">
    <h5>Detail Surat Masuk
      <a href="<?=site_url("suratmasuk")?>" class="btn btn-danger" style="float:right;margin:-10px 0px"><i class="fa fa-reply"></i> Kembali</a>

    </h5>
    </div>
    <div class="ibox-content">
      <div class="col-lg-6">
        <h4>Detail Surat Masuk  </h4>
        <?php
          $get=$this->db->query("SELECT * FROM surat_masuk WHERE id_surat_masuk='".$id_surat_masuk."'");
          if($get->num_rows()==0){
            redirect("suratmasuk");
          }
          $row=$get->row();
          $nomor_agenda=$row->nomor_agenda;
         ?>
        <table class="table">
          <tr>
            <td width="150px">Nomor Agenda</td>
            <td width="10px">:</td>
            <td><?=substr($row->nomor_agenda,4)?></td>
          </tr>
          <tr>
            <td>Pengirim</td>
            <td>:</td>
            <td><?=$row->pengirim?></td>
          </tr>
          <tr>
            <td>No. Surat</td>
            <td>:</td>
            <td><?=$row->nomor_surat?></td>
          </tr>
          <tr>
            <td>Tanggal Surat</td>
            <td>:</td>
            <td><?=tanggal_indonesia($row->tanggal_surat)?></td>
          </tr>
          <tr>
            <td>Perihal</td>
            <td>:</td>
            <td><?=$row->perihal?></td>
          </tr>
          <tr>
            <td>Status</td>
            <td>:</td>
            <td><?=$row->status?></td>
          </tr>
          <tr>
            <td>Tanggal Terima</td>
            <td>:</td>
            <td><?=tanggal_indonesia($row->tanggal_simpan)?></td>
          </tr>
        </table>
      </div>
      <div class="col-lg-6">
        <h4>Daftar Penerima Disposisi</h4>
        <?php
          $get=$this->db->query("SELECT * FROM disposisi_surat_masuk a LEFT JOIN bidang b ON a.id_bidang=b.id_bidang WHERE id_surat_masuk='".$id_surat_masuk."'");
          if($get->num_rows()>0){
            foreach ($get->result() as $row) {
              ?>
              <div class="clearfix">
                <b class="fc-green">- <?=$row->nama_bidang?></b>
              </div>

              <?php
            }
          }
          else{
            ?>
              <i class="fc-red">Data penerima disposisi tidak ditemukan</i>
            <?php
          }
         ?>
      </div>
    </div>
    <!--END BAG DETIAL-->
    <!--UPLOAD-->
    <div class="col-lg-12">
      <hr>
      <h4>Unggah Dokumen</h4>
      <form class="validate" enctype="multipart/form-data" method="POST" action="<?php echo site_url('suratmasuk/detail/'.$id_surat_masuk)?>">
        <?php echo $this->session->flashdata('info');?>

        <input type="hidden" value="<?=substr($nomor_agenda,4)?>" name="folder" class="default" />
        <input type="hidden" value="<?=$id_surat_masuk?>" name="id_from" class="default" />
           <input type="hidden" value="suratmasuk" name="jenis_dokumen" class="default" />
           <span class="fc-red">Pilih foto pelatihan yang ingin diunggah (Format : JPG|PNG)</span>
           <?php
               echo input_file('userfile','','','style="margin:10px 0"');
            ?>
           <?php echo button_submit('unggah','Unggah','btn-info','style="width:100%"')?>
           <div style="clear:both"></div>
       </form>

    </div>
    <!--DOKUMEN TERUNGGAH-->
    <div class="col-lg-12">
      <hr>
      <h4>Dokumen Terunggah</h4>
      <?php
        $get=$this->db->query("SELECT * FROM dokumen WHERE id_from='$id_surat_masuk' AND jenis_dokumen='suratmasuk'");
        if($get->num_rows()>0){
          foreach ($get->result() as $row) {
            # code...
            ?>
            <div class="col-md-4">
              <img src="<?=base_url('unggah/'.$row->folder.'/'.$row->nama_dokumen)?>" alt="" style="width:100%;border:1px solid #aaa" />
              <div class="" style="border:1px solid #ddd;margin:10px 0; padding:10px">
                <small style="color:#aaa">Tanggal Unggah : <?=tanggal_indonesia($row->tanggal_unggah)?></small>
              </div>
              <a href="<?=site_url("suratmasuk/detail/".$id_surat_masuk.'?hapus&id='.$row->id_dokumen)?>" onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-danger"><i class="fa fa-edit"></i> Hapus</a>
            </div>
            <?php
          }
        }
        else{
          ?>
          <i class="fc-red">Tidak ada dokumen yang diunggah</i>
          <?php
        }


       ?>
       <div class="clearfix">

       </div>
       <br>

    </div>
  </div>
</div>
