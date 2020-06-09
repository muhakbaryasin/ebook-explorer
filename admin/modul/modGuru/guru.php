<script language="javascript">
	polaPass=/^[a-zA-Z0-9\_\-]{8,20}$/;
	function validasiIn(form){
	  if (form.nip.value == ""){
		alert("Anda Belum Memasukkan NIP");
		form.nip.focus();
		return (false);
	  }
	  if (form.namaLengkap.value == ""){
		alert("Anda Belum Memasukkan Nama Lengkap");
		form.namaLengkap.focus();
		return (false);
	  }
	  if (form.email.value == ""){
		alert("Anda Belum Memasukkan Email");
		form.email.focus();
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
	  return (true);
	}
	
	function validasiUp(form){
	  if (form.nip.value == ""){
		alert("Anda Belum Memasukkan NIP");
		form.nip.focus();
		return (false);
	  }
	  if (form.namaLengkap.value == ""){
		alert("Anda Belum Memasukkan Nama Lengkap");
		form.namaLengkap.focus();
		return (false);
	  }
	  if (form.email.value == ""){
		alert("Anda Belum Memasukkan Email");
		form.email.focus();
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
$aksi="modul/modGuru/aksiGuru.php";
switch($_GET['act']){
	//Hapus User
	case "delete":
    mysql_query("DELETE FROM guru WHERE id_guru='$_GET[id]'");
    mysql_query("DELETE FROM user WHERE username='$_GET[nip]'");
	echo "<script language=Javascript>
				window.alert('Data Berhasil Dihapus');
				self.history.back();
		</script>";
    break;
	
	// Tampil User
	default:
	
	$tampil = mysql_query("SELECT * FROM guru ORDER BY nama");
	echo "<input class='button orange' type=button value='Tambah Guru' onclick=\"window.location.href='?module=guru&act=tambah';\">";
    
    echo "<br /><br /><table><thead>
          <tr>
          <th width='25'>No</th>
          <th width='140'>NIP</th>
          <th width=150>Nama Lengkap</th>
          <th width=150>Email</th>
          <th colspan=2 width=60>Aksi</th>
          </tr></thead>";
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr>
				<td>$no</td>
				<td>$r[nip]</td>
				<td>$r[nama]</td>
				<td>$r[email]</td>
				<td><a href=?module=guru&act=edit&id=$r[id_guru]><img src='images/edit.png' border='0' title='Ubah' height='20' width='20' /></a></td>
				<td><a href=?module=guru&act=delete&id=$r[id_guru]&nip=$r[nip]><img src='images/delete.png' border='0' title='Hapus' height='20' width='20' /></a></td>
			</tr>";
      $no++;
    }
    echo "</table>";
    break;
  case "tambah":
    echo "<form method=POST action='$aksi?module=guru&act=input' onSubmit=\"return validasiIn(this)\">
          <table>
          <tr><th>NIP			</th><td> : <input class='form-input-gray' type=text id='nip' name='nip'></td></tr>
          <tr><th>Nama Lengkap	</th><td> : <input class='form-input-gray' type=text id='namaLengkap' name='namaLengkap'></td></tr>
          <tr><th>Email			</th><td> : <input class='form-input-gray' type=text id='email' name='email'></td></tr>
          <tr><th>Password		</th><td> : <input class='form-input-gray' type=text id='password' name='password'></td></tr>
          <tr><td colspan=2>
			<input type=submit class='button orange' value=Simpan>
			<input type=button class='button orange' value=Batal onclick=self.history.back()>
		  </td></tr>
          </table></form>";
     break;
    
  case "edit":
    $edit=mysql_query("SELECT * FROM guru WHERE id_guru='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<form method=POST action=$aksi?module=guru&act=update onSubmit=\"return validasiUp(this)\">
          <input type=hidden name=id value='$r[id_guru]'>
          <input type=hidden name=username value='$r[nip]'>
          <table>
		  <tr><th>NIP			</th><td> : <input class='form-input-gray' type=text id='nip' name='nip' value='$r[nip]'>&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
          <tr><th>Nama Lengkap	</th><td> : <input class='form-input-gray' type=text id='namaLengkap' name='namaLengkap' value='$r[nama]'>&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
          <tr><th>Email			</th><td> : <input class='form-input-gray' type=text id='email' name='email' value='$r[email]'>&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
          <tr><th>Password		</th><td> : <input class='form-input-gray' type=text id='password' name='password'> *)</td></tr>
		  <tr><td colspan=2>*) Apabila password tidak diubah, dikosongkan saja.</td></tr>
          <tr><td colspan=2><input class='button orange' type=submit value=Ubah>
                            <input type=button class='button orange' value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;
}
}
?>