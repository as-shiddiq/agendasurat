<?php
	$sql="CREATE TABLE IF NOT EXISTS `versi` (
  `id_versi` smallint(6) NOT NULL AUTO_INCREMENT,
  `nama_versi` char(10) NOT NULL,
  `changelog` text NOT NULL,
  `tanggal_versi` date NOT NULL,
  `tanggal_update` date NOT NULL,
  PRIMARY KEY (`id_versi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 \n;&
ALTER TABLE  `disposisi_surat_masuk` ADD  `id_pegawai` TINYINT NOT NULL AFTER  `id_bidang` \n;&
ALTER TABLE  `disposisi_surat_masuk_undangan` ADD  `id_pegawai` TINYINT NOT NULL AFTER  `id_bidang` \n;&";

$changelog="Penambahan fitur update&&Perubahan tampilan lembar disposisi";
$tanggal_versi="2016-04-21";
?>