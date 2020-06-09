<script language="javascript">
	function validasi(form){
	  if (form.namaMapel.value == ""){
		alert("Anda Belum Memasukkan Nama Mata Pelajaran");
		form.namaMapel.focus();
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
$aksi="modul/modMataPelajaran/aksiMataPelajaran.php";
switch($_GET['act']){
	//Hapus User
	case "delete":
    mysql_query("DELETE FROM mata_pelajaran WHERE id_mapel='$_GET[id]'");
	echo "<script language=Javascript>
				window.alert('Data Berhasil Dihapus');
				self.history.back();
		</script>";
    break;
	
	// Tampil User
	default:
	
	$tampil = mysql_query("SELECT * FROM mata_pelajaran ORDER BY nama_mapel");
	echo "<input class='button orange' type=button value='Tambah Mata Pelajaran' onclick=\"window.location.href='?module=matapelajaran&act=tambah';\">";
    
    echo "<br /><br /><table><thead>
          <tr>
          <th width='25'>No</th>
          <th width='160'>Nama Mata Pelajaran</th>
          <th width=300>Deskripsi Mata Pelajaran</th>
          <th colspan=2 width=60>Aksi</th>
          </tr></thead>";
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr>
				<td>$no</td>
				<td>$r[nama_mapel]</td>
				<td>$r[deskripsi_mapel]</td>
				<td><a href=?module=matapelajaran&act=edit&id=$r[id_mapel]><img src='images/edit.png' border='0' title='Ubah' height='20' width='20' /></a></td>
				<td><a href=?module=matapelajaran&act=delete&id=$r[id_mapel]><img src='images/delete.png' border='0' title='Hapus' height='20' width='20' /></a></td>
			</tr>";
      $no++;
    }
    echo "</table>";
    break;
  case "tambah":
    echo "<form method=POST action='$aksi?module=matapelajaran&act=input' onSubmit=\"return validasi(this)\">
          <table>
          <tr><th>Nama Mata Pelajaran</th>     <td> : <input class='form-input-gray' type=text id=namaMapel name='namaMapel'></td></tr>
          <tr><th>Deskripsi</th>			   <td><textarea class='formText' name=deskripsi width=100 height=50></textarea></td></tr>
          <tr><td colspan=2>
			<input type=submit class='button orange' value=Simpan>
			<input type=button class='button orange' value=Batal onclick=self.history.back()>
		  </td></tr>
          </table></form>";
     break;
    
  case "edit":
    $edit=mysql_query("SELECT * FROM mata_pelajaran WHERE id_mapel='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<form method=POST action=$aksi?module=matapelajaran&act=update onSubmit=\"return validasi(this)\">
          <input type=hidden name=id value='$r[id_mapel]'>
          <table>
          <tr><th>Nama Mata Pelajaran</th>     <td> : <input type=text class='form-input-gray' id=namaMapel name='namaMapel' value='$r[nama_mapel]'></td></tr>
          <tr><th>Deskripsi</th> <td><textarea class='formText' name=deskripsi width=100 height=50>$r[deskripsi_mapel]</textarea></td></tr>
          <tr><td class='left' colspan=2><input class='button orange' type=submit value=Ubah>
                            <input type=button class='button orange' value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;
}
}
?>
