<div class="col-lg-12 bg-white">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5><?php echo icon('home')?> Beranda</h5>
        </div>
        <div class="ibox-content">

          <?php echo $this->session->flashdata('info');?>
          <h3 class="head-section">Data Surat Masuk yang Belum di Disposisi</h3>
          <?php $this->load->view("home/v_disposisisurat")?>
          <h3 class="head-section">Data Surat Masuk yang Menunggu Konfirmasi</h3>
          <?php $this->load->view("home/v_konfirmasisurat")?>
          <h3 class="head-section">Data Undangan yang Belum di Disposisi</h3>
          <?php $this->load->view("home/v_disposisiundangan")?>
          <h3 class="head-section">Data Undangan yang Menunggu Konfirmasi</h3>
          <?php $this->load->view("home/v_konfirmasiundangan")?>

          <h3 class="head-section">Data Seretariat yang Menunggu Konfirmasi</h3>
          <?php $this->load->view("home/v_konfirmasibidang")?>
          <div class="clearfix">

          </div>
          <br>
        </div>
   	</div>
</div>
<div id="add-moment">
  <a class="md-fab md-fab-success plus" href="#" id="plus-ex">
      <i class="fa fa-plus button-me"></i>
  </a>
<ul id="moment-buttons">
  <li class="icon-picture" data-uk-tooltip="{pos:'top'}" title="Tambah SPPD"><a href="<?=site_url("sppd?tambah")?>"><i class="fa fa-plane"></i></a></li>
  <li class="icon-people" data-uk-tooltip="{pos:'top'}" title="Tambah Telaahan Staf"><a href="<?=site_url("telaahanstaf?tambah")?>"><i class="fa fa-users"></i></a></a></li>
  <li class="icon-place" data-uk-tooltip="{pos:'left'}" title="Tambah Surat Tugas"><a href="<?=site_url("surattugas?tambah")?>"><i class="fa fa-thumb-tack"></i></a></a></li>
  <li class="icon-music" data-uk-tooltip="{pos:'left'}" title="Tambah Surat Keluar"><a href="<?=site_url("suratkeluar?tambah")?>"><i class="fa fa-envelope-o"></i></a></a></li>
  <li class="icon-thought" data-uk-tooltip="{pos:'left'}" title="Tambah Undangan"><a href="<?=site_url("suratmasukundangan?tambah")?>"><i class="fa fa-calendar"></i></a></a></li>
  <li class="icon-sleep"  data-uk-tooltip="{pos:'left'}" title="Tambah Surat Masuk"><a href="<?=site_url("suratmasuk?tambah")?>"><i class="fa fa-envelope"></i></a></a></li>
</ul>
</div>
<style media="screen">
.button-me{
  background: #7cb342;
  font-size: 50px;
  width: 70px;
  height: 70px;
  padding: 13px 0 0 15px;
  border-radius: 50%;
  box-shadow: 2px 2px 10px #333;
  color: #fff
}
#moment-buttons.out{
  z-index: 100;
  display: block;
}
#moment-buttons {
  z-index: -1
}
#moment-buttons li a{
  color: #fff;
}
#moment-buttons li{
  width: 60px;
  padding: 16px 0 !important;
  box-shadow: 1px 1px 10px 0px #555;
  height: 60px;
  border-radius: 50%;
  font-size: 25px;
  font-weight: normal;
  color: #b00;
  text-align: center;
}
#moment-buttons li.out{
  display: inherit;
  transition: 1s
}
::-moz-selection {
background: #fe57a1;
color: #fff;
text-shadow: none;
}
::selection {
background: #fe57a1;
color: #fff;
text-shadow: none;
}
/* Main Styles
================================================================= */

#add-moment {
position: fixed;
z-index: 1000;
bottom: 30px;
right: 0px;
margin: 0;
padding: 0;
width: 104px;
height: 104px;
}
#plus-ex {
position: absolute;
bottom: 0;
left: 0;
z-index: 9000;
-webkit-transition: all .3s ease;
}
#add-moment ul {
margin: 0;
padding: 0;
position: absolute;
bottom: 60px;
left: 0px
}
#add-moment li {
list-style: none;
position: absolute;
margin: 0;
padding: 0;
z-index: 100000;
box-shadow: none;
-webkit-transition: all .4s ease-in-out;
}
/* CSS3 Animations
================================================================= */

.plus {
-webkit-transform: rotate(0deg);
}
.ex {
-webkit-transform: rotate(-45deg);
}
.icon-picture.out {
top: -265px;
background: #0aa;
box-shadow: 1px 1px 10px 0px #555 !important;
-webkit-transform: rotate(-720deg);
}
.icon-people.out {
  background: #a0a;
top: -251px;
left: -91px;
box-shadow: 1px 1px 10px 0px #555 !important;
-webkit-transform: rotate(-720deg);
}
.icon-place.out {
  background: #d22;
top: -213px;
left: -167px;
box-shadow: 1px 1px 10px 0px #555 !important;
-webkit-transform: rotate(-720deg);
}
.icon-music.out {
  background: #04d;
top: -153px;
left : -227px;
box-shadow: 1px 1px 10px 0px #555 !important;
-webkit-transform: rotate(-720deg);
}
.icon-thought.out {
  background: #d90;
left: -265px;
top: -77px;
box-shadow: 1px 1px 10px 0px #555 !important;
-webkit-transform: rotate(-720deg);
}
.icon-sleep.out {
  background: #593;
left: -279px;
box-shadow: 1px 1px 10px 0px #555 !important;
-webkit-transform: rotate(-720deg);
}
</style>
