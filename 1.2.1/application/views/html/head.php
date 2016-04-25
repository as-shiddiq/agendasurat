    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="<?php echo base_url('assets/base/jquery-ui.css')?>" rel="stylesheet">

        <!-- core CSS -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/font-awesome/css/font-awesome.css')?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/css/dataTables.bootstrap.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/dataTables.responsive.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/dataTables.tableTools.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/datepicker.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/daterangepicker/daterangepicker-bs3.css')?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/css/prettyPhoto.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/animate.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/main.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/responsive.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/style.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/chosen.css')?>" rel="stylesheet">

    <!--[if lt IE 9]>
    originally design by nfw
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/ico/favicon.ico')?>">

   <style type="text/css">
   header .header {
     background: #9d7 url('<?=site_url('assets/images/background-login.jpg')?>');
     padding: 10px 25px
   }
   header .header .logo{
     width: 50px !important
   }
   .navbar {
        padding: 0 !important;
        min-height: auto !important;
        background: #7cb342 !important;
        border-bottom: 1px solid #030

   }
   .navbar-nav li a{
     color: #fff !important;
     font-weight: bold
   }
   .navbar-nav>li {
        margin-right: 10px;
        padding-bottom: 10px;
    }
    .navbar-inverse .navbar-nav > li > a:hover {
      background:#591;
        color: #fff !important;
    }
    .navbar-inverse .navbar-nav .dropdown-menu {
        background: #7cb342 !important;
    }


