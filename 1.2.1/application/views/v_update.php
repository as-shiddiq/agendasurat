<div class="col-lg-12 bg-white">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5><?php echo icon('home')?> Pembaruan</h5>
        </div>
        <div class="ibox-content">
		<?php 
      echo $this->session->flashdata('info');
			echo $this->session->userdata('updating');
			$versi='v1.3';
			$cek=$this->db->get_where("versi",array("nama_versi"=>$versi));
			if($cek->num_rows()>0){
		?>
        <form action="<?=site_url('update/proses')?>" method="POST">
        	<input type="hidden" name="version" value="<?=$versi?>">
       		<button type="submit" class="btn btn-success" name="update">Update</button>
        </form>
        <?php } else{
          //echo enchash("http://localhost/update/");
          //echo dechash('MHpqUVZHaEhUNTlCMm1EY0RjT0d5bmdScmZidHlsMERHVGVpVk52M3U2YmQvUlVxdmV5aU1DSldLNWpza256WA==');
        	echo info_success(icon('check')." Sistem terbaru telah terpasang ".anchor(enchash("http://localhost/update/update.txt"),icon("download").' Cek pembaruan','btn btn-info check-update'));
        	}?>

        <?php
            //get changelog
            $get=$this->db->query("SELECT * FROM versi ORDER BY id_versi DESC");
            if($get->num_rows()>0){
            $i=0;
        ?>
        <hr>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <?php foreach ($get->result() as $row): ?>
          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading<?=$row->id_versi?>">
              <h4 class="panel-title">
              <?php if($i==0){ ?>
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#<?=$row->id_versi?>" aria-expanded="true" aria-controls="<?=$row->id_versi?>">
                 
                <?php }  else { ?>
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#<?=$row->id_versi?>" aria-controls="<?=$row->id_versi?>">
                <?php } ?>
                  Versi <?=$row->nama_versi?> - <small><?=standar_tanggal($row->tanggal_update)?></small>
                </a>
              </h4>
            </div>
            <?php if($i==0){ ?>
                <div id="<?=$row->id_versi?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="<?=$row->id_versi?>">
                  <div class="panel-body">
            <?php }  else { ?>
                <div id="<?=$row->id_versi?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="<?=$row->id_versi?>">
                  <div class="panel-body">
            <?php } ?>
                <ul>
                    <?php 
                        $ex=explode('&&', $row->changelog);
                        if(count($ex)>0){
                            foreach ($ex as $f) {
                                echo '<li>'.$f.'</li>';
                            }
                        }
                        else {
                            echo '<li>Changelog tidak tersedia.</li>';
                        }

                    ?>                    
                </ul>
              </div>
            </div>
          </div>
          <?php $i++;?>
        <?php endforeach ?>
        </div>
        <?php } ?>
        <div class="clearfix"></div>
       	<br>
        </div>
   	</div>
</div>

<script type="text/javascript">
  $(".check-update").click(function(e){
    e.preventDefault();
    $url=$(this).attr("href");
    $.ajax({
      url:"<?=site_url("update/checkupdate")?>",
      type:"POST",
      data:"data="+$url,
      success:function(data){
        if(data=='success'){
          window.location="<?=site_url("update")?>";
        }
        else{
          alert("Terjadi kesalahan!!, coba lagi..");
        }
      }
    })
  })
</script>
