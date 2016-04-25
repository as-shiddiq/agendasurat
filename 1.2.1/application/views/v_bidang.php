      <?php if(isset($_GET['tambah']) OR isset($_GET['ubah'])){ ?>    <!--OPEN FORM -->
              <div class="col-lg-12 bg-white">
      <div class="ibox float-e-margins">
          <div class="ibox-title">
    			  <h5>Data Master Bidang
</h5>
      </div>
      <div class="ibox-content">
                    <form class="validate form-horizontal" method="POST" action="http://localhost/agendasurat/bidang">
                      <?php
                        if(isset($_GET['ubah'])){
                                $parameter='ubah';
                                $where=array(
                                  				'id_bidang' => $this->input->get('id'),
                                );
                                $row=$this->db->get_where('bidang',$where)->row();
                                $id_bidang = $row->id_bidang;
																$nama_bidang = $row->nama_bidang;
																$singkatan_bidang = $row->singkatan_bidang;
																$kode_surat = $row->kode_surat;
                                $id_parent_bidang=$row->id_parent_bidang;
                        }
                        else{
                                $parameter='tambah';
                                $id_bidang = '';
																$nama_bidang = '';
																$singkatan_bidang = '';
																$kode_surat = '';
                                $id_parent_bidang='';

                        }
                    ?>
                        <?php echo input_hidden('parameter',$parameter)?>
                        			<?php echo input_hidden('id_bidang',$id_bidang,'','required');?>
												<div class="form-group">
														<label class="control-label col-lg-3">nama bidang</label>
														<div class="col-lg-8">
																<?php echo input_text('nama_bidang',$nama_bidang,'','required');?>
														</div>
												</div>
												<div class="form-group">
														<label class="control-label col-lg-3">singkatan bidang</label>
														<div class="col-lg-8">
																<?php echo input_text('singkatan_bidang',$singkatan_bidang,'','required');?>
														</div>
												</div>
												<div class="form-group">
														<label class="control-label col-lg-3">kode surat</label>
														<div class="col-lg-8">
																<?php echo input_text('kode_surat',$kode_surat,'','required');?>
														</div>
												</div>
                        <div class="form-group">
                            <label class="control-label col-lg-3">paret bidang</label>
                            <div class="col-lg-8">
                                  <?php
                                        $op=NULL;
                                        $op['0']='Tidak ada';
                                        $this->db->order_by('id_bidang','ASC');
                                        $data=$this->db->get_where('bidang',array("id_parent_bidang"=>0));
                                        foreach($data->result() as $row){
                                          $op[$row->id_bidang]=$row->nama_bidang;
                                        }
                                    ?>
                                  <?php echo select('id_parent_bidang',$op,$id_parent_bidang,'','required');?>
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
    			  <h5>Data Master Bidang
</h5>
      </div>
      <div class="ibox-content">
                    <a href="http://localhost/agendasurat/bidang?tambah" class="btn btn-success"><i class="fa plus"></i> Tambah</a>
                    <hr>
                    <?php echo $this->session->flashdata('info');?>
                    <?php echo $table;?>
          </div>
        </div>
      </div>
      <?php } ?>
<!--END TABLE-->