.navbar-inverse .navbar-nav > .active > a,
.navbar-inverse .navbar-nav > .active > a:hover,
.navbar-inverse .navbar-nav > .active > a:focus,
.navbar-inverse .navbar-nav > .open > a,
.navbar-inverse .navbar-nav > .open > a:hover,
.navbar-inverse .navbar-nav > .open > a:focus ,
.navbar-inverse .navbar-nav .dropdown-menu > li:hover > a,
.navbar-inverse .navbar-nav .dropdown-menu > li:focus > a,
.navbar-inverse .navbar-nav .dropdown-menu > li.active > a
{
      background:url('<?php echo base_url()?>assets/images/background.png') !important;
      color:#fff !important;
    }
    .ibox-title{
        background: #fff !important;
        padding:5px 15px;
        color: #fff;
        margin: -10px -15px 10px
    }
    .ibox-title h5{
        color: #fff
    }
    .widget {
        background: #c7d9ed;
        padding: 10px;
        color: #fff;
        box-shadow: 10px 10px 10px inset #000;
        border-right: 5px
    }
    .widget h2{
        color: #fff
    }


    /**PESAN**/
    .list-tujuan{
        list-style: none;
        padding: 0;
        margin: 0
    }
    .list-tujuan a{
        font-size: 15px
    }
    .list-tujuan li{
        border-bottom: 1px dotted #999;
        padding: 10px 0
    }

    .list-tujuan li img{
        width: 30px;
        float:left;
        margin: 5px 10px 0 0
    }

    .list-pesan{
        list-style: none;
        padding: 0;
        margin: 0
    }
    .list-pesan li {
        border-bottom: 1px dotted #999;
        padding: 10px 15px;
        background: #fafafa;
        margin-bottom: 10px
    }
    .list-pesan .odd{
        background: #eee
    }

    .list-pesan li img{
        width: 30px;
        float:left;
        margin: 0px 0px 0 0
    }
    .list-pesan li small{
        display: block;
    }
    .list-pesan li .nama{

        width: 25%;
        margin-left: 10px;
        border-right: 1px dotted #999;
        float: left
    }
    .list-pesan li .isi-pesan{
        width: 60%;
        float: left;
        padding-left: 10px
    }
    h2{
        font-size: 35px;

    }
    .ibox-title h5{
      color:#000
    }
    .ibox-title{
        border-bottom: 1px solid #ccc
    }
    textarea{
      border:1px solid #ddd !important
    }
    header h1 ,  header h1 a{
      font-size: 20px !important;
      color: #fff !important;
    }



    .foto img{
      border: 1px solid #999
    }
    .foto span{
      border: 1px solid #999;
      padding:5px;
      display: block;
      margin: 10px auto
    }
    .fc-red{
      color:#e00
    }
    .datepicker{
      z-index: 100000 !important
    }

    .sidebar{
      background: #fff
    }

    .sidebar ul{
      list-style: none;
      margin:0;
      padding: 0
    }
    .sidebar ul li{
      border: 1px solid #888;
      padding: 10px;
      margin-bottom: 10px
    }
    .sidebar ul li h3{
      color:#1f48a1;
      margin:-10px -10px 5px;
      padding: 10px;
      background: #c7d9ed;
      border-bottom: 1px solid #888;
      font-weight: bold
    }
    .error{
      color: #e00;
      font-weight: normal;
      text-decoration: italic
    }
    .content{
      background: #fff;
      min-height: 400px
    }
    @media (min-width: 1200px) {
      .content{
      }
      .sidebar{
        margin: 0 -15px 0 15px
      }
    }

    .btn-green{
      background: #7cb342;
      color:#fff
    }
    .btn-green:hover, .btn-green:focus{
      background: #070;
      color:#fff
    }
    .btn-green .badge{
      background: #fff;
      color:#7cb342;
    }
    .badge{
      padding: 2px 5px
    }
    .input-login{
      padding: 6px;
    }
    input,select,textarea,.btn,.alert{
      border-radius: 0 !important;
    }

    input,select,textarea,.chosen-container{
      border-radius: 0 !important;
    }

    <?php if($this->uri->segment('1')=='login'){ ?>
      .alert {
          padding-top: 6px;
          padding-bottom: 6px;
          margin-bottom: 0px;
          border: 1px solid transparent;
          border-radius: 0px;
          margin-top: 0px !important;
      }
    <?php }?>
    .container {
      width: 95%
    }
    header .header h1, header .header h1 a{
      color: #888;
      font-size: 26px !important;
      margin: 0;
    }
    header .header h2{
      font-size:16px;
      color: #ddd
    }
    header .header p{
      color: #ddd;
      margin: 0;
      padding: 0
    }
    .bg-white{
      background: #fff
    }
    a{
      color: #7cb342
    }
    .menu li a i{
      color: #000
    }
    .table .dropdown-menu {
      position: absolute;
      top:auto;
      left: auto;
      z-index: 1000;
      float: right;
      min-width: auto;
      font-size: 14px;
      list-style: none;
      padding: 0;
      margin: 0;
      border: 0;
      border-radius: 0px;
      -webkit-box-shadow: 0 6px 12px rgba(0,0,0,0.175);
      box-shadow: 0 6px 12px rgba(0,0,0,0.175);
      background-clip: padding-box;
      background: #292;
      color: #eee;
      text-align: left
  }
  .table .dropdown-menu a{
    color: #eee;
    padding: 8px 30px 8px 10px
  }
  .table [data-toggle="dropdown"]{
    background: #292;
    color: #eee;
    border: 0
  }

  .table [data-toggle="dropdown"]:focus{
    background: #292;
    color: #eee
  }
  input.daterangepicker{
    position: static;
  }


  .data-pelatihan{
    background: #eee
  }
  .data-pelatihan header{
    border-bottom: 1px solid #fff;
    margin: 0 -15px;
    padding: 15px
  }
  .data-pelatihan header h4{
    margin: 0 0 5px;
    padding: 0;
    color: #7cb342
  }
  .data-pelatihan section{
    padding: 10px 0
  }
  .data-pelatihan section .btn{
    margin-top: 10px
  }
  .data-pelatihan section .total-peserta{
    display: block;
    color: #7cb342
  }


    .menu{
      list-style: none;
      padding: 0;
      margin: 0;
      background: #f3f9ff;
      padding: 10px
    }
    .menu li{
      text-align: center;
      width: auto;
      display: inline-block;
      background: #e6f0fa;
      border: 1px solid #9fb2c7;
      padding: 10px;
      border-radius: 4px

    }
    .menu li a{
      color: #000
    }
    .menu img{
      display: block;
    }

    .fm{
      text-align: center;
      overflow: hidden;
      margin-bottom: 15px
    }
    .fm .d{
      border: 1px solid #ccc;

    }
    .fm h3{
      border-bottom: 1px solid #ccc;
      padding: 10px;
      margin-bottom: 30px;
      font-size: 14px;
      white-space: pre;;
    }
    .fm p{
      font-size: 16px;
      margin: 20px 10px;
      font-weight: bold;
    }
    .fm .d:hover,
    .fm .d:focus,.fm.click .d{
      background: #ddd
    }

    .fn{
      padding: 30px 10px ;
      border-bottom: 1px solid #ccc
    }

    .fc-green{
      color: #7cb342;
      font-weight: bold
    }
    .head-section{
      background: #7cb342;
      margin:10px 0px 10px;
      padding: 10px 15px;
      color: #fff
    }

    .list-me{
      list-style: none;
      padding:0;
      margin: 0
    }
    .list-me li{
      border-bottom:1px solid #eee;
      padding-bottom: 0 ;
      display: block
    }
    .list-me li div.checkbox-left{
      width:7%;
      float:left;
      margin:0
    }
    .list-me li div.checkbox-content{
       width:93%;
       float:left;
    }
    .list-me li:first-child div.checkbox-content{
       width:95%;
       float:left;
    }
    .list-me li:first-child div.checkbox-left{
      width:5%;
      float:left;
      padding:0;
      margin:0
    }
    .list-me li .checkbox-left input{
      
      padding:0;
      margin:0
    }
    .list-me li .bidang{
      display: block;
      font-weight: normal;
      font-size: 12px
    }


  .notif{
    position:fixed;
    top:0;
    right:0;
    margin-right: 5px;
    margin-top: 5px;
  }
  .notif li{
    display: block;
    transition: .1s;
    margin-bottom: 5px;
    background:#090;
    color:#fff;
    padding:10px;
  }
  .notif li.error{
    display: block;
    transition: .1s;
    margin-bottom: 5px;
    background:#a00;
    color:#fff;
    padding:10px;
  }



  .lockscreen{
    position: fixed;
    top:0;
    background-image: url('<?php echo base_url('assets/images/background-login.jpg')?>');
    z-index: 1000;
    width: 100%;
    height: 100%

  }
 .lockscreen .logo {
          text-align: center !important
      }
  .lockscreen .logo img {
      width:100px;
      display: block;
      margin:auto;
      text-align:center;
  }
  .lockscreen .form-login .nama_pengguna{
    font-size: 20px;
    margin-bottom: 0
  }
  .lockscreen .form-login .level{
    color: #555
  } 
  .lockscreen .form-login .head{
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
  .lockscreen .form-login{
      padding:20px 40px !important;
      width: 340px;
      text-align: center;
      margin: auto;
      margin: auto
  }
  .lockscreen .loginscreen{
      width:30%;
      margin: auto;
      margin-top: 10%;
      position: fixed;
      left: 35%;
      right: 35%
  }
  .lockscreen hgroup{
      top:0;
      text-align: left;
  }
 .lockscreen  hgroup h1{
      background: rgba(255,255,255,0.9);
      padding: 10px;
      font-size: 30px;
      margin: 10px 0 5px 0;
      color: #0B723E !important
  }
  .lockscreen .form-login h3{
    color: #444;
    margin: 17px 0 30px;
    text-transform: uppercase;
    padding: 0;
  }
  .lockscreen header h2{
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
    color: #555;
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

   </style>
