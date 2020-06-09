<?php
//session_start();
	if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
		echo "<script language=Javascript>
					javascript:document.location='login.php';
			</script>";
	}
	else{
		$tampil = mysql_query("SELECT * FROM materi,mata_pelajaran,kelas 
										WHERE mata_pelajaran.id_mapel=materi.id_mapel 
										AND kelas.id_kelas=materi.id_kelas
										AND id_materi='$_GET[id]'");
		$r=mysql_fetch_array($tampil);
		$tampil2 = mysql_query("SELECT nama FROM guru WHERE nip='$r[username]'");
		$r2=mysql_fetch_array($tampil2);
		$tgl = tgl_indo($r['tanggal']);
		echo "<table>
				  <tr>
					  <th width=150 height=25>Nama Materi</th>
					  <td width=350>$r[nama_materi]</td>
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
					  <td>$r[deskripsi_materi]</td>
				  </tr>
				  <tr>
					  <th height=25>Berkas Materi</th>
					  <td><a href='../files/$r[namafile_materi]' class='button orange'>Unduh Berkas</a></td>
				  </tr>
				  <tr>
					  <td height=25 colspan=2><input type=button class='button orange' value='Kembali' onclick=self.history.back()></td>
				  </tr>
			  </table>";
	}
?>
