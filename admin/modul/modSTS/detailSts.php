<script language="javascript">
	function validasiIn(form){
	  if (form.fupload.value == ""){
		alert("Anda Belum Memasukkan Berkas Tugas");
		form.fupload.focus();
		return (false);
	  }
	  return (true);
	}
</script>
<?php
//session_start();
	if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
		echo "<script language=Javascript>
					javascript:document.location='login.php';
			</script>";
	}
	else{
		$tampil = mysql_query("SELECT * FROM tugas,mata_pelajaran,kelas 
										WHERE mata_pelajaran.id_mapel=tugas.id_mapel 
										AND kelas.id_kelas=tugas.id_kelas
										AND id_tugas='$_GET[id]'");
		$r=mysql_fetch_array($tampil);
		$tampil2 = mysql_query("SELECT nama FROM guru WHERE nip='$r[username]'");
		$r2=mysql_fetch_array($tampil2);
		$tgl = tgl_indo($r['tanggal']);
		$aksi="modul/modSTS/aksiSts.php";
		echo "<form method=post action='$aksi?module=sts&act=upload' enctype='multipart/form-data' onSubmit=\"return validasiIn(this)\"><table>
				  <tr>
					  <th width=150 height=25>Nama Tugas</th>
					  <td width=350>$r[nama_tugas]</td>
				  </tr>
				  <tr>
					  <th height=25>Kelas</th>
					  <td>$r[nama_kelas]</td>
				  </tr>
				  <tr>
					  <th height=25>Mata Pelajaran</th>
					  <td>$r[nama_mapel]</td>
				  </tr>
				  <tr>
					  <th height=25>Kelas</th>
					  <td>$r[nama_kelas]</td>
				  </tr>
				  <tr>
					  <th height=25>Nama Guru</th>
					  <td>$r2[nama]</td>
				  </tr>
				  <tr>
					  <th height=25>Tanggal Unggah</th>
					  <td>$tgl</td>
				  </tr>
				  <tr>
					  <th height=25>Deskripsi</th>
					  <td>$r[deskripsi_tugas]</td>
				  </tr>
				  <tr>
					  <th height=25>Berkas Tugas</th>
					  <td><a href='../files/$r[namafile_tugas]' class='button orange'>Unduh Berkas</a></td>
				  </tr>
				  <tr>
					  <th height=25>Kumpul Tugas</th>
					  <td>";
					  $tampil3 = mysql_query("SELECT * FROM kumpul_tugas WHERE id_tugas='$r[id_tugas]' AND nis='$_SESSION[namauser]'");
					  $r3=mysql_num_rows($tampil3);
					  if($r3>0){
						echo "Anda Sudah Mengumpulkan Tugas Anda.";
					  } else {
						 echo "<input class='formFile' type=file id=fupload name='fupload'><br /><br />
							<input type=hidden name='idTugas' value='$r[id_tugas]'>
							<input type=hidden name='idKelas' value='$r[id_kelas]'>
							<input type=hidden name='nip' value='$r[username]'>
							<input type=hidden name='nis' value='$_SESSION[namauser]'>
							<input type=submit class='button orange' value='Upload'>";
					  }
					  echo "</td>
				  </tr>
				  <tr>
					  <td height=25 colspan=2><input type=button class='button orange' value='Kembali' onclick=self.history.back()></td>
				  </tr>
			  </table></form>";
	}
?>
