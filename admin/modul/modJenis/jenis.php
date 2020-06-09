<script language="javascript">
	function validasi(form){
	  if (form.namaJenis.value == ""){
		alert("Anda Belum Memasukkan Jenis Buku");
		form.namaJenis.focus();
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
$aksi="modul/modJenis/aksiJenis.php";
switch($_GET['act']){
	//Hapus User
	case "delete":
    mysql_query("DELETE FROM jenis WHERE id_jenis='$_GET[id]'");
	echo "<script language=Javascript>
				window.alert('Data Berhasil Dihapus');
				self.history.back();
		</script>";
    break;
	
	// Tampil User
	default:
	
	$tampil = mysql_query("SELECT * FROM jenis ORDER BY nama_jenis");
	echo "<input class='button orange' type=button value='Tambah Jenis Buku' onclick=\"window.location.href='?module=jenis&act=tambah';\">";
    
    echo "<br /><br /><table><thead>
          <tr>
          <th width='25'>No</th>
          <th width='160'>Jenis Buku</th>
          <th colspan=2 width=60>Aksi</th>
          </tr></thead>";
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr>
				<td>$no</td>
				<td>$r[nama_jenis]</td>
				<td><a href=?module=jenis&act=edit&id=$r[id_jenis]><img src='images/edit.png' border='0' title='Ubah' height='20' width='20' /></a></td>
				<td><a href=?module=jenis&act=delete&id=$r[id_jenis]><img src='images/delete.png' border='0' title='Hapus' height='20' width='20' /></a></td>
			</tr>";
      $no++;
    }
    echo "</table>";
    break;
  case "tambah":
    echo "<form method=POST action='$aksi?module=jenis&act=input' onSubmit=\"return validasi(this)\">
          <table>
          <tr><th>Jenis Buku</th>     <td> : <input class='form-input-gray' type=text id=namaJenis name='namaJenis'></td></tr>
          <tr><td colspan=2>
			<input type=submit class='button orange' value=Simpan>
			<input type=button class='button orange' value=Batal onclick=self.history.back()>
		  </td></tr>
          </table></form>";
     break;
    
  case "edit":
    $edit=mysql_query("SELECT * FROM jenis WHERE id_jenis='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<form method=POST action=$aksi?module=jenis&act=update onSubmit=\"return validasi(this)\">
          <input type=hidden name=id value='$r[id_jenis]'>
          <table>
          <tr><th>Jenis Buku</th>     <td> : <input type=text class='form-input-gray' id=namaJenis name='namaJenis' value='$r[nama_jenis]'></td></tr>
          <tr><td class='left' colspan=2><input class='button orange' type=submit value=Ubah>
                            <input type=button class='button orange' value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;
}
}
?>
