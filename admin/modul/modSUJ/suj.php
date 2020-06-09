<?php
//session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	echo "<script language=Javascript>
				javascript:document.location='login.php';
		</script>";
}
else{
$aksi="modul/modGUJ/aksiGuj.php";
switch($_GET['act']){
	//Hapus User
	case "delete":
	$tampil = mysql_query("SELECT * FROM ujian WHERE id_ujian=$_GET[id]");
	$r=mysql_fetch_array($tampil);
	unlink("../files/$r[namafile_ujian]");
    mysql_query("DELETE FROM ujian WHERE id_ujian='$_GET[id]'");
	echo "<script language=Javascript>
				window.alert('Data Berhasil Dihapus');
				self.history.back();
		</script>";
    break;
	
	// Tampil User
	default:
	$fad = mysql_query("SELECT * FROM siswa WHERE nis='$_SESSION[namauser]'");
	$hel = mysql_fetch_array($fad);
	$tampil = mysql_query("SELECT * FROM ujian,mata_pelajaran,kelas WHERE ujian.id_kelas='$hel[id_kelas]' AND mata_pelajaran.id_mapel=ujian.id_mapel AND kelas.id_kelas=ujian.id_kelas ORDER BY tanggal DESC");
	echo "<table><thead>
          <tr>
          <th width='25'>No</th>
          <th width='335'>Nama Ujian</th>
          <th width='335'>Mata Pelajaran</th>
          <th width='335'>Kelas</th>
          <th width=200>Tanggal Unggah</th>
          <th width=60>Aksi</th>
          </tr></thead>"; 
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
		$tgl = tgl_indo($r[tanggal]);
       echo "<tr>
				<td>$no</td>
				<td>$r[nama_ujian]</td>
				<td>$r[nama_mapel]</td>
				<td>$r[nama_kelas]</td>
				<td>$tgl</td>
				<td><a href=?module=suj&act=detail&id=$r[id_ujian]><img src='images/detail.png' border='0' title='Detail' height='20' width='20' /></a></td>
			</tr>";
      $no++;
    }
    echo "</table>";
    break;
	
	case "detail":
		require_once "modul/modSUJ/detailSuj.php";
    break;
}
}
?>
