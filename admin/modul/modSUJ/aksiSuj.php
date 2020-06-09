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
		if ($module=='suj' AND $act=='upload'){
			$lokasi_file = $_FILES['fupload']['tmp_name'];
			$nama_file   = $_FILES['fupload']['name'];
			
			$file_extension = strtolower(substr(strrchr($nama_file,"."),1));
			$tgl = date("Ymd");
			switch($file_extension){
				case "pdf": $ctype="application/pdf"; break;
				case "exe": $ctype="application/octet-stream"; break;
				case "zip": $ctype="application/zip"; break;
				case "rar": $ctype="application/rar"; break;
				case "doc": $ctype="application/msword"; break;
				case "xls": $ctype="application/vnd.ms-excel"; break;
				case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
				case "gif": $ctype="image/gif"; break;
				case "png": $ctype="image/png"; break;
				case "jpeg":
				case "jpg": $ctype="image/jpg"; break;
				default: $ctype="application/proses";
			}

			if ($file_extension=='php'){
				echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload tidak bertipe *.PHP');
				window.location=('../../media.php?module=suj')</script>";
			}
			else{
				UploadFile($nama_file);
				mysql_query("INSERT INTO kumpul_ujian (id_ujian,
												id_kelas,
												nip,
												nis,
												namafile_kujian,
												tanggal_kumpul) 
										VALUES ('$_POST[idUjian]',
												'$_POST[idKelas]',
												'$_POST[nip]',
												'$_POST[nis]',
												'$nama_file',
												'$tgl')");
				//header('location:../../media.php?module='.$module);
				echo "<script>window.alert('Data Berhasil Disimpan');
					window.location=('../../media.php?module=suj')</script>";
			}
		}
	}
?>