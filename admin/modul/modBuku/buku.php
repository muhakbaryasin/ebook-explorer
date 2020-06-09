<script language="javascript">
	function validasi(form){
	  if (form.judul.value == ""){
		alert("Anda Belum Memasukkan Judul Buku");
		form.judul.focus();
		return (false);
	  }    
	  if (form.kategori.value == 0){
		alert("Anda Belum Memilih Kategori");
		form.kategori.focus();
		return (false);
	  }
	  if (form.jenis.value == 0){
		alert("Anda Belum Memilih Jenis");
		form.jenis.focus();
		return (false);
	  }
	  if (form.penerbit.value == 0){
		alert("Anda Belum Memilih Penerbit");
		form.penerbit.focus();
		return (false);
	  }
	  if (form.pengarang.value == ""){
		alert("Anda Belum Memasukkan Nama Pengarang");
		form.pengarang.focus();
		return (false);
	  }
	  if (form.tahun.value == ""){
		alert("Anda Belum Memasukkan Tahun");
		form.tahun.focus();
		return (false);
	  }
	  if (form.fupload.value == ""){
		alert("Anda Belum Memasukkan Berkas e-Book");
		form.fupload.focus();
		return (false);
	  }
	  return (true);
	}
	
	function validasiUp(form){
	  if (form.judul.value == ""){
		alert("Anda Belum Memasukkan Judul Buku");
		form.judul.focus();
		return (false);
	  }
	  if (form.pengarang.value == ""){
		alert("Anda Belum Memasukkan Nama Pengarang");
		form.pengarang.focus();
		return (false);
	  }
	  if (form.tahun.value == ""){
		alert("Anda Belum Memasukkan Tahun");
		form.tahun.focus();
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
$aksi="modul/modBuku/aksiBuku.php";
switch($_GET['act']){
	//Hapus User
	case "delete":
	$tampil = mysql_query("SELECT * FROM buku WHERE id_buku=$_GET[id]");
	$r=mysql_fetch_array($tampil);
	unlink("../files/$r[nama_file]");
    mysql_query("DELETE FROM buku WHERE id_buku='$_GET[id]'");
	echo "<script language=Javascript>
				window.alert('Data Berhasil Dihapus');
				self.history.back();
		</script>";
    break;
	
	// Tampil User
	default:
	
	$tampil = mysql_query("SELECT * FROM buku b,kategori k,jenis j,penerbit p WHERE b.id_kategori=k.id_kategori AND b.id_jenis=j.id_jenis AND b.id_penerbit=p.id_penerbit ORDER BY judul ASC");
	echo "<input class='button orange' type=button value='Tambah Buku' onclick=\"window.location.href='?module=buku&act=tambah';\">";
    
    echo "<br /><br /><table><thead>
          <tr>
          <th width='25'>No</th>
          <th>Judul</th>
          <th>Kategori</th>
          <th>Jenis</th>
          <th>Penerbit</th>
          <th>Pengarang</th>
          <th>Tahun</th>
          <th colspan=2 width=60>Aksi</th>
          </tr></thead>"; 
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
		$tgl = tgl_indo($r[tanggal]);
       echo "<tr>
				<td>$no</td>
				<td>$r[judul]</td>
				<td>$r[nama_kategori]</td>
				<td>$r[nama_jenis]</td>
				<td>$r[nama_penerbit]</td>
				<td>$r[nama_pengarang]</td>
				<td>$r[tahun]</td>
				<td><a href=?module=buku&act=edit&id=$r[id_buku]><img src='images/edit.png' border='0' title='Ubah' height='20' width='20' /></a></td>
				<td><a href=?module=buku&act=delete&id=$r[id_buku]><img src='images/delete.png' border='0' title='Hapus' height='20' width='20' /></a></td>
			</tr>";
      $no++;
    }
    echo "</table>";
    break;
  case "tambah":
	$tampilKategori = mysql_query("SELECT * FROM kategori 	ORDER BY nama_kategori");
	$tampilJenis 	= mysql_query("SELECT * FROM jenis 		ORDER BY nama_jenis");
	$tampilPenerbit = mysql_query("SELECT * FROM penerbit	ORDER BY nama_penerbit");
	echo "<form method=POST action='$aksi?module=buku&act=input' enctype=\"multipart/form-data\" onSubmit=\"return validasi(this)\">
		  <table>
          <tr><th>Judul</th>     <td> : <input class='form-input-gray' type=text id=judul name='judul'></td></tr>
          <tr valign=top><th>Deskripsi</th>     <td valign='top'><textarea style=\"height:100px;\" class='form-input-gray' name='desk'></textarea></td></tr>
		  <tr><th>Kategori			</th><td> : <select id=kategori name=kategori class='formCmb'> <option value=0>== Pilih Kategori ==</option>"; 
									while ($rk=mysql_fetch_array($tampilKategori)){ 
										echo "<option value='$rk[id_kategori]'>$rk[nama_kategori]</option>";
									}
		  echo "</select></td></tr>
		  <tr><th>Jenis </th><td> : <select id=jenis name=jenis class='formCmb'> <option value=0>== Pilih Jenis ==</option>"; 
									while ($rj=mysql_fetch_array($tampilJenis)){ 
										echo "<option value='$rj[id_jenis]'>$rj[nama_jenis]</option>";
									}
		  echo "</select></td></tr>
		  <tr><th>Penerbit </th><td> : <select id=penerbit name=penerbit class='formCmb'> <option value=0>== Pilih Penerbit ==</option>"; 
									while ($rp=mysql_fetch_array($tampilPenerbit)){ 
										echo "<option value='$rp[id_penerbit]'>$rp[nama_penerbit]</option>";
									}
		  echo "</select></td></tr>
		  <tr><th>Pengarang</th>     <td> : <input class='form-input-gray' type=text id=pengarang name='pengarang'></td></tr>
		  <tr><th>Tahun</th>     <td> : <input class='form-input-gray' type=text id=tahun name='tahun'></td></tr>
          <tr><th>Berkas e-Book</th> <td> : <input class='formFile' type=file id=fupload name='fupload'></td></tr>  
          <tr><td colspan=2>
			<input type=submit class='button orange' value=Simpan>
			<input type=button class='button orange' value=Batal onclick=self.history.back()>
		  </td></tr>
          </table></form>";
     break;
    
  case "edit":
    $edit=mysql_query("SELECT * FROM buku WHERE id_buku='$_GET[id]'");
    $r=mysql_fetch_array($edit);

	$id_kategoriR 	= $r['id_kategori'];
	$id_jenisR 		= $r['id_jenis'];
	$id_penerbitR	= $r['id_penerbit'];
	
	$u=0;
	$select = mysql_query("select * from kategori ORDER BY nama_kategori");
	while($s=mysql_fetch_array($select)) {
		$id_kategoriT[$u] = $s[id_kategori];
		$id_kategoriS .= "<option value='$id_kategoriT[$u]'";
		if($id_kategoriR == $s['id_kategori']) 
			$id_kategoriS .="selected";
		$id_kategoriS .= ">$s[nama_kategori]</option>";
		$u++;
	}
	
	$u=0;
	$select = mysql_query("select * from jenis ORDER BY nama_jenis");
	while($s=mysql_fetch_array($select)) {
		$id_jenisT[$u] = $s[id_jenis];
		$id_jenisS .= "<option value='$id_jenisT[$u]'";
		if($id_jenisR == $s['id_jenis']) 
			$id_jenisS .="selected";
		$id_jenisS .= ">$s[nama_jenis]</option>";
		$u++;
	}
	
	$u=0;
	$select = mysql_query("select * from penerbit ORDER BY nama_penerbit");
	while($s=mysql_fetch_array($select)) {
		$id_penerbitT[$u] = $s[id_penerbit];
		$id_penerbitS .= "<option value='$id_penerbitT[$u]'";
		if($id_penerbitR == $s['id_penerbit']) 
			$id_penerbitS .="selected";
		$id_penerbitS .= ">$s[nama_penerbit]</option>";
		$u++;
	}
	
	echo "<form method=POST action='$aksi?module=buku&act=update' enctype='multipart/form-data' onSubmit=\"return validasiUp(this)\">
          <input type=hidden name=id value='$r[id_buku]'>
          <input type=hidden name=fileLama value='$r[nama_file]'>
		  <table>
          <tr><th>Judul Buku</th>     <td> : <input class='form-input-gray' type=text id=judul name='judul' value='$r[judul]'>&nbsp;&nbsp;&nbsp;</td></tr>
          <tr valign=top><th>Deskripsi</th>     <td valign='top'><textarea style=\"height:100px;\" class='form-input-gray' name='desk'>$r[deskripsi]</textarea></td></tr>
		  <tr><th>Kategori			</th><td> : <select id=kategori name=kategori class='formCmb'>$id_kategoriS</select>&nbsp;&nbsp;&nbsp;</td></tr>
		  <tr><th>Jenis			</th><td> : <select id=jenis name=jenis class='formCmb'>$id_jenisS</select>&nbsp;&nbsp;&nbsp;</td></tr>
		  <tr><th>Penerbit			</th><td> : <select id=penerbit name=penerbit class='formCmb'>$id_penerbitS</select>&nbsp;&nbsp;&nbsp;</td></tr>
		  <tr><th>Pengarang</th>     <td> : <input class='form-input-gray' type=text id=pengarang name='pengarang' value='$r[nama_pengarang]'>&nbsp;&nbsp;&nbsp;</td></tr>
		  <tr><th>Tahun</th>     <td> : <input class='form-input-gray' type=text id=tahun name='tahun' value='$r[tahun]'>&nbsp;&nbsp;&nbsp;</td></tr>
          <tr><th>Berkas e-Book</th> <td> : <input class='formFile' type=file id=fupload name='fupload'> *)</td></tr>  
          <tr><td colspan=2>*) Apabila Berkas Materi Tidak Diubah, Dikosongkan Saja.</td></tr>
		  <tr><td colspan=2>
			<input type=submit class='button orange' value=Simpan>
			<input type=button class='button orange' value=Batal onclick=self.history.back()>
		  </td></tr>
          </table></form>";
    break;
	
	case "detail":
		require_once "modul/modGMT/detailGmt.php";
    break;
}
}
?>
