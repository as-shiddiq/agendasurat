    <?php if(isset($_GET['tambah']) OR isset($_GET['ubah'])){ ?>    <!--OPEN FORM -->

        <div class="col-lg-12 bg-white">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><i class="fa bars"></i> Form pengguna</h5>
                </div>
                <div class="ibox-content">
                    <form class="validate form-horizontal" method="POST" action="<?php echo site_url('pengguna')?>">
                    <?php
                            if(isset($_GET['ubah'])){
                                $parameter='ubah';
                                $where=array(
                                'id_pengguna'=>$this->input->get('id'),
                              );
                                $row=$this->db->get_where('pengguna',$where)->row();
                                $id_pengguna=$row->id_pengguna;
                                $nama_pengguna=$row->nama_pengguna;
                        				$password=$row->password;
                                $level=$row->level;
				                            }
                            else{
                                $parameter='tambah';
                                $id_pengguna='';
                        				$nama_pengguna='';
                                $password='';
                        				$level='';

                            }
                    ?>
                        <?php echo input_hidden('parameter',$parameter)?>
                    		<?php echo input_hidden('id_pengguna',$id_pengguna,'required')?>
                		    <?php echo input_hidden('def',$nama_pengguna,'required')?>
                        <div class="form-group">
                        	<label class="control-label col-lg-3">Nama pengguna</label>
                        	<div class="col-lg-8">
                        		<?php echo input_text('nama_pengguna',$nama_pengguna,'required')?>
                        	</div>
                        </div>
                        <div class="form-group">
                        	<label class="control-label col-lg-3">Password</label>
                        	<div class="col-lg-8">
                        		<?php echo input_password('password',$password,'required')?>
                        	</div>
                        </div>
                        <div class="form-group">
                        	<label class="control-label col-lg-3">Level</label>
                        	<div class="col-lg-8">
                            <?php if($this->session->userdata('level')=='superadmin'){ ?>
                            <?php
                              $op=null;
                              $op['']="Pilih";
                              $op['superadmin']="Superadmin";
                              $op['user']='User';
                             ?>
                        		<?php echo select('level',$op,$level,'required')?>
                            <?php } else { ?>
                              <?php echo input_hidden('level','user','required')?>
                            <?php } ?>
                        	</div>
                        </div>
                        <div class="form-group">
                        	<label class="control-label col-lg-3"></label>
                        	<div class="col-lg-8">
                              <button type="submit" name="simpan" class="btn btn-info">Simpan</button>
  														<a href="javascript:history.go(-1)" class="btn btn-danger">Batal</a>
                          </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <?php } else { ?>
<!--END FORM -->

<!--OPEN TABLE-->

        <div class="col-lg-12 bg-white">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><i class="fa fa-bars"></i> Data pengguna</h5>
                </div>
                <div class="ibox-content">
                    <?php echo anchor(site_url('pengguna?tambah'),icon('plus').' Tambah','btn btn-success')?>

                    <hr>
                        <?php echo $this->session->flashdata('info');?>

                        <?php echo $table;?>
                </div>
            </div>
        </div>
        <?php } ?>
<!--END TABLE-->
