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
		if ($module=='kelas' AND $act=='input'){
			mysql_query("INSERT INTO kelas(nama_kelas,deskripsi_kelas) 
									VALUES('$_POST[namaKelas]','$_POST[deskripsi]')");
		    //header('location:../../media.php?module='.$module);
			echo "<script language=Javascript>
				window.alert('Data Berhasil Dimasukkan.');
				document.location='../../media.php?module=kelas';
			</script>";
		}

		// Update mapel
		elseif ($module=='kelas' AND $act=='update'){
			mysql_query("UPDATE kelas SET nama_kelas = '$_POST[namaKelas]',deskripsi_kelas='$_POST[deskripsi]' WHERE id_kelas = '$_POST[id]'");
			//header('location:../../media.php?module='.$module);
			echo "<script language=Javascript>
				window.alert('Data Berhasil Diubah.');
				document.location='../../media.php?module=kelas';
			</script>";
		}
	}
?>