<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $title?></title>
    <link href="<?php echo base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/font-awesome/css/font-awesome.css')?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/css/animate.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/style.css')?>" rel="stylesheet">


    <style type="text/css">
        body{
          background-image: url('<?php echo base_url('assets/images/background-login.jpg')?>');
        }
        .logo {
            text-align: center !important
        }
        .logo img {
            width:100px;
            display: block;
            margin:auto;
            text-align:center;
        }
        .form-login{
            padding:20px 40px !important;
            width: 350px;
            text-align: center;
            margin: auto;
            margin: auto
        }
        .loginscreen{
            width:30%;
            margin: auto;
            margin-top: 7%;
            position: fixed;
            left: 35%;
            right: 35%
        }
        hgroup{
            top:0;
            text-align: left;
        }
        hgroup h1{
            background: rgba(255,255,255,0.9);
            padding: 10px;
            font-size: 30px;
            margin: 10px 0 5px 0;
            color: #0B723E !important
        }

        .form-login .head{
          font-size: 25px;
          background: #060;
          color: #fff;
          width: 36px;
          height: 36px;
          padding-top: 5px;
          border-radius: 50%;
          margin-left: auto;
          margin-right: auto;
        }
        
        header h2{
          color: #dc0;
          font-size: 40px;
          margin:5px 0;
          padding: 0;
          text-transform: uppercase;
          text-shadow: 1px 1px 1px #000
        }
        header p{
          color:#bbb
        }
        hgroup p{
            background: rgba(255,255,255,0.9);
            padding: 5px;
            float: left;
            font-size: 12px
        }
        .alert{
            font-size: 11px;
            text-align: left;
            padding: 5px
        }
        .alert button{
            display: none;
        }
        [type="text"]{
          border-radius: 0 !important;
          border-color: #7cb342;
          padding: 6px;
        }
        [type="password"]{
          border-radius: 0 !important;
          padding: 6px;
          border-color: #7cb342
        }
        button{
          width: 100% !important;
          border-radius: 0 !important
        }
        form.login p{
          color: #ddd;
          font-size: 12px;
          margin-top: 10px
        }
        .logo{
          width: 60px;
          height: : 60px;
        }
        .box-logo{
          width: 80px;
          height: 80px;
          overflow: hidden;
          margin: 20px auto 20px
        }
        .input-group-addon{
          background: #7cb342;
          border-color: #7cb342;
          color: #fff;
        }
        .btn-success{
          background: #090
        }
        .form-login .nama_pengguna{
          font-size: 20px;
          margin-bottom: 0
        }
        .form-login .level{
          color: #555
        } 
    </style>
</head>

<body>

    <div class="middle-box loginscreen animated flipInY">
        <div class="form-login">
            <h3 class="head"><i class="fa fa-sign-in"></i></h3>
            <form class="login" role="form" method="POST" action="<?php echo site_url($action)?>" autocomplete="off">
              <div class="box-logo">
                <img src="<?php echo base_url('assets/images/logo.png')?>" class="logo" alt="" />
              </div>
              <h4 class="nama_pengguna">Masuk</h4>
              <p class="level">Masukan Nama Pengguna dan Kata Sandi</p>

              <?php echo '<span style="text-align:center">'.$this->session->flashdata('info')."</span>";?>
              <div class="form-group">
                  <input type="text" placeholder="Nama Pengguna" class="form-control" name="nama_admin" required>
              </div>
              <div class="form-group">
                  <input type="password" placeholder="Kata Sandi" class="form-control" name="password" required="required">
              </div>
              <?php echo button_submit('login','Masuk','btn-success','')?>
              <p>&copy; 2016 | Aplikasi Agenda Surat</p>

            </form>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="<?php echo base_url('assets/js/jquery-2.1.1.js')?>"></script>
    <script src="<?php echo base_url('js/bootstrap.min.js')?>"></script>




</body></html>
