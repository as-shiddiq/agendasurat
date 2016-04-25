      <?php if(isset($_GET['tambah']) OR isset($_GET['ubah'])){ ?>    <!--OPEN FORM -->
              <div class="col-lg-12 bg-white">
      <div class="ibox float-e-margins">
          <div class="ibox-title">
    			  <h5>Data Penugasan Untuk
</h5>
      </div>
      <div class="ibox-content">
                    <form class="validate form-horizontal" method="POST" action="http://localhost/agendasurat/subsurattugas/id/<?php echo $id_surat_tugas?>">
                      <?php
                        if(isset($_GET['ubah'])){
                                $parameter='ubah';
                                $where=array(
                                  				'id_sub_surat_tugas' => $this->input->get('id'),
                                );
                                $row=$this->db->get_where('sub_surat_tugas',$where)->row();
                                $id_sub_surat_tugas = $row->id_sub_surat_tugas;
																$id_surat_tugas = $row->id_surat_tugas;
																$id_pegawai = $row->id_pegawai;
                        }
                        else{
                                $parameter='tambah';
                                $id_sub_surat_tugas = '';
																$id_surat_tugas = $id_surat_tugas;
																$id_pegawai = '';

                        }
                    ?>
                        <?php echo input_hidden('parameter',$parameter)?>
                  			<?php echo input_hidden('id_sub_surat_tugas',$id_sub_surat_tugas,'','required');?>
                        <?php echo input_hidden('id_surat_tugas',$id_surat_tugas,'','required');?>
												<div class="form-group">
														<label class="control-label col-lg-3">nama pegawai</label>
														<div class="col-lg-8">
																	<?php
                                        $op=NULL;
                                        $op['']='Pilih--';
                                        $this->db->order_by('id_pegawai','ASC');
																				$data=$this->db->get('pegawai');
																				foreach($data->result() as $row){
                                          //cek duplikat
                                          $cek=$this->db->get_where("sub_surat_tugas",array("id_pegawai"=>$row->id_pegawai,"id_surat_tugas"=>$id_surat_tugas));
                                          if($cek->num_rows()==0){
                                            $op[$row->id_pegawai]=$row->nama_pegawai;
                                          }
																				}
																		?>
																	<?php echo select('id_pegawai',$op,$id_pegawai,'select','required');?>
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
    			  <h5>Data Penugasan Untuk
</h5>
      </div>
      <div class="ibox-content">
                    <a href="http://localhost/agendasurat/subsurattugas?tambah" class="btn btn-success"><i class="fa plus"></i> Tambah</a>
                    <hr>
                    <?php echo $this->session->flashdata('info');?>
                    <?php echo $table;?>
          </div>
        </div>
      </div>
      <?php } ?>
<!--END TABLE-->
