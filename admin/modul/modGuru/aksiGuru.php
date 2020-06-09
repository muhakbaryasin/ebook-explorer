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
		if ($module=='guru' AND $act=='input'){
			$pass=md5($_POST['password']);
			mysql_query("INSERT INTO guru(nip,nama,email) 
									VALUES('$_POST[nip]','$_POST[namaLengkap]','$_POST[email]')");
			
			mysql_query("INSERT INTO user(username,nama_lengkap,password,level) 
									VALUES('$_POST[nip]','$_POST[namaLengkap]','$pass','guru')");
									
		    //header('location:../../media.php?module='.$module);
			echo "<script language=Javascript>
				window.alert('Data Berhasil Dimasukkan.');
				document.location='../../media.php?module=guru';
			</script>";
		}

		// Update mapel
		elseif ($module=='guru' AND $act=='update'){
			
			mysql_query("UPDATE guru SET nip = '$_POST[nip]',nama='$_POST[namaLengkap]',email='$_POST[email]' WHERE id_guru = '$_POST[id]'");
			if(empty($_POST['password'])){
				mysql_query("UPDATE user SET username = '$_POST[nip]',nama_lengkap='$_POST[namaLengkap]' WHERE username = '$_POST[username]'");
			}else {
				$pass=md5($_POST['password']);
				mysql_query("UPDATE user SET username = '$_POST[nip]',nama_lengkap='$_POST[namaLengkap]',password='$pass' WHERE username = '$_POST[username]'");
			}
			//header('location:../../media.php?module='.$module);
			echo "<script language=Javascript>
				window.alert('Data Berhasil Diubah.');
				document.location='../../media.php?module=guru';
			</script>";
		}
	}
?>