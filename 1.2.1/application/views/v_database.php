<div class="col-lg-12 bg-white">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5><?php echo icon('cloud')?> Database Tools</h5>
        </div>
        <div class="ibox-content">
			<?php echo $this->session->flashdata('info');?>

			<h4>Cadangkan Database</h4>
			<hr>
			<a href="<?php echo site_url('database/backup')?>" class="btn btn-info"><i class="fa fa-download"></i> Cadangkan Database</a>
			<hr>
			<h4>Kembalikan Database</h4>
			<hr>
			<form action="<?php echo site_url('database/import')?>" method="post" enctype="multipart/form-data">
				<label>Pilih File SQL</label>
				<?php echo input_file('file','','','required')?>
				<br>
				<button type="submit" name="simpan" class="btn btn-info"><i class="fa fa-upload"></i> Kirim</button>
			</form>
			<hr>
			<h4>Database yang sudah dicadangkan</h4>
			<hr>
			<?php echo $table ?>
		</div>
</div>
</div>
