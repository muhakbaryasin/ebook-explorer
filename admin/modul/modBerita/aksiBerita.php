<?php
	session_start();
	if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
		echo "<script language=Javascript>
					javascript:document.location='../../login.php';
			</script>";
	}
	else{
		include "../../../config/connection.php";
		include "../../../config/library.php";
		include "../../../config/fungsi_thumb.php";

		$module=$_GET['module'];
		$act=$_GET['act'];
		// Input
		if ($module=='berita' AND $act=='input'){
			$tgl = date("Ymd");
			mysql_query("INSERT INTO berita (nama_berita,isi_berita,tanggal) VALUES ('$_POST[namaBerita]','$_POST[isiBerita]','$tgl')");
			//header('location:../../media.php?module='.$module);
			echo "<script>window.alert('Data Berhasil Disimpan');
				window.location=('../../media.php?module=berita')</script>";
		}

		// Update
		elseif ($module=='berita' AND $act=='update'){
				mysql_query("UPDATE berita	SET nama_berita = '$_POST[namaBerita]',
												isi_berita	= '$_POST[isiBerita]'
											WHERE id_berita = '$_POST[id]'");
				//header('location:../../media.php?module='.$module);
				echo "<script>window.alert('Data Berhasil Diubah');
					window.location=('../../media.php?module=berita')</script>";
		}
	}
?>