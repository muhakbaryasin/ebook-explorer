<script language="javascript">
	function validasi(form){
	  if (form.namaPenerbit.value == ""){
		alert("Anda Belum Memasukkan Nama Penerbit");
		form.namaPenerbit.focus();
		return (false);
	  } else if (form.alamat.value == ""){
		alert("Anda Belum Memasukkan Alamat");
		form.alamat.focus();
		return (false);
	  } else if (form.kota.value == ""){
		alert("Anda Belum Memasukkan Kota");
		form.kota.focus();
		return (false);
	  } else if (form.email.value == ""){
		alert("Anda Belum Memasukkan Email");
		form.email.focus();
		return (false);
	  } else if (form.telp.value == ""){
		alert("Anda Belum Memasukkan Telp");
		form.telp.focus();
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
$aksi="modul/modPenerbit/aksiPenerbit.php";
switch($_GET['act']){
	//Hapus User
	case "delete":
    mysql_query("DELETE FROM penerbit WHERE id_penerbit='$_GET[id]'");
	echo "<script language=Javascript>
				window.alert('Data Berhasil Dihapus');
				self.history.back();
		</script>";
    break;
	
	// Tampil User
	default:
	
	$tampil = mysql_query("SELECT * FROM penerbit ORDER BY nama_penerbit");
	echo "<input class='button orange' type=button value='Tambah Penerbit' onclick=\"window.location.href='?module=penerbit&act=tambah';\">";
    
    echo "<br /><br /><table><thead>
          <tr>
          <th width='25'>No</th>
          <th>Nama Penerbit</th>
          <th>Alamat</th>
          <th>Kota</th>
          <th>Email</th>
          <th>Telp</th>
          <th colspan=2 width=60>Aksi</th>
          </tr></thead>";
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr>
				<td>$no</td>
				<td>$r[nama_penerbit]</td>
				<td>$r[alamat]</td>
				<td>$r[kota]</td>
				<td>$r[email]</td>
				<td>$r[telp]</td>
				<td><a href=?module=penerbit&act=edit&id=$r[id_penerbit]><img src='images/edit.png' border='0' title='Ubah' height='20' width='20' /></a></td>
				<td><a href=?module=penerbit&act=delete&id=$r[id_penerbit]><img src='images/delete.png' border='0' title='Hapus' height='20' width='20' /></a></td>
			</tr>";
      $no++;
    }
    echo "</table>";
    break;
  case "tambah":
    echo "<form method=POST action='$aksi?module=penerbit&act=input' onSubmit=\"return validasi(this)\">
          <table>
          <tr><th>Nama Penerbit</th>     <td> : <input class='form-input-gray' type=text id=namaPenerbit name='namaPenerbit'></td></tr>
          <tr><th>Alamat</th>     <td> <textarea class='formText' id=alamat name=alamat width=100 height=50></textarea></td></tr>
          <tr><th>Kota</th>     <td> : <input class='form-input-gray' type=text id=kota name='kota'></td></tr>
          <tr><th>Email</th>     <td> : <input class='form-input-gray' type=text id=email name='email'></td></tr>
          <tr><th>Telp</th>     <td> : <input class='form-input-gray' type=text id=telp name='telp'></td></tr>
          <tr><td colspan=2>
			<input type=submit class='button orange' value=Simpan>
			<input type=button class='button orange' value=Batal onclick=self.history.back()>
		  </td></tr>
          </table></form>";
     break;
    
  case "edit":
    $edit=mysql_query("SELECT * FROM penerbit WHERE id_penerbit='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<form method=POST action=$aksi?module=penerbit&act=update onSubmit=\"return validasi(this)\">
          <input type=hidden name=id value='$r[id_penerbit]'>
          <table>
          <tr><th>Nama Penerbit</th>     <td> : <input class='form-input-gray' type=text id=namaPenerbit name='namaPenerbit' value='$r[nama_penerbit]'></td></tr>
          <tr><th>Alamat</th>     <td> <textarea class='formText' id=alamat name=alamat width=100 height=50>$r[alamat]</textarea></td></tr>
          <tr><th>Kota</th>     <td> : <input class='form-input-gray' type=text id=kota name='kota' value='$r[kota]'></td></tr>
          <tr><th>Email</th>     <td> : <input class='form-input-gray' type=text id=email name='email' value='$r[email]'></td></tr>
          <tr><th>Telp</th>     <td> : <input class='form-input-gray' type=text id=telp name='telp' value='$r[email]'></td></tr>
          <tr><td class='left' colspan=2><input class='button orange' type=submit value=Ubah>
                            <input type=button class='button orange' value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;
}
}
?>
