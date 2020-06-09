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
		if ($module=='siswa' AND $act=='input'){
			$pass=md5($_POST['password']);
			mysql_query("INSERT INTO siswa(nis,nama,email,id_kelas) 
									VALUES('$_POST[nis]','$_POST[namaLengkap]','$_POST[email]','$_POST[idKelas]')");
			
			mysql_query("INSERT INTO user(username,nama_lengkap,password,level) 
									VALUES('$_POST[nis]','$_POST[namaLengkap]','$pass','siswa')");
									
		    //header('location:../../media.php?module='.$module);
			echo "<script language=Javascript>
				window.alert('Data Berhasil Dimasukkan.');
				document.location='../../media.php?module=siswa';
			</script>";
		}

		// Update mapel
		elseif ($module=='siswa' AND $act=='update'){
			
			mysql_query("UPDATE siswa SET nis = '$_POST[nis]',nama='$_POST[namaLengkap]',email='$_POST[email]',id_kelas='$_POST[idKelas]' WHERE id_siswa = '$_POST[id]'");
			if(empty($_POST['password'])){
				mysql_query("UPDATE user SET username = '$_POST[nis]',nama_lengkap='$_POST[namaLengkap]' WHERE username = '$_POST[username]'");
			}else {
				$pass=md5($_POST['password']);
				mysql_query("UPDATE user SET username = '$_POST[nis]',nama_lengkap='$_POST[namaLengkap]',password='$pass' WHERE username = '$_POST[username]'");
			}
			//header('location:../../media.php?module='.$module);
			echo "<script language=Javascript>
				window.alert('Data Berhasil Diubah.');
				document.location='../../media.php?module=siswa';
			</script>";
		}
	}
?>