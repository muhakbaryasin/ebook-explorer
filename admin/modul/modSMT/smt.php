<?php
//session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	echo "<script language=Javascript>
				javascript:document.location='login.php';
		</script>";
}
else{
$aksi="modul/modSMT/aksiSmt.php";
switch($_GET['act']){
	// Tampil User
	default:
	$fad = mysql_query("SELECT * FROM siswa WHERE nis='$_SESSION[namauser]'");
	$hel = mysql_fetch_array($fad);
	//echo "$hel[id_kelas]";
	$tampil = mysql_query("SELECT * FROM materi,mata_pelajaran,kelas WHERE materi.id_kelas='$hel[id_kelas]' AND mata_pelajaran.id_mapel=materi.id_mapel AND kelas.id_kelas=materi.id_kelas ORDER BY tanggal DESC");
	
    echo "<table><thead>
          <tr>
          <th width='25'>No</th>
          <th width='335'>Nama Materi</th>
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
				<td>$r[nama_materi]</td>
				<td>$r[nama_mapel]</td>
				<td>$r[nama_kelas]</td>
				<td>$tgl</td>
				<td><a href=?module=smt&act=detail&id=$r[id_materi]><img src='images/detail.png' border='0' title='Detail' height='20' width='20' /></a></td>
			</tr>";
      $no++;
    }
    echo "</table>";
    break;
	
	case "detail":
		require_once "modul/modSMT/detailSmt.php";
    break;
}
}
?>
