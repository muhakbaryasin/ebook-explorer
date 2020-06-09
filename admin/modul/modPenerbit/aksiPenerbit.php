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
		if ($module=='penerbit' AND $act=='input'){
			mysql_query("INSERT INTO penerbit(nama_penerbit,alamat,kota,email,telp) 
									VALUES('$_POST[namaPenerbit]','$_POST[alamat]','$_POST[kota]','$_POST[email]','$_POST[telp]')");
		    //header('location:../../media.php?module='.$module);
			echo "<script language=Javascript>
				window.alert('Data Berhasil Dimasukkan.');
				document.location='../../media.php?module=penerbit';
			</script>";
		}

		// Update mapel
		elseif ($module=='penerbit' AND $act=='update'){
			mysql_query("UPDATE penerbit SET nama_penerbit = '$_POST[namaPenerbit]' , alamat = '$_POST[alamat]' , kota = '$_POST[kota]',
																email = '$_POST[email]' , telp = '$_POST[telp]' WHERE id_penerbit = '$_POST[id]'");
			//header('location:../../media.php?module='.$module);
			echo "<script language=Javascript>
				window.alert('Data Berhasil Diubah.');
				document.location='../../media.php?module=penerbit';
			</script>";
		}
	}
?>