<?php
	session_start();
	ini_set("display_errors", 0);
	//echo $_SESSION[namauser];
	//echo $_SESSION[passuser];
	
	include "../config/connection.php";
	if(!isset($_SESSION[namauser]) or !isset($_SESSION[passuser])){
		echo "<script language=Javascript>
				javascript:document.location='login.php';
		      </script>";
	} else if(isset($_SESSION[namauser]) and isset($_SESSION[passuser])){
		$login=mysql_query("SELECT * FROM user WHERE username='$_SESSION[namauser]' AND password='$_SESSION[passuser]'");
		$ketemu=mysql_num_rows($login);
		$r=mysql_fetch_array($login);

		if ($ketemu > 0){
			echo "<script language=Javascript>
					javascript:document.location='media.php?module=home';
				</script>";
		} else {
			echo "<script language=Javascript>
					javascript:document.location='login.php';
				</script>";
		}
	}
?>
