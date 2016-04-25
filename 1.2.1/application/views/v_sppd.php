      <?php if(isset($_GET['tambah']) OR isset($_GET['ubah'])){ ?>    <!--OPEN FORM -->
              <div class="col-lg-12 bg-white">
      <div class="ibox float-e-margins">
          <div class="ibox-title">
    			  <h5><i class="fa fa-plane"></i> Data Agenda SPPD
</h5>
      </div>
      <div class="ibox-content">
                    <form class="validate form-horizontal" method="POST" action="http://localhost/agendasurat/sppd">
                      <?php
                        if(isset($_GET['ubah'])){
                                $parameter='ubah';
                                $where=array(
                                  				'id_sppd' => $this->input->get('id'),
                                );
                                $row=$this->db->get_where('sppd',$where)->row();
                                $id_sppd = $row->id_sppd;
																$id_pegawai = $row->id_pegawai;
																$nomor_agenda = substr($row->nomor_agenda,4);
																$tujuan = $row->tujuan;
																$tanggal_mulai = $row->tanggal_mulai;
																$tanggal_sampai = $row->tanggal_sampai;
																$keperluan = $row->keperluan;
																$keterangan = $row->keterangan;
																$tanggal_simpan = date_dmy($row->tanggal_simpan);
                                $lama_penugasan=date_dmy($tanggal_mulai).' s/d '.date_dmy($tanggal_sampai);
                                $nomor_sppd = $row->nomor_sppd;
                        }
                        else{
                                $parameter='tambah';
                                $id_sppd = '';
																$id_pegawai = '';
																$nomor_agenda = '';
																$tujuan = '';
																$tanggal_mulai = '';
																$tanggal_sampai = '';
																$keperluan = '';
																$keterangan = '';
																$tanggal_simpan = '';
                                $lama_penugasan='';
                                $tanggal_simpan=date_dmy(date("Y-m-d"));
                                $get=$this->db->query("SELECT * FROM sppd WHERE nomor_agenda LIKE '".tahun_perencanaan()."%' ORDER BY nomor_agenda DESC LIMIT 1");
                                if($get->num_rows()>0){
                                  $row=$get->row();
                                  $nomor_agenda=(substr($row->nomor_agenda,4))+1;
                                  $nomor_agenda=(strlen($nomor_agenda)==1)?'0'.$nomor_agenda:$nomor_agenda;
                                }
                                else{
                                  $nomor_agenda='01';
                                }
                                $nomor_sppd = $nomor_agenda.'/SPPD/'.toromawi(date("m")).'/'.date("Y");

                        }
                    ?>
                        <?php echo input_hidden('parameter',$parameter)?>
                  			<?php echo input_hidden('id_sppd',$id_sppd,'','required');?>
												<div class="form-group">
														<label class="control-label col-lg-3">nomor agenda</label>
														<div class="col-lg-8">
																<?php echo input_text('nomor_agenda',$nomor_agenda,'','required');?>
														</div>
												</div>

												<div class="form-group">
														<label class="control-label col-lg-3">nama pegawai</label>
														<div class="col-lg-8">
																	<?php
                                        $op=NULL;
                                        $op['']='Pilih--';
                                        $this->db->order_by('id_jabatan','ASC');
																				$data=$this->db->get('pegawai');
																				foreach($data->result() as $row){
																					$op[$row->id_pegawai]=$row->nama_pegawai;
																				}
																		?>
																	<?php echo select('id_pegawai',$op,$id_pegawai,'','required');?>
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
																<?php echo input_text('lama_penugasan',$lama_penugasan,'daterangepicker','required');?>
														</div>
												</div>


                        <div class="form-group">
                            <label class="control-label col-lg-3">nomor sppd</label>
                            <div class="col-lg-8">
                                <?php echo input_text('nomor_sppd',$nomor_sppd,'','required');?>
                            </div>
                        </div>

												<div class="form-group">
														<label class="control-label col-lg-3">keperluan</label>
														<div class="col-lg-8">
																<?php echo textarea('keperluan',$keperluan,'','required');?>
														</div>
												</div>
												<div class="form-group">
														<label class="control-label col-lg-3">keterangan</label>
														<div class="col-lg-8">
																<?php echo textarea('keterangan',$keterangan,'','');?>
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
    			  <h5><i class="fa fa-plane"></i> Data Agenda SPPD
</h5>
      </div>
      <div class="ibox-content">
                    <a href="http://localhost/agendasurat/sppd?tambah" class="btn btn-success"><i class="fa plus"></i> Tambah</a>
                    <hr>
                    <?php echo $this->session->flashdata('info');?>
                    <?php echo $table;?>
          </div>
        </div>
      </div>
      <?php } ?>
<!--END TABLE-->
