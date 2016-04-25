<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
    body{
      font-size: 12px;
      margin-top: -20px
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
    </style>
  </head>
  <body>
    <h3 class="center">BAPPEDA KABUPATEN TANAH LAUT</h3>
    <?php
      $row=$tampil->row();

     ?>
    <table width="100%">
      <tr class="border-top">
        <td width="200px">INDEK AGRO</td>
        <td width="1px">:</td>
        <td><?php echo substr($row->nomor_agenda,4)?></td>
        <td>URGENSI/DISELESAIKAN</td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td>SEBELUM TANGGAL :</td>
        <td></td>
      </tr>

      <tr class="border-top">
        <td>PERIHAL</td>
        <td>:</td>
        <td colspan="3"><?php echo $row->perihal?></td>
      </tr>
      <tr>
        <td>TANGGAL/NOMOR</td>
        <td>:</td>
        <td colspan="3"><?php echo nama_hari($row->tanggal_surat)?>, <?php echo standar_tanggal($row->tanggal_surat)?> / <?php echo $row->nomor_surat?></td>
      </tr>
      <tr>
        <td>ASAL</td>
        <td>:</td>
        <td colspan="3"><?php echo $row->pengirim?></td>
      </tr>
      <tr>
        <td>PARAF</td>
        <td>: </td>
        <td colspan="3"></td>
      </tr>

      <tr class="border-top">
        <td>DITERUSKAN KE</td>
        <td></td>
        <td></td>
        <td>ISI DISPOSISI</td>
        <td></td>
      </tr>

      <tr>
        <td colspan="3">
          <table width="100%">
            <?php
                //getbidang
                $this->db->order_by("id_bidang","ASC");
                $getbidang=$this->db->get("bidang");
                $i=1;
                foreach ($getbidang->result() as $bidang) {
            ?>
              <tr>
                <td><?php echo $i?>.</td>
                <td><?php echo strtoupper($bidang->singkatan_bidang)?></td>
              </tr>
              <?php $i++ ; }    ?>


          </table>
        </td>
        <td colspan="2">
          <table>
            <tr>
              <td>1.</td>
              <td>Untuk diterukan</td>
            </tr>
            <tr>
              <td>2.</td>
              <td>Untuk diselesaikan minta/saran/perhatiannya</td>
            </tr>
          </table>
        </td>
      </tr>

      <tr class="border-top">
        <td colspan="5">KALAU KELIRU HARAP DIKEMBALIKAN</td>
      </tr>

    </table>
    <br>
    <br>
    <hr style="border:0;border-top:1px dashed #000;margin:0 -40px">
  </body>
</html>
