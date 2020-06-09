<script language="javascript">
	function validasi(form){
	  if (form.namaKelas.value == ""){
		alert("Anda Belum Memasukkan Nama Kelas");
		form.namaKelas.focus();
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
$aksi="modul/modKelas/aksiKelas.php";
switch($_GET['act']){
	//Hapus User
	case "delete":
    mysql_query("DELETE FROM kelas WHERE id_kelas='$_GET[id]'");
	echo "<script language=Javascript>
				window.alert('Data Berhasil Dihapus');
				self.history.back();
		</script>";
    break;
	
	// Tampil User
	default:
	
	$tampil = mysql_query("SELECT * FROM kelas ORDER BY nama_kelas");
	echo "<input class='button orange' type=button value='Tambah Kelas' onclick=\"window.location.href='?module=kelas&act=tambah';\">";
    
    echo "<br /><br /><table><thead>
          <tr>
          <th width='25'>No</th>
          <th width='160'>Kelas</th>
          <th width=300>Deskripsi Kelas</th>
          <th colspan=2 width=60>Aksi</th>
          </tr></thead>";
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr>
				<td>$no</td>
				<td>$r[nama_kelas]</td>
				<td>$r[deskripsi_kelas]</td>
				<td><a href=?module=kelas&act=edit&id=$r[id_kelas]><img src='images/edit.png' border='0' title='Ubah' height='20' width='20' /></a></td>
				<td><a href=?module=kelas&act=delete&id=$r[id_kelas]><img src='images/delete.png' border='0' title='Hapus' height='20' width='20' /></a></td>
			</tr>";
      $no++;
    }
    echo "</table>";
    break;
  case "tambah":
    echo "<form method=POST action='$aksi?module=kelas&act=input' onSubmit=\"return validasi(this)\">
          <table>
          <tr><th>Kelas</th>     <td> : <input class='form-input-gray' type=text id='namaKelas' name='namaKelas'></td></tr>
          <tr><th>Deskripsi</th>			   <td><textarea class='formText' name=deskripsi width=100 height=50></textarea></td></tr>
          <tr><td colspan=2>
			<input type=submit class='button orange' value=Simpan>
			<input type=button class='button orange' value=Batal onclick=self.history.back()>
		  </td></tr>
          </table></form>";
     break;
    
  case "edit":
    $edit=mysql_query("SELECT * FROM kelas WHERE id_kelas='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<form method=POST action=$aksi?module=kelas&act=update onSubmit=\"return validasi(this)\">
          <input type=hidden name=id value='$r[id_kelas]'>
          <table>
          <tr><th>Kelas</th>     <td> : <input type=text class='form-input-gray' name='namaKelas' id='namaKelas' value='$r[nama_kelas]'></td></tr>
          <tr><th>Deskripsi</th> <td><textarea class='formText' name=deskripsi width=100 height=50>$r[deskripsi_kelas]</textarea></td></tr>
          <tr><td class='left' colspan=2><input class='button orange' type=submit value=Ubah>
                            <input type=button class='button orange' value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;
}
}
?>
