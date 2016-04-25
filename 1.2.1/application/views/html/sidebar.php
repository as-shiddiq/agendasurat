<div class="col-lg-4 sidebar">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5><?php echo icon('bars')?> Sidebar</h5>
        </div>
        <div class="ibox-content">
          <ul>
            <li>
              <?php
                //jika sudah login
                if($this->session->userdata("logged")==true AND $this->session->userdata("level")=="member"){ ?>
                  <h3>Data Anda</h3>
                  <?php
                    $get=$this->db->get_where("tabel_member",array("id_member"=>$this->session->userdata("id_member")));
                    if($get->num_rows()>0){
                        $row=$get->row();
                    ?>
                      <table class="table">
                        <tr>
                          <td width="140px">Nama Anda</td>
                          <td width="10px">:</td>
                          <td><?php echo $row->nama_member?></td>
                        </tr>
                        <tr>
                          <td width="140px">Nama Klub</td>
                          <td width="10px">:</td>
                          <td><?php echo $row->nama_klub?></td>
                        </tr>
                        <tr>
                          <td width="140px">Nomor Telepon</td>
                          <td width="10px">:</td>
                          <td><?php echo $row->nomor_telepon?></td>
                        </tr>
                        <tr>
                          <td width="140px">Tanggal Gabung</td>
                          <td width="10px">:</td>
                          <td><?php echo tanggal_indonesia($row->tanggal_gabung)?></td>
                        </tr>
                      </table>
                      <a href="<?php echo site_url('login/logout')?>" class="btn btn-danger" onclick="return confirm('Yakin untuk keluar?')">Keluar</a>

                  <?php
                    }
                    else{
                      redirect("login/logout");
                    }


                   ?>


              <?php  }
                else{

              ?>
              <h3>Login</h3>
              <form class="validate" action="<?php echo site_url("login")?>" method="post">
                <div class="form-group">
                  <label for="" class="label-control">Nama pengguna</label>
                  <input type="text" name="nama_pengguna" value="" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="" class="label-control">Password</label>
                  <input type="password" name="password" value="" class="form-control" required>
                </div>
                <button type="submit" name="login" class="btn btn-info">Login</button>
                <br>
                ingin menjadi member? hubungi Admin
              </form>
              <?php } ?>
            </li>
            <li>
              <h3>Info seputar kami</h3>
            </li>
          </ul>





        </div>
    </div>
</div>
