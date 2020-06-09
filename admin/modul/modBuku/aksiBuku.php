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
		if ($module=='buku' AND $act=='input'){
			$lokasi_file = $_FILES['fupload']['tmp_name'];
			$nama_file   = $_FILES['fupload']['name'];
			$acak        = rand(000000,999999);
			$nama_file_unik = $acak.$nama_file;
			$file_extension = strtolower(substr(strrchr($nama_file,"."),1));
			$tgl = date("Ymd");
			switch($file_extension){
				case "pdf": $ctype="application/pdf"; break;
				default: $ctype="application/proses";
			}

			if ($file_extension!='pdf'){
				echo "<script>
					window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.PDF');
					self.history.back();
				</script>";
			}
			else{
				if(!move_uploaded_file($lokasi_file, "../../../files/".$nama_file))
				{
					die('error upload gambar');
				}else {
				mysql_query("INSERT INTO buku (judul,
												id_kategori,
												id_jenis,
												id_penerbit,
												nama_pengarang,
												tahun,
												nama_file,
												deskripsi) 
										VALUES ('$_POST[judul]',
												'$_POST[kategori]',
												'$_POST[jenis]',
												'$_POST[penerbit]',
												'$_POST[pengarang]',
												'$_POST[tahun]',
												'$nama_file',
												'$_POST[desk]')");
				//header('location:../../media.php?module='.$module);
				echo "<script>
						window.alert('Data Berhasil Disimpan');
						window.location=('../../media.php?module=buku');
					</script>";}
			}
		}

		// Update
		elseif ($module=='buku' AND $act=='update'){
			$lokasi_file = $_FILES['fupload']['tmp_name'];
			$nama_file   = $_FILES['fupload']['name'];
			$acak        = rand(000000,999999);
			$nama_file_unik = $acak.$nama_file;
			if (empty($lokasi_file)){
				mysql_query("UPDATE buku	SET judul 			= '$_POST[judul]',
												id_kategori 	= '$_POST[kategori]',
												id_jenis		= '$_POST[jenis]',
												id_penerbit		= '$_POST[penerbit]',
												nama_pengarang 	= '$_POST[pengarang]',
												tahun		 	= '$_POST[tahun]',
												deskripsi = '$_POST[desk]'
											WHERE id_buku = '$_POST[id]'");
				//header('location:../../media.php?module='.$module);
				echo "<script>window.alert('Data Berhasil Diubah');
							window.location=('../../media.php?module=buku');
						</script>";
			}
			else{
				$file_extension = strtolower(substr(strrchr($nama_file,"."),1));
				$tgl = date("Ymd");
				switch($file_extension){
					case "pdf": $ctype="application/pdf"; break;
					default: $ctype="application/proses";
				}

				if ($file_extension!='pdf'){
					echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.PDF');
						self.history.back();
					</script>";
				}
				else{
					unlink("../../../files/$_POST[fileLama]");
					UploadFile($nama_file_unik);
					mysql_query("UPDATE buku	SET judul 		= '$_POST[judul]',
												id_kategori 	= '$_POST[kategori]',
												id_jenis		= '$_POST[jenis]',
												id_penerbit		= '$_POST[penerbit]',
												nama_pengarang 	= '$_POST[pengarang]',
												tahun		 	= '$_POST[tahun]',
												nama_file	 	= '$nama_file_unik'
											WHERE id_buku = '$_POST[id]'");
				//header('location:../../media.php?module='.$module);
				echo "<script>window.alert('Data Berhasil Diubah');
					window.location=('../../media.php?module=buku')</script>";
				}
			}
		}
	}
?>
