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
		if ($module=='matapelajaran' AND $act=='input'){
			mysql_query("INSERT INTO mata_pelajaran(nama_mapel,deskripsi_mapel) 
									VALUES('$_POST[namaMapel]','$_POST[deskripsi]')");
		    //header('location:../../media.php?module='.$module);
			echo "<script language=Javascript>
				window.alert('Data Berhasil Dimasukkan.');
				document.location='../../media.php?module=matapelajaran';
			</script>";
		}

		// Update mapel
		elseif ($module=='matapelajaran' AND $act=='update'){
			mysql_query("UPDATE mata_pelajaran SET nama_mapel = '$_POST[namaMapel]',deskripsi_mapel='$_POST[deskripsi]' WHERE id_mapel = '$_POST[id]'");
			//header('location:../../media.php?module='.$module);
			echo "<script language=Javascript>
				window.alert('Data Berhasil Diubah.');
				document.location='../../media.php?module=matapelajaran';
			</script>";
		}
	}
?>