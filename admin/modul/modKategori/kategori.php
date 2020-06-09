<script language="javascript">
	function validasi(form){
	  if (form.namaKategori.value == ""){
		alert("Anda Belum Memasukkan Nama Kategori");
		form.namaKategori.focus();
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
$aksi="modul/modKategori/aksiKategori.php";
switch($_GET['act']){
	//Hapus User
	case "delete":
    mysql_query("DELETE FROM kategori WHERE id_kategori='$_GET[id]'");
	echo "<script language=Javascript>
				window.alert('Data Berhasil Dihapus');
				self.history.back();
		</script>";
    break;
	
	// Tampil User
	default:
	
	$tampil = mysql_query("SELECT * FROM kategori ORDER BY nama_kategori");
	echo "<input class='button orange' type=button value='Tambah Kategori' onclick=\"window.location.href='?module=kategori&act=tambah';\">";
    
    echo "<br /><br /><table><thead>
          <tr>
          <th width='25'>No</th>
          <th width='160'>Nama Kategori</th>
          <th colspan=2 width=60>Aksi</th>
          </tr></thead>";
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr>
				<td>$no</td>
				<td>$r[nama_kategori]</td>
				<td><a href=?module=kategori&act=edit&id=$r[id_kategori]><img src='images/edit.png' border='0' title='Ubah' height='20' width='20' /></a></td>
				<td><a href=?module=kategori&act=delete&id=$r[id_kategori]><img src='images/delete.png' border='0' title='Hapus' height='20' width='20' /></a></td>
			</tr>";
      $no++;
    }
    echo "</table>";
    break;
  case "tambah":
    echo "<form method=POST action='$aksi?module=kategori&act=input' onSubmit=\"return validasi(this)\">
          <table>
          <tr><th>Nama Kategori</th>     <td> : <input class='form-input-gray' type=text id=namaKategori name='namaKategori'></td></tr>
          <tr><td colspan=2>
			<input type=submit class='button orange' value=Simpan>
			<input type=button class='button orange' value=Batal onclick=self.history.back()>
		  </td></tr>
          </table></form>";
     break;
    
  case "edit":
    $edit=mysql_query("SELECT * FROM kategori WHERE id_kategori='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<form method=POST action=$aksi?module=kategori&act=update onSubmit=\"return validasi(this)\">
          <input type=hidden name=id value='$r[id_kategori]'>
          <table>
          <tr><th>Nama Kategori</th>     <td> : <input type=text class='form-input-gray' id=namaKategori name='namaKategori' value='$r[nama_kategori]'></td></tr>
          <tr><td class='left' colspan=2><input class='button orange' type=submit value=Ubah>
                            <input type=button class='button orange' value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;
}
}
?>
