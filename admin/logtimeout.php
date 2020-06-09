<?php
	session_start();
	session_destroy();
	echo "<script language='javascript'>
			window.alert('Sistem Keluar Otomatis. Silahkan Login Kembali.');
			document.location='index.php';
		</script>";
?>