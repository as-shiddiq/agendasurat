<div class="col-lg-12 bg-white">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5><?php echo icon('home')?> Sistem</h5>
        </div>
        <div class="ibox-content">

            <?php
              $get=$this->db->get_where("sistem",array("id_sistem"=>1));
              if($get->num_rows()==0){
                $this->session->set_flashdata('info',info_danger(icon('times').' Data sistem tidak ditemukan, terjadi kesalahan sistem'));
              }
              $row=$get->row();

            ?>
             <form class="validate form">
                  <h4 class="text-success">Sistem</h4>
                  <hr>
                  <div class="form-group">
                      <label class="control-label">Tahun Perencanaan</label>
                      <?php 
                          $op=null;
                          $op['2015']="2015";
                          $op['2016']="2016";
                          $op['2017']="2017";
                          $op['2018']="2018";
                          $op['2019']="2019";
                          $op['2020']="2020";
                          echo select('tahun_perencanaan',$op,$row->tahun_perencanaan,'','required nick="Tahun Anggaran"');
                      ?>
                  </div>
                  <hr>
                  <h4 class="text-success">Lock Screen</h4>
                  <hr>
                  <div class="form-group">
                      <label class="control-label">Aktifkan Lockscreen</label>
                      <?php 
                          $op=null;
                          $op['Y']="Ya";
                          $op['N']="Tidak";
                          echo select('aktif_lockscreen',$op,$row->aktif_lockscreen,'','required nick="Lockscreen"');
                      ?>
                  </div>
                  <div class="form-group">
                      <label class="control-label">Lama Waktu (menit)</label>
                      <input type="number" value="<?=$row->lama_waktu_lockscreen?>" nick="Lama Waktu Lockscreen" min="1" max="60" class="form-control" name="lama_waktu_lockscreen"></input>
                  </div>
              </form>

          <div class="clearfix">

          </div>
          <br>
        </div>
   	</div>

<ul class="notif" style="display:none">
</ul>
</div>
<script type="text/javascript">
  $("select,input").change(function(){
    $val=$(this).val();
    $attr=$(this).attr("name");
    $nick=$(this).attr("nick");
    $.ajax({
      url:"<?=site_url('sistem')?>",
      data:"attr="+$attr+"&val="+$val,
      type:"POST",
      success:function(data){
        if(data=='sukses'){
          $(".notif").append("<li class="+$attr+"><i class='fa fa-check'></i> Pengaturan <b>"+$nick+"</b> sukses diubah</li>").slideDown();
          removeit($attr);
        }
        else{
          $(".notif").append("<li class='"+$attr+" error'><i class='fa fa-times'></i> Pengaturan <b>"+$nick+"</b> gagal diubah</li>").slideDown();
          removeit($attr);
        }
      }
    })
  })

  function removeit(cl){
    setTimeout(function() {
         $(".notif li."+cl).slideUp("slow");
     },2000);
  }
</script>