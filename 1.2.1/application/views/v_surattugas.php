      <?php if(isset($_GET['tambah']) OR isset($_GET['ubah'])){ ?>    <!--OPEN FORM -->
              <div class="col-lg-12 bg-white">
      <div class="ibox float-e-margins">
          <div class="ibox-title">
    			  <h5><i class="fa fa-thumb-tack"></i> Data Agenda Surat Tugas
</h5>
      </div>
      <div class="ibox-content">
                    <form class="validate form-horizontal" method="POST" action="http://localhost/agendasurat/surattugas">
                      <?php
                        if(isset($_GET['ubah'])){
                                $parameter='ubah';
                                $where=array(
                                  				'id_surat_tugas' => $this->input->get('id'),
                                );
                                $row=$this->db->get_where('surat_tugas',$where)->row();
                                $id_surat_tugas = $row->id_surat_tugas;
																$nomor_agenda = substr($row->nomor_agenda,4);
																$tujuan = $row->tujuan;
																$tanggal_mulai = date_dmy($row->tanggal_mulai);
																$tanggal_sampai = date_dmy($row->tanggal_sampai);
                                $tanggal_berlaku=$tanggal_mulai.' s/d '.$tanggal_sampai;
																$keperluan = $row->keperluan;
																$nomor_surat = $row->nomor_surat;
																$tanggal_simpan = date_dmy($row->tanggal_simpan);
                                $tanggal_surat = $row->tanggal_surat;
                        }
                        else{
                                $parameter='tambah';
                                $id_surat_tugas = '';
																$nomor_agenda = '';
																$tujuan = '';
																$tanggal_mulai = '';
																$tanggal_sampai = '';
																$keperluan = '';
                                $tanggal_berlaku='';
                                $tanggal_simpan=date_dmy(date("Y-m-d"));
                                $tanggal_surat=date_dmy(date("Y-m-d"));
                                $get=$this->db->query("SELECT * FROM surat_tugas WHERE nomor_agenda LIKE '".tahun_perencanaan()."%' ORDER BY nomor_agenda DESC LIMIT 1");
                                if($get->num_rows()>0){
                                  $row=$get->row();
                                  $nomor_agenda=(substr($row->nomor_agenda,4))+1;
                                  $nomor_agenda=(strlen($nomor_agenda)==1)?'0'.$nomor_agenda:$nomor_agenda;
                                }
                                else{
                                  $nomor_agenda='01';
                                }
                                $nomor_surat = '094/'.$nomor_agenda.'/'.toromawi(date("m")).'/'.date("Y");


                        }
                    ?>
                        <?php echo input_hidden('parameter',$parameter)?>
                        			<?php echo input_hidden('id_surat_tugas',$id_surat_tugas,'','required');?>
												<div class="form-group">
														<label class="control-label col-lg-3">nomor agenda</label>
														<div class="col-lg-8">
																<?php echo input_text('nomor_agenda',$nomor_agenda,'','required');?>
														</div>
												</div>
												<div class="form-group">
														<label class="control-label col-lg-3">tujuan</label>
														<div class="col-lg-8">
																<?php echo input_text('tujuan',$tujuan,'','required');?>
														</div>
												</div>
												<div class="form-group">
														<label class="control-label col-lg-3">lama penugasan</label>
														<div class="col-lg-8">
																<?php echo input_text('tanggal_berlaku',$tanggal_berlaku,'daterangepicker','required');?>
														</div>
												</div>
												<div class="form-group">
														<label class="control-label col-lg-3">nomor surat</label>
														<div class="col-lg-8">
																<?php echo input_text('nomor_surat',$nomor_surat,'','required');?>
														</div>
												</div>

                        <div class="form-group">
                            <label class="control-label col-lg-3">tanggal surat</label>
                            <div class="col-lg-8">
                                <?php echo input_text('tanggal_surat',$tanggal_surat,'datepicker','required');?>
                            </div>
                        </div>

												<div class="form-group">
														<label class="control-label col-lg-3">keperluan</label>
														<div class="col-lg-8">
																<?php echo textarea('keperluan',$keperluan,'','required');?>
														</div>
												</div>

                        <div class="form-group">
                            <label class="control-label col-lg-3">tanggal simpan</label>
                            <div class="col-lg-8">
                                <?php echo input_text('tanggal_simpan',$tanggal_simpan,'datepicker','required');?>
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
      <script type="text/javascript">
      $("[name=tujuan]").autocomplete({
          source: "<?php echo site_url('instansi/ajax')?>",
          minLength: 2,
        });

      </script>
        <?php } else { ?>
<!--END FORM -->

<!--OPEN TABLE-->
  <div class="col-lg-12 bg-white">
      <div class="ibox float-e-margins">
          <div class="ibox-title">
    			  <h5><i class="fa fa-thumb-tack"></i> Data Agenda Surat Tugas
</h5>
      </div>
      <div class="ibox-content">
                    <a href="http://localhost/agendasurat/surattugas?tambah" class="btn btn-success"><i class="fa plus"></i> Tambah</a>
                    <hr>
                    <?php echo $this->session->flashdata('info');?>
                    <?php echo $table;?>
          </div>
        </div>
      </div>
      <?php } ?>
<!--END TABLE-->
