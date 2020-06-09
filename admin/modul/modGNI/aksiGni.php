<?php
	session_start();
	if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
		echo "<script language=Javascript>
					javascript:document.location='../../login.php';
			</script>";
	}
	else{
		include "../../../config/connection.php";
		include "../../../config/library.php";
		include "../../../config/fungsi_thumb.php";

		$module=$_GET['module'];
		$act=$_GET['act'];

		// Input
		if ($module=='gni' AND $act=='input'){
				mysql_query("INSERT INTO nilai (nip,nis,id_mapel,t1,t2,t3,t4,smt1,smt2)
										VALUES ('$_SESSION[namauser]','$_POST[nis]','$_POST[idMapel]','$_POST[t1]','$_POST[t2]','$_POST[t3]','$_POST[t4]','$_POST[s1]','$_POST[s2]')");
				//header('location:../../media.php?module='.$module);
				echo "<script>window.alert('Data Berhasil Disimpan');
					window.location=('../../media.php?module=gni')</script>";
		}

		// Update
		elseif ($module=='gni' AND $act=='update'){
				mysql_query("UPDATE nilai	SET nis 			= '$_POST[nis]',
												id_mapel 		= '$_POST[idMapel]',
												t1				= '$_POST[t1]',
												t2				= '$_POST[t2]',
												t3				= '$_POST[t3]',
												t4				= '$_POST[t4]',
												smt1			= '$_POST[s1]',
												smt2			= '$_POST[s2]'
											WHERE id_nilai 		= '$_POST[id]'");
				//header('location:../../media.php?module='.$module);
				echo "<script>window.alert('Data Berhasil Diubah');
					window.location=('../../media.php?module=gni')</script>";
		}
	}
?>