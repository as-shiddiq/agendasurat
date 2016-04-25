<header>
        <!--HEADER -->
        <div class="header">
            <div class="container">
            <img src="<?php echo base_url('assets/images/logo.png')?>  " class="logo">
                    <h2>Badan Perencanaan dan Pembangungn Daerah Kabupaten Tanah laut</h2>
                    <h1>Aplikasi Agenda Surat</h1>
                    <p>Tahun Anggaran <?php echo tahun_perencanaan()?></p>

            </div>
        </div>
        <div style="clear:both"></div>
        <!-- MENU-->
         <nav class="navbar navbar-inverse" role="banner">
            <div class="container">

                <div class="col-lg-12">
                    <ul class="nav navbar-nav">
                      <li>
                          <a href="<?php echo site_url('home')?>"><i class="fa fa-home"></i> <span class="nav-label">Beranda</span></a>
                      <li>
                          <a href="<?php echo site_url('suratmasuk')?>"><i class="fa fa-envelope"></i> <span class="nav-label">Surat Masuk</span></a>
                      </li>
                      <li>
                          <a href="<?php echo site_url('suratmasukundangan')?>"><i class="fa fa-calendar"></i> <span class="nav-label">Undangan</span></a>
                      </li>
                      <li>
                          <a href="<?php echo site_url('suratkeluar')?>"><i class="fa fa-envelope-o"></i> <span class="nav-label">Surat Keluar</span></a>
                      </li>
                      <li>
                          <a href="<?php echo site_url('telaahanstaf')?>"><i class="fa fa-users"></i> <span class="nav-label">Telaahan Staf</span></a>
                      </li>
                      <li>
                          <a href="<?php echo site_url('surattugas')?>"><i class="fa fa-thumb-tack"></i> <span class="nav-label">Surat Tugas</span></a>
                      </li>
                      <li>
                          <a href="<?php echo site_url('sppd')?>"><i class="fa fa-plane"></i> <span class="nav-label">SPPD</span></a>
                      </li>
                      <!--<li>
                          <a href="<?php echo site_url('arsip')?>"><i class="fa fa-file"></i> <span class="nav-label">Laporan</span></a>
                      </li>-->
                    </li>
                    <li>
                      <a data-toggle="dropdown" href="<?php echo site_url('pendidikan')?>"><i class="fa fa-gears"></i> <span class="nav-label">Pengaturan</span> <b class="caret"></b></a>
                      <ul class="dropdown-menu ">
                        <li><?php echo anchor(site_url('pegawai'),'Pegawai')?></li>
                        <li><?php echo anchor(site_url('jabatan'),'Jabatan')?></li>
                        <li><?php echo anchor(site_url('bidang'),'Bidang')?></li>
                        <li><?php echo anchor(site_url('pengguna'),'Pengguna')?></li>
                        <li><?php echo anchor(site_url('instansi'),'Instansi')?></li>
                        <li><?php echo anchor(site_url('database'),'Database Tools')?></li>
                        <li><?php echo anchor(site_url('sistem'),'Sistem')?></li>
                        <li><?php echo anchor(site_url('update'),'Update')?></li>
                      </ul>
                    </li>
                      <li>
                          <a href="<?php echo site_url('login/logout')?>"><i class="fa fa-sign-out"></i> <span class="nav-label">Keluar</span></a>
                      </li>

                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->


    </header><!--/header-->
