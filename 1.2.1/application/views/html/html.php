<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $title?></title>
    <?php include 'head.php';?>
    <?php echo $this->load->view('html/js')?>
  </head>
  <body>
    <body class="homepage">
      <?php include 'header.php';?>
      <div class="container page" style="padding:10px">

      <div style="margin:10px auto;min-height:400px;padding:10px 15px">
          <?php echo $body;?>
      </div>
      </div>
      <div class="lockscreen" style="display: none">
         <div class="middle-box loginscreen">
        <div class="form-login" style="display: none">
            <h3 class="head"><i class="fa fa-key"></i></h3>
            <form class="lockscreen-open">
              <div class="box-logo">
                <img src="<?php echo base_url('assets/images/logo.png')?>" class="logo" alt="" />
              </div>
              <h4 class="nama_pengguna"><?=$this->session->userdata("nama_pengguna");?></h4>
              <p class="level"><?=$this->session->userdata("level");?></p>
              <div class="form-group">
                  <input type="password" placeholder="Kata Sandi" class="form-control" name="password_lock" value="" required="required">
              </div>
              <?php echo button('buka','Buka','btn-success','')?>

            </form>
        </div>
       </div>
      </div>
      <?php echo $this->load->view('html/footer')?>

  </body>
</html>
