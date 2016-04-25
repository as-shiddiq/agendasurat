<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
    html{
      margin: 0 0 -40px;
    }
    body{
      font-size: 12px;
      border-right: 1px dashed #888;
      margin-bottom: -100px
    }
      .center{
        text-align: center;
      }
      table{
        border-spacing: 0
      }
      table td{
        vertical-align: top;
        padding: 3px 0
      }
      .border-top td{
        border-top: 1px solid #000;
        padding-top: 10px;
      }


      .header h3{
        margin:0;
        padding:0;
        font-size: 16px
      }
      .header p{
        margin: 0;
        padding: 0;
        font-family: monospace;
        font-size: 10px
      }
      .lembar{
        font-weight: normal
      }
      table.border tr td{
        border:1px solid #000;
        padding: 5px;
        width: 50%
      }
      table.no-border tr td{
        border:0;
        width: auto;
        padding: 0
      }
      .padding-me tr td{
        padding: 20px
      }
    </style>
  </head>
  <body>
  <table width="100%" class="padding-me">
    <tr>
      <td width="50%" style="border-right: 1px dashed #999">
        <table class="header" width="100%">
          <tr>
            <td class="center" width="4%"><img src="<?=base_url('assets/images/logo.png')?>" style="width: 40px;"></td>
            <td class="center" width="96%">
              <h3>PEMERINTAH KABUPATEN TANAH LAUT</h3>
              <h3>BADAN PERENCANAAN PEMBANGUNAN DAERAH</h3>
              <p>Jalan A. Syairani Komp. Perkantoran Gagas Pelaihari Telp/Fax (0512) 21036</p>
            </td>
          </tr>
        </table>
        <u><h3 class="center lembar">LEMBAR DISPOSISI</h3></u>

        <?php
          $row=$tampil->row();

         ?>

        <table class="border" width="100%">
          <tr>
            <td>No. Agenda / Tgl. Masuk : <?=substr($row->nomor_agenda,4)?> / <?=standar_tanggal($row->tanggal_surat)?></td>
            <td class="center">Kepala</td>
          </tr>
          <tr>
            <td height="150px">
              <table class="no-border" width="100%">
                <tr>
                  <td width="90px">perihal</td>
                  <td>:</td>
                  <td><?=$row->perihal?></td>
                </tr>
                <tr>
                  <td>Tgl / No</td>
                  <td>:</td>
                  <td><?=standar_tanggal($row->tanggal_surat)?> / <?=$row->nomor_surat?></td>
                </tr>
                <tr>
                  <td>Asal</td>
                  <td>:</td>
                  <td><?=$row->pengirim?></td>
                </tr>
              </table>
            </td>
            <td>
              
            </td>
          </tr>
          <tr>
            <td colspan="2" class="center">Sekretaris</td>
          </tr>
          <tr>
            <td height="150px" colspan="2"></td>
          </tr>
          <tr>
            <td>Diteruskan ke :</td>
            <td></td>
          </tr>
          <tr>
            <td height="150px">
              <table width="100%" class="no-border">
                <?php
                    //getbidang
                    $getbidang=$this->db->query("SELECT * FROM bidang WHERE id_parent_bidang=0 ORDER BY id_bidang ASC");
                    $i=1;
                    foreach ($getbidang->result() as $bidang) {
                      if($bidang->id_bidang==1){
                        ?>
                      <tr>
                        <td><?php echo $i?>.</td>
                        <td>Sekretaris</td>
                      </tr>

                        <?php
                      } else {
                ?>
                  <tr>
                    <td><?php echo $i?>.</td>
                    <td>Kabid. <?php echo $bidang->singkatan_bidang?></td>
                  </tr>
                  <?php }
                   $i++ ; }    ?>


                  <tr>
                    <td><?php echo $i?>.</td>
                    <td>Saudara(i)</td>
                  </tr>
              </table>
            </td>
            <td></td>
          </tr>
        </table>
      </td>
     <td></td>
    </tr>
  </table>
  </body>
</html>
