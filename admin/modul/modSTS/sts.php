<?php
//session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	echo "<script language=Javascript>
				javascript:document.location='login.php';
		</script>";
}
else{
$aksi="modul/modGTS/aksiGts.php";
switch($_GET['act']){
	//Hapus User
	case "delete":
	$tampil = mysql_query("SELECT * FROM tugas WHERE id_tugas=$_GET[id]");
	$r=mysql_fetch_array($tampil);
	unlink("../files/$r[namafile_tugas]");
    mysql_query("DELETE FROM tugas WHERE id_tugas='$_GET[id]'");
	echo "<script language=Javascript>
				window.alert('Data Berhasil Dihapus');
				self.history.back();
		</script>";
    break;
	
	// Tampil User
	default:
	$fad = mysql_query("SELECT * FROM siswa WHERE nis='$_SESSION[namauser]'");
	$hel = mysql_fetch_array($fad);
	$tampil = mysql_query("SELECT * FROM tugas,mata_pelajaran,kelas WHERE tugas.id_kelas='$hel[id_kelas]' AND mata_pelajaran.id_mapel=tugas.id_mapel AND kelas.id_kelas=tugas.id_kelas ORDER BY tanggal DESC");
	
    echo "<table><thead>
          <tr>
          <th width='25'>No</th>
          <th width='335'>Nama Tugas</th>
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
				<td>$r[nama_tugas]</td>
				<td>$r[nama_mapel]</td>
				<td>$r[nama_kelas]</td>
				<td>$tgl</td>
				<td><a href=?module=sts&act=detail&id=$r[id_tugas]><img src='images/detail.png' border='0' title='Detail' height='20' width='20' /></a></td>
			</tr>";
      $no++;
    }
    echo "</table>";
    break;
	
	case "detail":
		require_once "modul/modSTS/detailsts.php";
    break;
}
}
?>
