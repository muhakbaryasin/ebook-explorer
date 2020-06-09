<script language="javascript">
	polaPass=/^[a-zA-Z0-9\_\-]{8,20}$/;
	
	function validasiIn(form){
	  if (form.namaMateri.value == ""){
		alert("Anda Belum Memasukkan Nama Tugas");
		form.namaMateri.focus();
		return (false);
	  }    
	  if (form.idKelas.value == 0){
		alert("Anda Belum Memilih Kelas");
		form.idKelas.focus();
		return (false);
	  }
	  if (form.idMapel.value == 0){
		alert("Anda Belum Memilih Mata Pelajaran");
		form.idMapel.focus();
		return (false);
	  }
	  if (form.deskripsi.value == ""){
		alert("Anda Belum Memasukkan Deskripsi");
		form.deskripsi.focus();
		return (false);
	  }
	  if (form.fupload.value == ""){
		alert("Anda Belum Memasukkan Berkas Tugas");
		form.fupload.focus();
		return (false);
	  }
	  return (true);
	}
	
	function validasiUp(form){
	  if (form.namaMateri.value == ""){
		alert("Anda Belum Memasukkan Nama Tugas");
		form.namaMateri.focus();
		return (false);
	  }
	  if (form.deskripsi.value == ""){
		alert("Anda Belum Memasukkan Deskripsi");
		form.deskripsi.focus();
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
	
	$tampil = mysql_query("SELECT * FROM tugas,mata_pelajaran,kelas WHERE username='$_SESSION[namauser]' AND mata_pelajaran.id_mapel=tugas.id_mapel AND kelas.id_kelas=tugas.id_kelas ORDER BY tanggal DESC");
	echo "<input class='button orange' type=button value='Tambah Tugas' onclick=\"window.location.href='?module=gts&act=tambah';\">";
    
    echo "<br /><br /><table><thead>
          <tr>
          <th width='25'>No</th>
          <th width='335'>Nama Tugas</th>
          <th width='335'>Mata Pelajaran</th>
          <th width='335'>Kelas</th>
          <th width=200>Tanggal Unggah</th>
          <th colspan=3 width=60>Aksi</th>
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
				<td><a href=?module=gts&act=detail&id=$r[id_tugas]><img src='images/detail.png' border='0' title='Detail' height='20' width='20' /></a></td>
				<td><a href=?module=gts&act=edit&id=$r[id_tugas]><img src='images/edit.png' border='0' title='Ubah' height='20' width='20' /></a></td>
				<td><a href=?module=gts&act=delete&id=$r[id_tugas]><img src='images/delete.png' border='0' title='Hapus' height='20' width='20' /></a></td>
			</tr>";
      $no++;
    }
    echo "</table>";
    break;
  case "tambah":
	$tampilKelas = mysql_query("SELECT * FROM kelas ORDER BY nama_kelas");
	$tampilMapel = mysql_query("SELECT * FROM mata_pelajaran ORDER BY nama_mapel");
	echo "<form method=POST action='$aksi?module=gts&act=input' enctype='multipart/form-data' onSubmit=\"return validasiIn(this)\">
		  <table>
          <tr><th>Nama Tugas</th>     <td> : <input class='form-input-gray' type=text id=namaMateri name='namaMateri'></td></tr>
		  <tr><th>Kelas			</th><td> : <select id=idKelas name=idKelas class='formCmb'> <option value=0>== Pilih Kelas ==</option>"; 
									while ($rk=mysql_fetch_array($tampilKelas)){ 
										echo "<option value='$rk[id_kelas]'>$rk[nama_kelas]</option>";
									}
		  echo "</select></td></tr>
		  <tr><th>Mata Pelajaran	</th><td> : <select id=idMapel name=idMapel class='formCmb'> <option value=0>== Pilih Mata Pelajaran ==</option>"; 
									while ($rm=mysql_fetch_array($tampilMapel)){ 
										echo "<option value='$rm[id_mapel]'>$rm[nama_mapel]</option>";
									}
		  echo "</select></td></tr>
          <tr><th>Deskripsi</th>			   <td><textarea class='formText' id=deskripsi name=deskripsi width=100 height=50></textarea></td></tr>
          <tr><th>Berkas Tugas</th> <td> : <input class='formFile' type=file id=fupload name='fupload'></td></tr>  
          <tr><td colspan=2>
			<input type=submit class='button orange' value=Simpan>
			<input type=button class='button orange' value=Batal onclick=self.history.back()>
		  </td></tr>
          </table></form>";
     break;
    
  case "edit":
    $edit=mysql_query("SELECT * FROM tugas WHERE id_tugas='$_GET[id]'");
    $r=mysql_fetch_array($edit);

	$id_kelasR = $r['id_kelas'];
	$id_mapelR = $r['id_mapel'];
	
	$u=0;
	$select = mysql_query("select * from kelas ORDER BY nama_kelas");
	while($s=mysql_fetch_array($select)) {
		$id_kelasT[$u] = $s[id_kelas];
		$id_kelasS .= "<option value='$id_kelasT[$u]'";
		if($id_kelasR == $s['id_kelas']) 
			$id_kelasS .="selected";
		$id_kelasS .= ">$s[nama_kelas]</option>";
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
	
	echo "<form method=POST action='$aksi?module=gts&act=update' enctype='multipart/form-data' onSubmit=\"return validasiUp(this)\">
          <input type=hidden name=id value='$r[id_tugas]'>
          <input type=hidden name=fileLama value='$r[namafile_tugas]'>
		  <table>
          <tr><th>Nama Tugas</th>     <td> : <input class='form-input-gray' type=text id=namaMateri name='namaMateri' value='$r[nama_tugas]'>&nbsp;&nbsp;&nbsp;</td></tr>
		  <tr><th>Kelas			</th><td> : <select id=idKelas name=idKelas class='formCmb'>$id_kelasS</select>&nbsp;&nbsp;&nbsp;</td></tr>
		  <tr><th>Mata Pelajaran	</th><td> : <select id=idMapel name=idMapel class='formCmb'>$id_mapelS</select>&nbsp;&nbsp;&nbsp;</td></tr>
          <tr><th>Deskripsi</th>			   <td><textarea class='formText' id=deskripsi name=deskripsi width=100 height=50>$r[deskripsi_tugas]</textarea>&nbsp;&nbsp;&nbsp;</td></tr>
          <tr><th>Berkas Tugas</th> <td> : <input class='formFile' type=file id=fupload name='fupload'> *)</td></tr>  
          <tr><td colspan=2>*) Apabila Berkas Tugas Tidak Diubah, Dikosongkan Saja.</td></tr>
		  <tr><td colspan=2>
			<input type=submit class='button orange' value=Simpan>
			<input type=button class='button orange' value=Batal onclick=self.history.back()>
		  </td></tr>
          </table></form>";
    break;
	
	case "detail":
		require_once "modul/modGTS/detailGts.php";
    break;
	
	case "detailKumpul":
		require_once "modul/modGTS/detailGtsKumpul.php";
    break;
}
}
?>
