<?php
	ini_set("display_errors", 0);
	include "../config/connection.php";
	function antiinjection($data){
		$filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
		return $filter_sql;
	}

	$username = antiinjection($_POST['username']);
	$pass     = antiinjection(md5($_POST['password']));

	$login=mysql_query("SELECT * FROM user WHERE username='$username' AND password='$pass'");
	$ketemu=mysql_num_rows($login);
	$r=mysql_fetch_array($login);

	// Apabila username dan password ditemukan
	if ($ketemu > 0){
		session_start();
		
		include "timeout.php";
		$_SESSION[namauser]     = $r[username];
		$_SESSION[namalengkap]  = $r[nama_lengkap];
		$_SESSION[passuser]     = $r[password];
		//$_SESSION[leveluser]    = $r[level];
		
		$_SESSION[login] = 1;
		timer();
  
		echo "<script language=Javascript>
				window.alert('Login Berhasil');
				javascript:document.location='media.php?module=home';
			</script>";
	  //header('location:media.php?module=home');
	}
	else{
	  echo "<script language=Javascript>
				window.alert('Login Gagal');
				javascript:document.location='login.php';
			</script>";
	}
?>
