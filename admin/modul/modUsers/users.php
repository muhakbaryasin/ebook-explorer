<script language="javascript">
	polaPass=/^[a-zA-Z0-9\_\-]{8,20}$/;
	
	function validasiIn(form){
	  if (form.username.value == ""){
		alert("Anda Belum Memasukkan Username");
		form.username.focus();
		return (false);
	  }    
	  if (form.password.value == ""){
		alert("Anda Belum Memasukkan Password");
		form.password.focus();
		return (false);
	  }
	  if (!polaPass.test(form.password.value)){
        alert('Password minimal 8 karakter dan maksimal 20 karakter.\nPassword hanya boleh menggunakan kombinasi Huruf dan Angka.');
        form.password.focus();
        return (false);
	  }
	  if (form.namalengkap.value == ""){
		alert("Anda Belum Memasukkan Nama Lengkap");
		form.namalengkap.focus();
		return (false);
	  }
	  return (true);
	}
	
	function validasiUp(form){
	  if (form.namalengkap.value == ""){
		alert("Anda Belum Memasukkan Nama Lengkap");
		form.namalengkap.focus();
		return (false);
	  }
	  if(form.password.value != ""){
		if (!polaPass.test(form.password.value)){
			alert('Password minimal 8 karakter dan maksimal 20 karakter.\nPassword hanya boleh menggunakan kombinasi Huruf dan Angka.');
			form.password.focus();
			return (false);
		  }
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
$aksi="modul/modUsers/aksiUsers.php";
switch($_GET['act']){
	//Hapus User
	case "deleteuser":
    mysql_query("DELETE FROM user WHERE id_user='$_GET[id]'");
	echo "<script language=Javascript>
				window.alert('Data Berhasil Dihapus');
				self.history.back();
		</script>";
    break;
	
	// Tampil User
	default:
	
	$tampil = mysql_query("SELECT * FROM user ORDER BY username");
	echo "<input class='button orange' type=button value='Tambah Pengguna' onclick=\"window.location.href='?module=users&act=tambahuser';\">";
    
    echo "<br /><br /><table><thead>
          <tr>
          <th width='25'>No</th>
          <th width='125'>Username</th>
          <th width=410>Nama Lengkap</th>
          <th colspan=2 width=60>Aksi</th>
          </tr></thead>"; 
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr>
				<td>$no</td>
				<td>$r[username]</td>
				<td>$r[nama_lengkap]</td>
				<td>"; 
					if($_SESSION['namauser']!='admin'){
						if($r['username']=='admin'){} 
						else { 
							echo "<a href=?module=users&act=edituser&id=$r[id_user]><img src='images/edit.png' border='0' title='Ubah' height='20' width='20' /></a>";
						}
					} 
					else { 
						echo "<a href=?module=users&act=edituser&id=$r[id_user]><img src='images/edit.png' border='0' title='Ubah' height='20' width='20' /></a>"; 
					} 
			echo "</td><td>"; 
					if($r['username']=='admin'){} 
					else { 
						echo "<a href=?module=users&act=deleteuser&id=$r[id_user]><img src='images/delete.png' border='0' title='Hapus' height='20' width='20' /></a>"; 
					} 
			echo "</td></tr>";
      $no++;
    }
    echo "</table>";
    break;
  case "tambahuser":
    echo "<form method=POST action='$aksi?module=users&act=input' onSubmit=\"return validasiIn(this)\">
          <table>
          <tr><th>Username</th>     <td> : <input class='form-input-gray' type=text id=username name='username'></td></tr>
          <tr><th>Password</th>     <td> : <input class='form-input-gray' type=text id=password name='password'></td></tr>
          <tr><th>Nama Lengkap</th> <td> : <input class='form-input-gray' type=text id=namalengkap name='nama_lengkap'></td></tr>  
          <tr><td colspan=2>
			<input type=submit class='button orange' value=Simpan>
			<input type=button class='button orange' value=Batal onclick=self.history.back()>
		  </td></tr>
          </table></form>";
     break;
    
  case "edituser":
    $edit=mysql_query("SELECT * FROM user WHERE id_user='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<form method=POST action=$aksi?module=users&act=update onSubmit=\"return validasiUp(this)\">
          <input type=hidden name=id value='$r[id_user]'>
          <input type=hidden name=uname value='$r[username]'>
          <table>
          <tr><th>Username</th>     <td> : <input type=text class='form-input-gray' id=username name='username' value='$r[username]' disabled /> **)</td></tr>
          <tr><th>Password</th>     <td> : <input type=text class='form-input-gray' id=password name='password'> *)&nbsp;&nbsp;</td></tr>
          <tr><th>Nama Lengkap</th> <td> : <input type=text class='form-input-gray' id=namalengkap name='nama_lengkap' size=30  value='$r[nama_lengkap]'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
		  <tr><td colspan=2>*) Apabila password tidak diubah, dikosongkan saja.<br />
                            **) Username tidak bisa diubah.</td></tr>
          <tr><td colspan=2><input class='button orange' type=submit value=Ubah>
                            <input type=button class='button orange' value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;
}
}
?>
