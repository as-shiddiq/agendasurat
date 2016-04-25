      <?php if(isset($_GET['tambah']) OR isset($_GET['ubah'])){ ?>    <!--OPEN FORM -->
              <div class="col-lg-12 bg-white">
      <div class="ibox float-e-margins">
          <div class="ibox-title">
    			  <h5>Data Master Jabatan
</h5>
      </div>
      <div class="ibox-content">
                    <form class="validate form-horizontal" method="POST" action="http://localhost/agendasurat/jabatan">
                      <?php
                        if(isset($_GET['ubah'])){
                                $parameter='ubah';
                                $where=array(
                                  				'id_jabatan' => $this->input->get('id'),
                                );
                                $row=$this->db->get_where('jabatan',$where)->row();
                                $id_jabatan = $row->id_jabatan;
																$id_bidang = $row->id_bidang;
																$nama_jabatan = $row->nama_jabatan;
																$id_parent_jabatan = $row->id_parent_jabatan;
                                $kouta=$row->kouta;
                                $level=$row->level;
                        }
                        else{
                                $parameter='tambah';
                                $id_jabatan = '';
																$id_bidang = '';
																$nama_jabatan = '';
                                $id_parent_jabatan = '';
																$kouta = '1';
                                $level='umum';

                        }
                    ?>
                        <?php echo input_hidden('parameter',$parameter)?>
                  			<?php echo input_hidden('id_jabatan',$id_jabatan,'','required');?>
												<div class="form-group">
														<label class="control-label col-lg-3">nama bidang</label>
														<div class="col-lg-8">
																	<?php
                                        $op=NULL;
                                        $op['']='Pilih--';
                                        $this->db->order_by('id_bidang','DESC');
																				$data=$this->db->get('bidang');
																				foreach($data->result() as $row){
																					$op[$row->id_bidang]=$row->nama_bidang;
																				}
																		?>
																	<?php echo select('id_bidang',$op,$id_bidang,'','required');?>
														</div>
												</div>
												<div class="form-group">
														<label class="control-label col-lg-3">nama jabatan</label>
														<div class="col-lg-8">
																<?php echo input_text('nama_jabatan',$nama_jabatan,'','required');?>
														</div>
												</div>
                        <div class="form-group">
                            <label class="control-label col-lg-3">parent jabatan</label>
                            <div class="col-lg-8">
                                  <?php
                                        $op=NULL;
                                        $op['']='Tidak Ada';
                                        $this->db->order_by('id_jabatan','ASC');
                                        $data=$this->db->get('jabatan');
                                        foreach($data->result() as $row){
                                          $op[$row->id_jabatan]=$row->nama_jabatan;
                                        }
                                    ?>
                                  <?php
                                  $cek=$this->db->get_where('jabatan',array("id_parent_jabatan"=>null));
                                  if($cek->num_rows()>0){
                                    $op['']='Pilih--';
                                    if($parameter=='ubah'){
                                      if($id_parent_jabatan==null){
                                        $op['']='Tidak Ada';
                                        echo select('id_parent_jabatan',$op,$id_parent_jabatan,'','');
                                      }
                                      else{
                                        echo select('id_parent_jabatan',$op,$id_parent_jabatan,'','required');
                                      }
                                    }
                                    else{
                                      echo select('id_parent_jabatan',$op,$id_parent_jabatan,'','required');
                                    }
                                  }
                                  else{
                                    echo select('id_parent_jabatan',$op,$id_parent_jabatan,'','');
                                  }
                                  ?>
                            </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-lg-3">Level</label>
                          <div class="col-lg-8">
                            <?php
                              $op=null;
                              $op['']="Pilih";
                              $op['kepala']="Kepala";
                              $op['umum']='Umum';
                             ?>
                            <?php echo select('level',$op,$level,'required')?>
                          </div>
                        </div>

												<div class="form-group">
														<label class="control-label col-lg-3">Kouta</label>
														<div class="col-lg-8">
																<?php echo input_text('kouta',$kouta,'','required');?>
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
    			  <h5>Data Master Jabatan
</h5>
      </div>
      <div class="ibox-content">
                    <a href="http://localhost/agendasurat/jabatan?tambah" class="btn btn-success"><i class="fa plus"></i> Tambah</a>
                    <hr>
                    <?php echo $this->session->flashdata('info');?>
                    <?php echo $table;?>
          </div>
        </div>
      </div>
      <?php } ?>
<!--END TABLE-->
