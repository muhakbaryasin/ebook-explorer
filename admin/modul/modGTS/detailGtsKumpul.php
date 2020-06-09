<?php
//session_start();
	if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
		echo "<script language=Javascript>
					javascript:document.location='login.php';
			</script>";
	}
	else{		
		$tampil = mysql_query("SELECT * FROM tugas, kelas, kumpul_tugas,siswa
										WHERE username =  '$_SESSION[namauser]'
										AND kelas.id_kelas = kumpul_tugas.id_kelas
										AND kumpul_tugas.id_tugas = tugas.id_tugas
										AND kumpul_tugas.nis = siswa.nis
										AND kumpul_tugas.id_tugas ='$_GET[id]'");
										
		echo "<table>
				<tr><th>No</th><th>NIS</th><th>Nama</th><th>Kelas</th><th>Tanggal Unggah</th><th>File Tugas</th></tr>";
		$no=1;
		while($r=mysql_fetch_array($tampil)){
		$tgl = tgl_indo($r['tanggal_kumpul']);
		echo "<tr>
				<td>$no</td>
				<td>$r[nis]</td>
				<td>$r[nama]</td>
				<td>$r[nama_kelas]</td>
				<td>$tgl</td>
				<td><a href='../files/$r[namafile_ktugas]' class='button orange'>Unduh Berkas</a></td>
			</tr>";
		$no++;
		}
		echo "<tr>
				<td colspan=6><input type=button class='button orange' value='Kembali' onclick=self.history.back()></td>
			</tr>";
		echo "</table>";
	}
?>
