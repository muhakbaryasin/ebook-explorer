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
		if ($module=='gmt' AND $act=='input'){
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
				window.location=('../../media.php?module=gmt')</script>";
			}
			else{
				UploadFile($nama_file);
				mysql_query("INSERT INTO materi (id_kelas,
												id_mapel,
												nama_materi,
												deskripsi_materi,
												namafile_materi,
												username,
												tanggal) 
										VALUES ('$_POST[idKelas]',
												'$_POST[idMapel]',
												'$_POST[namaMateri]',
												'$_POST[deskripsi]',
												'$nama_file',
												'$_SESSION[namauser]',
												'$tgl')");
				//header('location:../../media.php?module='.$module);
				echo "<script>window.alert('Data Berhasil Disimpan');
					window.location=('../../media.php?module=gmt')</script>";
			}
		}

		// Update
		elseif ($module=='gmt' AND $act=='update'){
			$lokasi_file = $_FILES['fupload']['tmp_name'];
			$nama_file   = $_FILES['fupload']['name'];
			if (empty($lokasi_file)){
				mysql_query("UPDATE materi	SET id_kelas 			= '$_POST[idKelas]',
												id_mapel 			= '$_POST[idMapel]',
												nama_materi 		= '$_POST[namaMateri]',
												deskripsi_materi	= '$_POST[deskripsi]'
											WHERE id_materi = '$_POST[id]'");
				//header('location:../../media.php?module='.$module);
				echo "<script>window.alert('Data Berhasil Diubah');
					window.location=('../../media.php?module=gmt')</script>";
			}
			else{
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
					window.location=('../../media.php?module=gmt')</script>";
				}
				else{
					unlink("../../../files/$_POST[fileLama]");
					UploadFile($nama_file);
					mysql_query("UPDATE materi	SET id_kelas 			= '$_POST[idKelas]',
													id_mapel 			= '$_POST[idMapel]',
													nama_materi 		= '$_POST[namaMateri]',
													deskripsi_materi	= '$_POST[deskripsi]',
													namafile_materi		= '$nama_file'
											WHERE id_materi = '$_POST[id]'");
				//header('location:../../media.php?module='.$module);
				echo "<script>window.alert('Data Berhasil Diubah');
					window.location=('../../media.php?module=gmt')</script>";
				}
			}
		}
	}
?>