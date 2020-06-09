<script language="javascript">
	function validasi(form){
	  if (form.nis.value == 0){
		alert("Anda Belum Memilih Siswa");
		form.nis.focus();
		return (false);
	  }    
	 if (form.idMapel.value == 0){
		alert("Anda Belum Memilih Mata Pelajaran");
		form.idMapel.focus();
		return (false);
	  }
	  if (form.t1.value == ""){
		alert("Anda Belum Memasukkan Nilai Tugas 1");
		form.t1.focus();
		return (false);
	  }
	  if (form.t2.value == ""){
		alert("Anda Belum Memasukkan Nilai Tugas 2");
		form.t2.focus();
		return (false);
	  }
	  if (form.t3.value == ""){
		alert("Anda Belum Memasukkan Nilai Tugas 3");
		form.t3.focus();
		return (false);
	  }
	  if (form.t4.value == ""){
		alert("Anda Belum Memasukkan Nilai Tugas 4");
		form.t4.focus();
		return (false);
	  }
	  if (form.s1.value == ""){
		alert("Anda Belum Memasukkan Nilai Ujian Semester 1");
		form.s1.focus();
		return (false);
	  }
	  if (form.s1.value == ""){
		alert("Anda Belum Memasukkan Nilai Ujian Semester 1");
		form.s1.focus();
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
$aksi="modul/modGNI/aksiGni.php";
switch($_GET['act']){
	//Hapus User
	case "delete":
	mysql_query("DELETE FROM nilai WHERE id_nilai='$_GET[id]'");
	echo "<script language=Javascript>
				window.alert('Data Berhasil Dihapus');
				self.history.back();
		</script>";
    break;
	
	// Tampil User
	default:
	
	$tampil = mysql_query("SELECT * FROM nilai,siswa,mata_pelajaran,kelas WHERE nip='$_SESSION[namauser]' AND mata_pelajaran.id_mapel=nilai.id_mapel AND siswa.nis=nilai.nis AND siswa.id_kelas=kelas.id_kelas ORDER BY nama_kelas,nama DESC");
	echo "<input class='button orange' type=button value='Tambah Nilai' onclick=\"window.location.href='?module=gni&act=tambah';\">";
    
    echo "<br /><br /><table><thead>
          <tr>
          <th width='25'>No</th>
          <th>NIS</th>
          <th>Nama Siswa</th>
          <th>Kelas</th>
          <th>Nama Mata Pelajaran</th>
          <th>Nilai Akhir</th>
          <th colspan=2 width=60>Aksi</th>
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
				<td>$r[nis]</td>
				<td>$r[nama]</td>
				<td>$r[nama_kelas]</td>
				<td>$r[nama_mapel]</td>
				<td>$nilai</td>
				<td><a href=?module=gni&act=edit&id=$r[id_nilai]><img src='images/edit.png' border='0' title='Ubah' height='20' width='20' /></a></td>
				<td><a href=?module=gni&act=delete&id=$r[id_nilai]><img src='images/delete.png' border='0' title='Hapus' height='20' width='20' /></a></td>
			</tr>";
      $no++;
    }
    echo "</table>";
    break;
  case "tambah":
	$tampilMapel = mysql_query("SELECT * FROM mata_pelajaran ORDER BY nama_mapel");
	$tampilSiswa = mysql_query("SELECT * FROM siswa ORDER BY nis");
	echo "<form method=POST action='$aksi?module=gni&act=input' onSubmit=\"return validasi(this)\">
		  <table>
          <tr><th>Siswa			</th><td> : <select id=nis name=nis class='formCmb'> <option value=0>== Pilih Siswa ==</option>"; 
									while ($rk=mysql_fetch_array($tampilSiswa)){ 
										echo "<option value='$rk[nis]'>$rk[nis] | $rk[nama]</option>";
									}
		  echo "</select></td></tr>
		  <tr><th>Mata Pelajaran	</th><td> : <select id=idMapel name=idMapel class='formCmb'> <option value=0>== Pilih Mata Pelajaran ==</option>"; 
									while ($rm=mysql_fetch_array($tampilMapel)){ 
										echo "<option value='$rm[id_mapel]'>$rm[nama_mapel]</option>";
									}
		  echo "</select></td></tr>
          <tr><th>Tugas 1</th>     <td> : <input class='form-input-gray' type=text id=t1 name='t1'></td></tr>
          <tr><th>Tugas 2</th>     <td> : <input class='form-input-gray' type=text id=t2 name='t2'></td></tr>
          <tr><th>Tugas 3</th>     <td> : <input class='form-input-gray' type=text id=t3 name='t3'></td></tr>
          <tr><th>Tugas 4</th>     <td> : <input class='form-input-gray' type=text id=t4 name='t4'></td></tr>
          <tr><th>Semester 1</th>     <td> : <input class='form-input-gray' type=text id=s1 name='s1'></td></tr>
          <tr><th>Semester 2</th>     <td> : <input class='form-input-gray' type=text id=s2 name='s2'></td></tr>
		  <tr><td colspan=2>
			<input type=submit class='button orange' value=Simpan>
			<input type=button class='button orange' value=Batal onclick=self.history.back()>
		  </td></tr>
          </table></form>";
     break;
    
  case "edit":
    $edit=mysql_query("SELECT * FROM nilai WHERE id_nilai='$_GET[id]'");
    $r=mysql_fetch_array($edit);

	$id_kelasR = $r['nis'];
	$id_mapelR = $r['id_mapel'];
	
	$u=0;
	$select = mysql_query("select * from siswa ORDER BY nis");
	while($s=mysql_fetch_array($select)) {
		$id_kelasT[$u] = $s[nis];
		$id_kelasS .= "<option value='$id_kelasT[$u]'";
		if($id_kelasR == $s['nis']) 
			$id_kelasS .="selected";
		$id_kelasS .= ">$s[nis] | $s[nama]</option>";
		$u++;
	}
	
	$u=0;
	$select = mysql_query("select * from mata_pelajaran ORDER BY nama_mapel");
	while($s=mysql_fetch_array($select)) {
		$id_mapelT[$u] = $s[id_mapel];
		$id_mapelS .= "<option value='$id_mapelT[$u]'";
		if($id_mapelR == $s['id_mapel']) 
			$id_mapelS .="selected";
		$id_mapelS .= ">$s[nama_mapel]</option>";
		$u++;
	}
	
	echo "<form method=POST action='$aksi?module=gni&act=update' onSubmit=\"return validasi(this)\">
          <input type=hidden name=id value='$r[id_nilai]'>
          <table>
          <tr><th>Siswa			</th><td> : <select id=nis name=nis class='formCmb'>$id_kelasS</select>&nbsp;&nbsp;&nbsp;</td></tr>
		  <tr><th>Mata Pelajaran	</th><td> : <select id=idMapel name=idMapel class='formCmb'>$id_mapelS</select>&nbsp;&nbsp;&nbsp;</td></tr>
          <tr><th>Tugas 1</th>     <td> : <input class='form-input-gray' type=text id=t1 name='t1' value='$r[t1]'></td></tr>
          <tr><th>Tugas 2</th>     <td> : <input class='form-input-gray' type=text id=t2 name='t2' value='$r[t2]'></td></tr>
          <tr><th>Tugas 3</th>     <td> : <input class='form-input-gray' type=text id=t3 name='t3' value='$r[t3]'></td></tr>
          <tr><th>Tugas 4</th>     <td> : <input class='form-input-gray' type=text id=t4 name='t4' value='$r[t4]'></td></tr>
          <tr><th>Semester 1</th>     <td> : <input class='form-input-gray' type=text id=s1 name='s1'  value='$r[smt1]'></td></tr>
          <tr><th>Semester 2</th>     <td> : <input class='form-input-gray' type=text id=s2 name='s2'  value='$r[smt2]'></td></tr>
		  <tr><td colspan=2>
			<input type=submit class='button orange' value=Simpan>
			<input type=button class='button orange' value=Batal onclick=self.history.back()>
		  </td></tr>
          </table></form>";
    break;
}
}
?>
