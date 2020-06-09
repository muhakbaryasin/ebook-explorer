<?php
	session_start();
	if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
		echo "<script language=Javascript>
					javascript:document.location='../../login.php';
			</script>";
	}
	else{
		include "../../../config/connection.php";

		$module=$_GET['module'];
		$act=$_GET['act'];

		// Input mapel
		if ($module=='jenis' AND $act=='input'){
			mysql_query("INSERT INTO jenis(nama_jenis) 
									VALUES('$_POST[namaJenis]')");
		    //header('location:../../media.php?module='.$module);
			echo "<script language=Javascript>
				window.alert('Data Berhasil Dimasukkan.');
				document.location='../../media.php?module=jenis';
			</script>";
		}

		// Update mapel
		elseif ($module=='jenis' AND $act=='update'){
			mysql_query("UPDATE jenis SET nama_jenis = '$_POST[namaJenis]' WHERE id_jenis = '$_POST[id]'");
			//header('location:../../media.php?module='.$module);
			echo "<script language=Javascript>
				window.alert('Data Berhasil Diubah.');
				document.location='../../media.php?module=jenis';
			</script>";
		}
	}
?>