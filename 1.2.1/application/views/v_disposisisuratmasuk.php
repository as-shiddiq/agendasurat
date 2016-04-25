      <?php if(isset($_GET['tambah']) OR isset($_GET['ubah'])){ ?>    <!--OPEN FORM -->
              <div class="col-lg-12 bg-white">
      <div class="ibox float-e-margins">
          <div class="ibox-title">
    			  <h5>Data Disposisi Surat Masuk
</h5>
      </div>
      <div class="ibox-content">
                    <form class="validate form-horizontal" method="POST" action="http://localhost/agendasurat/disposisisuratmasuk?from=<?php echo $from?>">
                      <?php
                        if(isset($_GET['ubah'])){
                                $parameter='ubah';
                                $where=array(
                                  				'id_disposisi_surat_masuk' => $this->input->get('id'),
                                );
                                $row=$this->db->get_where('disposisi_surat_masuk',$where)->row();
                                $id_disposisi_surat_masuk = $row->id_disposisi_surat_masuk;
																$id_surat_masuk = $row->id_surat_masuk;
																$id_bidang = $row->id_bidang;
																$keterangan = $row->keterangan;
																$tanggal_disposisi = $row->tanggal_disposisi;
                        }
                        else{
                                $parameter='tambah';
                                $id_disposisi_surat_masuk = '';
																$id_surat_masuk = $id_surat_masuk;
																$id_bidang = '';
																$keterangan = '';
																$tanggal_disposisi = date("d-m-Y");

                        }
                    ?>
                        <?php echo input_hidden('parameter',$parameter)?>
                        			<?php echo input_hidden('id_disposisi_surat_masuk',$id_disposisi_surat_masuk,'','required');?>
                              <?php echo input_hidden('id_surat_masuk',$id_surat_masuk,'','required');?>
                        <?php
                          $row=$tampil->row();

                        ?>
                        <div class="form-group">
                          <label class="control-label col-lg-3">Detail Surat</label>
                          <div class="col-lg-8">
                            <table class="table">
                              <tr>
                                <td width="150px">No Agenda</td>
                                <td width="20px">:</td>
                                <td><?php echo substr($row->nomor_agenda,4)?></td>
                              </tr>
                              <tr>
                                <td>Pengirim</td>
                                <td>:</td>
                                <td><?php echo $row->pengirim?></td>
                              </tr>
                              <tr>
                                <td>Nomor Surat</td>
                                <td>:</td>
                                <td><?php echo $row->nomor_surat?></td>
                              </tr>
                              <tr>
                                <td>Tanggal Surat</td>
                                <td>:</td>
                                <td><?php echo standar_tanggal($row->tanggal_surat)?></td>
                              </tr>
                              <tr>
                                <td>Perihal</td>
                                <td>:</td>
                                <td><?php echo $row->perihal?></td>
                              </tr>
                            </table>
                          </div>
                        </div>
                        <hr>
												<div class="form-group">
														<label class="control-label col-lg-3">nama bidang</label>
														<div class="col-lg-8">
																	<?php
                                        $op=NULL;
                                        $op['']='Pilih--';
                                        $this->db->order_by('id_bidang','ASC');
																				$data=$this->db->get_where('bidang',array("id_parent_bidang"=>0));
																				foreach($data->result() as $row){
                                          echo '<div class="col-lg-6">';
																					echo '<label><input type="checkbox" value="'.$row->id_bidang.'" name="id_bidang[]" required> '.$row->nama_bidang.'</label><br>';
                                          echo '</div>';
                                         /** BERDASARKAN BIDANG**/
                                          /*
                                          $this->db->order_by('id_bidang','ASC');
                                          $data2=$this->db->get_where('bidang',array("id_parent_bidang"=>$row->id_bidang));
                                          if($data2->num_rows()>0){
                                            echo '<div class="col-lg-6">';
                                            echo '<h3 style="margin:0;color:#000;font-weight:bold;font-size:12px">Sub Bidang '.$row->nama_bidang.'</h3>';
                                            foreach($data2->result() as $row2){
                                              echo '<label><input type="checkbox" value="'.$row2->id_bidang.'" name="id_bidang[]" required> '.$row2->nama_bidang.'</label><br>';
                                            }
                                            echo '</div>';
                                            echo '<div class="clearfix">';
                                            echo '</div>';
                                            echo '<hr>';
                                          }
                                          else{
                                            echo '<div class="clearfix">';
                                            echo '</div>';
                                            echo '<hr>';
                                          }*/
                                          /**AMbil berdasarkan pegawai**/
                                          $data2=$this->db->query("SELECT * FROM pegawai a LEFT JOIN jabatan b ON a.id_jabatan=b.id_jabatan WHERE b.id_bidang='$row->id_bidang' AND b.level!='kepala' ORDER BY b.id_parent_jabatan ASC");
                                           if($data2->num_rows()>0){
                                            echo '<div class="col-lg-6">';
                                            echo '<h3 style="margin:0;color:#000;font-weight:bold;font-size:12px">Sub Bidang '.$row->nama_bidang.'</h3>';
                                            echo '<ul class="list-me">';
                                            foreach($data2->result() as $row2){
                                              echo '<li>';
                                              echo '<label>';
                                              echo '<div class="checkbox-left"><input type="checkbox" value="'.$row2->id_bidang.'&'.$row2->id_pegawai.'" name="id_pegawai[]" required></div>';
                                              echo '<div class="checkbox-content">';
                                                  echo $row2->nama_pegawai;
                                                  echo span(italic($row2->nama_jabatan),'bidang');
                                              echo '</div>';
                                              echo '</label>';
                                              echo '</li>';
                                            }
                                            echo '</ul>';
                                            echo '</div>';
                                            echo '<div class="clearfix">';
                                            echo '</div>';
                                            echo '<hr>';
                                          }
                                          else{
                                            echo '<div class="clearfix">';
                                            echo '</div>';
                                            echo '<hr>';
                                          }
                                          /*END EBRDASRKAN PEGAWAI*/
																				}
																		?>
														</div>
												</div>
												<div class="form-group">
														<label class="control-label col-lg-3">keterangan</label>
														<div class="col-lg-8">
																<?php echo textarea('keterangan',$keterangan,'','');?>
														</div>
												</div>
												<div class="form-group">
														<label class="control-label col-lg-3">tanggal disposisi</label>
														<div class="col-lg-8">
																<?php echo input_text('tanggal_disposisi',$tanggal_disposisi,'datepicker','required');?>
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
    			  <h5>Data Disposisi Surat Masuk
</h5>
      </div>
      <div class="ibox-content">
                    <a href="http://localhost/agendasurat/disposisisuratmasuk?tambah" class="btn btn-success"><i class="fa plus"></i> Tambah</a>
                    <hr>
                    <?php echo $this->session->flashdata('info');?>
                    <?php echo $table;?>
          </div>
        </div>
      </div>
      <?php } ?>
<!--END TABLE-->
