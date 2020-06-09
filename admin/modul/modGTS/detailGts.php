<?php
//session_start();
	if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
		echo "<script language=Javascript>
					javascript:document.location='login.php';
			</script>";
	}
	else{
		$tampil = mysql_query("SELECT * FROM tugas,mata_pelajaran,kelas 
										WHERE username='$_SESSION[namauser]' 
										AND mata_pelajaran.id_mapel=tugas.id_mapel 
										AND kelas.id_kelas=tugas.id_kelas
										AND id_tugas='$_GET[id]'");
		$r=mysql_fetch_array($tampil);
		$tgl = tgl_indo($r['tanggal']);
		echo "<table>
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
					  <th height=25>Tugas Yang Telah Dikumpul</th>
					  <td><a href='media.php?module=gts&act=detailKumpul&id=$r[id_tugas]' class='button orange'>Lihat Berkas</a></td>
				  </tr>
				  <tr>
					  <td height=25 colspan=2><input type=button class='button orange' value='Kembali' onclick=self.history.back()></td>
				  </tr>
			  </table>";
	}
?>
