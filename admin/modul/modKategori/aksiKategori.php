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
		if ($module=='kategori' AND $act=='input'){
			mysql_query("INSERT INTO kategori(nama_kategori) 
									VALUES('$_POST[namaKategori]')");
		    //header('location:../../media.php?module='.$module);
			echo "<script language=Javascript>
				window.alert('Data Berhasil Dimasukkan.');
				document.location='../../media.php?module=kategori';
			</script>";
		}

		// Update mapel
		elseif ($module=='kategori' AND $act=='update'){
			mysql_query("UPDATE kategori SET nama_kategori = '$_POST[namaKategori]' WHERE id_kategori = '$_POST[id]'");
			//header('location:../../media.php?module='.$module);
			echo "<script language=Javascript>
				window.alert('Data Berhasil Diubah.');
				document.location='../../media.php?module=kategori';
			</script>";
		}
	}
?>