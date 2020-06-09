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
	$tampil = mysql_query("SELECT * FROM nilai,guru,mata_pelajaran WHERE nis='$_SESSION[namauser]' AND guru.nip=nilai.nip AND mata_pelajaran.id_mapel=nilai.id_mapel ORDER BY nama_mapel DESC");
	 echo "<table><thead>
          <tr>
          <th width='25'>No</th>
          <th width=115>NIP Guru</th>
          <th width=170>Nama Guru</th>
          <th width=150>Nama Mata Pelajaran</th>
          <th>Nilai Akhir</th>
          </tr></thead>"; 
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
		$t1=$r['t1'];
		$t2=$r['t2'];
		$t3=$r['t3'];
		$t4=$r['t4'];
		$smt1=$r['smt1'];
		$smt2=$r['smt2'];
		$nilai=((((($t1+$t2+$t3+$t4)/4)*20)/100)+(((($smt1+$smt2)/2)*80)/100));
		
		echo "<tr>
				<td>$no</td>
				<td>$r[nip]</td>
				<td>$r[nama]</td>
				<td>$r[nama_mapel]</td>
				<td>$nilai</td>
			</tr>";
      $no++;
    }
    echo "</table>";
    break;
}
}
?>
