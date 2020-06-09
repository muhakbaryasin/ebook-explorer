<?php
	session_start();
	session_destroy();
	echo "<script language='javascript'>
			window.alert('Anda Berhasil Keluar');
			document.location='index.php';
		</script>";
?>