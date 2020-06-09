<script language="javascript">
	polaPass=/^[a-zA-Z0-9\_\-]{8,20}$/;
	function validasiIn(form){
	  if (form.nis.value == ""){
		alert("Anda Belum Memasukkan NIS");
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
		form.nip.focus();
		return (false);
	  }
	  if (form.idKelas.value == 0){
		alert("Anda Belum Memilih Kelas");
		form.idKelas.focus();
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
	  if (form.nis.value == ""){
		alert("Anda Belum Memasukkan NIS");
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
		form.nip.focus();
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
$aksi="modul/modSiswa/aksiSiswa.php";
switch($_GET['act']){
	//Hapus User
	case "delete":
    mysql_query("DELETE FROM siswa WHERE id_siswa='$_GET[id]'");
    mysql_query("DELETE FROM user WHERE username='$_GET[nis]'");
	echo "<script language=Javascript>
				window.alert('Data Berhasil Dihapus');
				self.history.back();
		</script>";
    break;
	
	// Tampil User
	default:
	
	$tampil = mysql_query("SELECT * FROM siswa,kelas WHERE kelas.id_kelas=siswa.id_kelas ORDER BY nama_kelas,nama");
	echo "<input class='button orange' type=button value='Tambah Siswa' onclick=\"window.location.href='?module=siswa&act=tambah';\">";
    
    echo "<br /><br /><table><thead>
          <tr>
          <th width='25'>No</th>
          <th width='120'>NIS</th>
          <th width=125>Nama Lengkap</th>
          <th width=125>Email</th>
          <th width=70>Kelas</th>
          <th colspan=2 width=60>Aksi</th>
          </tr></thead>";
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr>
				<td>$no</td>
				<td>$r[nis]</td>
				<td>$r[nama]</td>
				<td>$r[email]</td>
				<td>$r[nama_kelas]</td>
				<td><a href=?module=siswa&act=edit&id=$r[id_siswa]><img src='images/edit.png' border='0' title='Ubah' height='20' width='20' /></a></td>
				<td><a href=?module=siswa&act=delete&id=$r[id_siswa]&nis=$r[nis]><img src='images/delete.png' border='0' title='Hapus' height='20' width='20' /></a></td>
			</tr>";
      $no++;
    }
    echo "</table>";
    break;
  case "tambah":
	$tampilKelas = mysql_query("SELECT * FROM kelas ORDER BY nama_kelas");
    echo "<form method=POST action='$aksi?module=siswa&act=input' onSubmit=\"return validasiIn(this)\">
          <table>
          <tr><th>NIS			</th><td> : <input class='form-input-gray' type=text id='nis' name='nis'></td></tr>
          <tr><th>Nama Lengkap	</th><td> : <input class='form-input-gray' type=text id='namaLengkap' name='namaLengkap'></td></tr>
          <tr><th>Email			</th><td> : <input class='form-input-gray' type=text id='email' name='email'></td></tr>
          <tr><th>Kelas			</th><td> : <select id=idKelas name=idKelas class='formCmb'> <option value=0>== Pilih Kelas ==</option>"; 
									while ($rk=mysql_fetch_array($tampilKelas)){ 
										echo "<option value='$rk[id_kelas]'>$rk[nama_kelas]</option>";
									}
		  echo "</select></td></tr>
          <tr><th>Password		</th><td> : <input class='form-input-gray' type=text id='password' name='password'></td></tr>
          <tr><td colspan=2>
			<input type=submit class='button orange' value=Simpan>
			<input type=button class='button orange' value=Batal onclick=self.history.back()>
		  </td></tr>
          </table></form>";
     break;
    
  case "edit":	
    $edit=mysql_query("SELECT * FROM siswa WHERE id_siswa='$_GET[id]'");
    $r=mysql_fetch_array($edit);

	$id_kelasR = $r['id_kelas'];
	
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
	
    echo "<form method=POST action=$aksi?module=siswa&act=update onSubmit=\"return validasiUp(this)\">
          <input type=hidden name=id value='$r[id_siswa]'>
          <input type=hidden name=username value='$r[nis]'>
          <table>
		  <tr><th>NIS			</th><td> : <input class='form-input-gray' type=text id='nis' name='nis' value='$r[nis]'>&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
          <tr><th>Nama Lengkap	</th><td> : <input class='form-input-gray' type=text id='namaLengkap' name='namaLengkap' value='$r[nama]'>&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
          <tr><th>Email			</th><td> : <input class='form-input-gray' type=text id='email' name='email' value='$r[email]'>&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
		  <tr><th>Kelas			</th><td> : <select id=idKelas name=idKelas class='formCmb'>$id_kelasS</select>&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
          <tr><th>Password		</th><td> : <input class='form-input-gray' type=text id='password' name='password'> *)</td></tr>
		  <tr><td colspan=2>*) Apabila password tidak diubah, dikosongkan saja.</td></tr>
          <tr><td colspan=2><input class='button orange' type=submit value=Ubah>
                            <input type=button class='button orange' value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;
}
}
?>