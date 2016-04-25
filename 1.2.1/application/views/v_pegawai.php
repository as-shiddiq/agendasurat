      <?php if(isset($_GET['tambah']) OR isset($_GET['ubah'])){ ?>    <!--OPEN FORM -->
              <div class="col-lg-12 bg-white">
      <div class="ibox float-e-margins">
          <div class="ibox-title">
    			  <h5>Data Master Pegawai
</h5>
      </div>
      <div class="ibox-content">
                    <form class="validate form-horizontal" method="POST" action="http://localhost/agendasurat/pegawai">
                      <?php
                        if(isset($_GET['ubah'])){
                                $parameter='ubah';
                                $where=array(
                                  				'id_pegawai' => $this->input->get('id'),
                                );
                                $row=$this->db->get_where('pegawai',$where)->row();
                                $id_pegawai = $row->id_pegawai;
																$id_jabatan = $row->id_jabatan;
																$nip = $row->nip;
																$nama_pegawai = $row->nama_pegawai;
																$status = $row->status;
																$level = $row->level;
                        }
                        else{
                                $parameter='tambah';
                                $id_pegawai = '';
																$id_jabatan = '';
																$nip = '';
																$nama_pegawai = '';
																$status = '';
																$level = '';

                        }
                    ?>
                        <?php echo input_hidden('parameter',$parameter)?>
                        <?php echo input_hidden('level',$level,'','required');?>
                  			<?php echo input_hidden('id_pegawai',$id_pegawai,'','required');?>
												<div class="form-group">
														<label class="control-label col-lg-3">nama jabatan</label>
														<div class="col-lg-8">
																	<?php
                                        $op=NULL;
                                        $op['']='Pilih--';
                                        $this->db->order_by('id_jabatan','ASC');
																				$data=$this->db->get('jabatan');
																				foreach($data->result() as $row){
                                          //cek jumlah yang sudah dipilih
                                          $cek=$this->db->get_where("pegawai",array("id_jabatan"=>$row->id_jabatan,"status"=>"aktif"));
                                          if($cek->num_rows()<=$row->kouta){
                                            $op[$row->id_jabatan]=$row->nama_jabatan;
                                          }
																				}
																		?>
																	<?php echo select('id_jabatan',$op,$id_jabatan,'','required');?>
														</div>
												</div>
												<div class="form-group">
														<label class="control-label col-lg-3">nip</label>
														<div class="col-lg-8">
																<?php echo input_text('nip',$nip,'','required');?>
														</div>
												</div>
												<div class="form-group">
														<label class="control-label col-lg-3">nama pegawai</label>
														<div class="col-lg-8">
																<?php echo input_text('nama_pegawai',$nama_pegawai,'','required');?>
														</div>
												</div>
												<div class="form-group">
														<label class="control-label col-lg-3">status</label>
														<div class="col-lg-8">
																	<?php
                                        $op=NULL;
                                        $op['']='Pilih--';
                                        $op['aktif']='Aktif';
																				$op['tidak aktif']='Tidak Aktif';
																	?>
																	<?php echo select('status',$op,$status,'','required');?>
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
    			  <h5>Data Master Pegawai
</h5>
      </div>
      <div class="ibox-content">
                    <a href="http://localhost/agendasurat/pegawai?tambah" class="btn btn-success"><i class="fa plus"></i> Tambah</a>
                    <hr>
                    <?php echo $this->session->flashdata('info');?>
                    <?php echo $table;?>
          </div>
        </div>
      </div>
      <?php } ?>
<!--END TABLE-->
