<script language="javascript">
	function validasi(form){
	  if (form.namaBerita.value == ""){
		alert("Anda Belum Memasukkan Nama Berita");
		form.namaBerita.focus();
		return (false);
	  }
	  if (form.isiBerita.value == ""){
		alert("Anda Belum Memasukkan Isi Berita");
		form.isiBerita.focus();
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
$aksi="modul/modBerita/aksiBerita.php";
switch($_GET['act']){
	//Hapus User
	case "delete":
    mysql_query("DELETE FROM berita WHERE id_berita='$_GET[id]'");
	echo "<script language=Javascript>
				window.alert('Data Berhasil Dihapus');
				self.history.back();
		</script>";
    break;
	
	// Tampil User
	default:
	
	$tampil = mysql_query("SELECT * FROM berita ORDER BY tanggal DESC");
	echo "<input class='button orange' type=button value='Tambah Berita' onclick=\"window.location.href='?module=berita&act=tambah';\">";
    
    echo "<br /><br /><table><thead>
          <tr>
          <th width='25'>No</th>
          <th width='335'>Nama Berita</th>
          <th width='335'>Tanggal</th>
          <th width='335'>Isi Berita</th>
          <th colspan=2 width=60>Aksi</th>
          </tr></thead>"; 
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
		$tgl = tgl_indo($r[tanggal]);
       echo "<tr>
				<td>$no</td>
				<td>$r[nama_berita]</td>
				<td>$tgl</td>
				<td>$r[isi_berita]</td>
				<td><a href=?module=berita&act=edit&id=$r[id_berita]><img src='images/edit.png' border='0' title='Ubah' height='20' width='20' /></a></td>
				<td><a href=?module=berita&act=delete&id=$r[id_berita]><img src='images/delete.png' border='0' title='Hapus' height='20' width='20' /></a></td>
			</tr>";
      $no++;
    }
    echo "</table>";
    break;
  case "tambah":
	echo "<form method=POST action='$aksi?module=berita&act=input' onSubmit=\"return validasi(this)\">
		  <table>
          <tr><th>Nama Berita</th>     <td> : <input class='form-input-gray' type=text id=namaBerita name='namaBerita'></td></tr>
		  <tr><th>Isi Berita</th>	   <td><textarea class='formText' id=isiBerita name=isiBerita width=100 height=50></textarea></td></tr>
          <tr><td colspan=2>
			<input type=submit class='button orange' value=Simpan>
			<input type=button class='button orange' value=Batal onclick=self.history.back()>
		  </td></tr>
          </table></form>";
     break;
    
  case "edit":
    $edit=mysql_query("SELECT * FROM berita WHERE id_berita='$_GET[id]'");
    $r=mysql_fetch_array($edit);
	
	echo "<form method=POST action='$aksi?module=berita&act=update' onSubmit=\"return validasi(this)\">
          <input type=hidden name=id value='$r[id_berita]'>
          <table>
          <tr><th>Nama Berita</th>     <td> : <input class='form-input-gray' type=text id=namaBerita name='namaBerita' value='$r[nama_berita]'>&nbsp;&nbsp;&nbsp;</td></tr>
		  <tr><th>Isi Berita</th>	   <td><textarea class='formText' id=isiBerita name=isiBerita width=100 height=50>$r[isi_berita]</textarea>&nbsp;&nbsp;&nbsp;</td></tr>
          <tr><td colspan=2>
			<input type=submit class='button orange' value=Simpan>
			<input type=button class='button orange' value=Batal onclick=self.history.back()>
		  </td></tr>
          </table></form>";
    break;
}
}
?>
