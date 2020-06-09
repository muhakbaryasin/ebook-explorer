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

		// Input user
		if ($module=='users' AND $act=='input'){
			$pass=md5($_POST['password']);
			mysql_query("INSERT INTO user(username,password,nama_lengkap) 
									VALUES('$_POST[username]','$pass','$_POST[nama_lengkap]')");
		    //header('location:../../media.php?module='.$module);
			echo "<script language=Javascript>
				window.alert('Data Berhasil Dimasukkan.');
				document.location='../../media.php?module=users';
			</script>";
		}

		// Update user
		elseif ($module=='users' AND $act=='update'){
			//Apabila password tidak diubah
			if (empty($_POST['password'])) {
				$username=$_POST['uname'];
				mysql_query("UPDATE user SET nama_lengkap = '$_POST[nama_lengkap]' WHERE id_user = '$_POST[id]'");
				if($username == $_SESSION['namauser']){
					$_SESSION['namalengkap'] = $_POST['nama_lengkap'];
				} else {}
			}
			// Apabila password diubah
			else{
				$pass=md5($_POST['password']);
				$username=$_POST['uname'];
				mysql_query("UPDATE user SET password = '$pass',nama_lengkap = '$_POST[nama_lengkap]' WHERE id_user = '$_POST[id]'");
				if($username == $_SESSION['namauser']){
					$_SESSION['passuser'] = $pass;
				} else {}
			}
			//header('location:../../media.php?module='.$module);
			echo "<script language=Javascript>
				window.alert('Data Berhasil Diubah.');
				document.location='../../media.php?module=users';
			</script>";
		}
	}
?>