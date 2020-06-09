<?php
//session_start();
	if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
		echo "<script language=Javascript>
					javascript:document.location='login.php';
			</script>";
	}
	else{		
		$tampil = mysql_query("SELECT * FROM ujian, kelas, kumpul_ujian,siswa
										WHERE username =  '$_SESSION[namauser]'
										AND kelas.id_kelas = kumpul_ujian.id_kelas
										AND kumpul_ujian.id_ujian = ujian.id_ujian
										AND kumpul_ujian.nis = siswa.nis
										AND kumpul_ujian.id_ujian ='$_GET[id]'");
										
		echo "<table>
				<tr><th>No</th><th>NIS</th><th>Nama</th><th>Kelas</th><th>Tanggal Unggah</th><th>File Ujian</th></tr>";
		$no=1;
		while($r=mysql_fetch_array($tampil)){
		$tgl = tgl_indo($r['tanggal_kumpul']);
		echo "<tr>
				<td>$no</td>
				<td>$r[nis]</td>
				<td>$r[nama]</td>
				<td>$r[nama_kelas]</td>
				<td>$tgl</td>
				<td><a href='../files/$r[namafile_kujian]' class='button orange'>Unduh Berkas</a></td>
			</tr>";
		$no++;
		}
		echo "<tr>
				<td colspan=6><input type=button class='button orange' value='Kembali' onclick=self.history.back()></td>
			</tr>";
		echo "</table>";
	}
?>
