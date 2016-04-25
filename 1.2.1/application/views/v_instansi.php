      <?php if(isset($_GET['tambah']) OR isset($_GET['ubah'])){ ?>    <!--OPEN FORM -->
              <div class="col-lg-12 bg-white">
      <div class="ibox float-e-margins">
          <div class="ibox-title">
    			  <h5>Data Master Instansi
</h5>
      </div>
      <div class="ibox-content">
                    <form class="validate form-horizontal" method="POST" action="http://localhost/agendasurat/instansi">
                      <?php
                        if(isset($_GET['ubah'])){
                                $parameter='ubah';
                                $where=array(
                                  				'id_instansi' => $this->input->get('id'),
                                );
                                $row=$this->db->get_where('instansi',$where)->row();
                                $id_instansi = $row->id_instansi;
																$nama_instansi = $row->nama_instansi;
                        }
                        else{
                                $parameter='tambah';
                                $id_instansi = '';
																$nama_instansi = '';

                        }
                    ?>
                        <?php echo input_hidden('parameter',$parameter)?>
                        			<?php echo input_hidden('id_instansi',$id_instansi,'','required');?>
												<div class="form-group">
														<label class="control-label col-lg-3">nama instansi</label>
														<div class="col-lg-8">
																<?php echo input_text('nama_instansi',$nama_instansi,'','required');?>
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
    			  <h5>Data Master Instansi
</h5>
      </div>
      <div class="ibox-content">
                    <a href="http://localhost/agendasurat/instansi?tambah" class="btn btn-success"><i class="fa plus"></i> Tambah</a>
                    <hr>
                    <?php echo $this->session->flashdata('info');?>
                    <?php echo $table;?>
          </div>
        </div>
      </div>
      <?php } ?>
<!--END TABLE-->
