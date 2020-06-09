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
		if ($module=='guj' AND $act=='input'){
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
				window.location=('../../media.php?module=guj')</script>";
			}
			else{
				UploadFile($nama_file);
				mysql_query("INSERT INTO ujian (id_kelas,
												id_mapel,
												nama_ujian,
												deskripsi_ujian,
												soal_ujian,
												namafile_ujian,
												username,
												tanggal) 
										VALUES ('$_POST[idKelas]',
												'$_POST[idMapel]',
												'$_POST[namaUjian]',
												'$_POST[deskripsi]',
												'$_POST[soal]',
												'$nama_file',
												'$_SESSION[namauser]',
												'$tgl')");
				//header('location:../../media.php?module='.$module);
				echo "<script>window.alert('Data Berhasil Disimpan');
					window.location=('../../media.php?module=guj')</script>";
			}
		}

		// Update
		elseif ($module=='guj' AND $act=='update'){
			$lokasi_file = $_FILES['fupload']['tmp_name'];
			$nama_file   = $_FILES['fupload']['name'];
			if (empty($lokasi_file)){
				mysql_query("UPDATE ujian	SET id_kelas 			= '$_POST[idKelas]',
												id_mapel 			= '$_POST[idMapel]',
												nama_ujian 			= '$_POST[namaUjian]',
												deskripsi_ujian		= '$_POST[deskripsi]',
												soal_ujian			= '$_POST[soal]'
											WHERE id_ujian 			= '$_POST[id]'");
				//header('location:../../media.php?module='.$module);
				echo "<script>window.alert('Data Berhasil Diubah');
					window.location=('../../media.php?module=guj')</script>";
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
					window.location=('../../media.php?module=guj')</script>";
				}
				else{
					unlink("../../../files/$_POST[fileLama]");
					UploadFile($nama_file);
					mysql_query("UPDATE ujian	SET id_kelas 			= '$_POST[idKelas]',
													id_mapel 			= '$_POST[idMapel]',
													nama_ujian 			= '$_POST[namaUjian]',
													deskripsi_ujian		= '$_POST[deskripsi]',
													soal_ujian			= '$_POST[soal]',
													namafile_ujian		= '$nama_file'
											WHERE id_tugas = '$_POST[id]'");
				//header('location:../../media.php?module='.$module);
				echo "<script>window.alert('Data Berhasil Diubah');
					window.location=('../../media.php?module=guj')</script>";
				}
			}
		}
	}
?>