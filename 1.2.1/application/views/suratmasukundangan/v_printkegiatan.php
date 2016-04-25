<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
      body{
        font-size: 11px;
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
        padding: 3px
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
    <h3>DAFTAR KEGIATAN ACARA </h3>
    <p>
      <?php echo nama_hari(date_ymd($tanggal))?>, <?php echo standar_tanggal(date_ymd($tanggal))?>
    </p>
    <hr>
    <?php
      if($tampil->num_rows()>0){ ?>
        <table>
          <thead>
            <tr class="yellow">
              <th>No</th>
              <th>Acara</th>
              <th>Pelaksana</th>
              <th>Peserta</th>
              <th>Tempat</th>
              <th>Waktu</th>
            </tr>
          </thead>
          <tbody>
          <?php $i=1;foreach ($tampil->result() as $row) { ?>
            <tr>
              <td class="center"><?php echo $i?></td>
              <td><?php echo $row->perihal?></td>
              <td><?php echo $row->pengirim?></td>
              <?php
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

               ?>
              <td><?php echo $disposisiundangan?></td>
              <td class="center"><?php echo $row->tempat?></td>
              <td class="center"><?php echo $row->waktu?></td>
            </tr>
          <?php $i++;} ?>
          </tbody>
        </table>
      <?php  }  else{
        echo '<i>Tidak ada yang dapat ditampilkan</i>';
      }
     ?>
  </body>
</html>
