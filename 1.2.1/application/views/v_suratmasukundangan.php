      <?php if(isset($_GET['tambah']) OR isset($_GET['ubah'])){ ?>    <!--OPEN FORM -->
              <div class="col-lg-12 bg-white">
      <div class="ibox float-e-margins">
          <div class="ibox-title">
    			  <h5><i class="fa fa-calendar"></i> Data Agenda Surat Masuk Undangan
</h5>
      </div>
      <div class="ibox-content">
                    <form class="validate form-horizontal" method="POST" action="http://localhost/agendasurat/suratmasukundangan">
                      <?php
                        if(isset($_GET['ubah'])){
                                $parameter='ubah';
                                $where=array(
                                  				'id_surat_masuk_undangan' => $this->input->get('id'),
                                );
                                $row=$this->db->get_where('surat_masuk_undangan',$where)->row();
                                $id_surat_masuk_undangan = $row->id_surat_masuk_undangan;
                                $nomor_agenda = substr($row->nomor_agenda,4);
																$pengirim = $row->pengirim;
																$nomor_surat = $row->nomor_surat;
																$tanggal_surat = date_dmy($row->tanggal_surat);
																$tempat = $row->tempat;
																$tanggal_mulai = date_dmy($row->tanggal_mulai);
																$tanggal_sampai = date_dmy($row->tanggal_sampai);
                                $tanggal_undangan=$tanggal_mulai.' s/d '.$tanggal_sampai;
																$waktu = $row->waktu;
																$perihal = $row->perihal;
																$status = $row->status;
																$tanggal_simpan = date_dmy($row->tanggal_simpan);
                                $waktu_mulai=$row->waktu_mulai;
                                $waktu_sampai=($row->waktu_sampai=='00:00:00')?"":$row->waktu_sampai;
                        }
                        else{
                                $parameter='tambah';
                                $id_surat_masuk_undangan = '';
																$nomor_agenda = '';
																$pengirim = '';
																$nomor_surat = '';
																$tanggal_surat = '';
																$tempat = '';
																$tanggal_mulai = '';
																$tanggal_sampai = '';
                                $tanggal_undangan='';
																$waktu = '';
																$perihal = '';
                                $waktu_mulai='';
                                $waktu_sampai='';
																$status = 'proses';
                                $tanggal_simpan=date_dmy(date("Y-m-d"));
                                $get=$this->db->query("SELECT * FROM surat_masuk_undangan WHERE nomor_agenda LIKE '".tahun_perencanaan()."%' ORDER BY nomor_agenda DESC LIMIT 1");
                                if($get->num_rows()>0){
                                  $row=$get->row();
                                  $nomor_agenda=(substr($row->nomor_agenda,4))+1;
                                  $nomor_agenda=(strlen($nomor_agenda)==1)?'0'.$nomor_agenda:$nomor_agenda;
                                }
                                else{
                                  $nomor_agenda='01';
                                }

                        }
                    ?>
                        <?php echo input_hidden('parameter',$parameter)?>
                        <?php echo input_hidden('id_surat_masuk_undangan',$id_surat_masuk_undangan,'','required');?>
                        <?php echo input_hidden('def_nomor_agenda',$nomor_agenda,'','required');?>
												<div class="form-group">
														<label class="control-label col-lg-3">nomor agenda</label>
														<div class="col-lg-8">
																<?php echo input_text('nomor_agenda',$nomor_agenda,'','required');?>
														</div>
												</div>
												<div class="form-group">
														<label class="control-label col-lg-3">pengirim</label>
														<div class="col-lg-8">
																<?php echo input_text('pengirim',$pengirim,'','required');?>
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
														<label class="control-label col-lg-3">tempat</label>
														<div class="col-lg-8">
																<?php echo input_text('tempat',$tempat,'','required');?>
														</div>
												</div>
												<div class="form-group">
														<label class="control-label col-lg-3">tanggal undangan</label>
														<div class="col-lg-8">
																<?php echo input_text('tanggal_undangan',$tanggal_undangan,'daterangepicker','required');?>
														</div>
												</div>
												<div class="form-group">
														<label class="control-label col-lg-3">waktu</label>
														<div class="col-lg-4">
																<?php echo input_time('waktu_mulai',$waktu_mulai,'','required');?>
														</div>
														<div class="col-lg-4">
																<?php echo input_time('waktu_sampai',$waktu_sampai,'','');?>
														</div>
												</div>
												<div class="form-group">
														<label class="control-label col-lg-3">perihal</label>
														<div class="col-lg-8">
																<?php echo textarea('perihal',$perihal,'','required');?>
														</div>
												</div>
												<div class="form-group">
														<label class="control-label col-lg-3">status</label>
														<div class="col-lg-8">
																	<?php
                                        $op=NULL;
                                        $op['']='Pilih--';
                                        $op['proses']='Proses';
																				$op['disposisi']='Disposisi';
                                        $op['konfirmasi']='Konfirmasi';
																	?>
																	<?php echo select('status',$op,$status,'','required');?>
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
      $("[name=pengirim]").autocomplete({
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
    			  <h5><i class="fa fa-calendar"></i> Data Agenda Surat Masuk Undangan
</h5>
      </div>
      <div class="ibox-content">
        <div class="row">
          <div class="col-lg-6">
            <a href="http://localhost/agendasurat/suratmasukundangan?tambah" class="btn btn-success"><i class="fa plus"></i> Tambah</a>
          </div>
          <div class="col-lg-6">
            <form class="" action="<?php echo site_url('suratmasukundangan/printkegiatan')?>" method="get" target="_blank">
              <div class="col-lg-4">
                  <label for="">Tanggal Kegiatan</label>
              </div>
              <div class="col-lg-6">
                <?php
                  //ambil tanggal esok
                  $now=date("l");
                  $day=date('d');
                  if($now=='friday'){
                    $next=date("Y-m-").($day+3);
                  }
                  else{
                    $next=date("Y-m-").($day+1);
                  }
                  $next=date_dmy($next);
                 ?>
                <input type="text" name="tanggal" value="<?php echo $next?>" class="form-control datepicker">
              </div>
              <div class="col-lg-2">
                <button type="submit" name="button" class="btn btn-info">Cetak</button>
              </div>
            </form>
          </div>
        </div>
                    <hr>
                    <?php echo $this->session->flashdata('info');?>
                    <?php echo $table;?>
          </div>
        </div>
      </div>
      <?php } ?>
<!--END TABLE-->
