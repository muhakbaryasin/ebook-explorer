<?php
	if($_GET['module']=="home"){
		echo "<table><thead>
				<th colspan=5><center>Control Panel</center></th></thead>
				<tr>
				  <td width=200 align=center><a href=media.php?module=buku><img src=images/logo_buku.png width=100 height=100 border=none><br /><b>Daftar Buku</b></a></td>
				  <td width=200 align=center><a href=media.php?module=kategori><img src=images/logo_kategori.png width=100 height=100 border=none><br /><b>Kategori Buku</b></a></td>
				  <td width=200 align=center><a href=media.php?module=jenis><img src=images/logo_jenis.png width=100 height=100 border=none><br /><b>Jenis Buku</b></a></td>
				  <td width=200 align=center><a href=media.php?module=penerbit><img src=images/logo_penerbit.png width=100 height=100 border=none><br /><b>Penerbit</b></a></td>
				  <td width=200 align=center><a href=media.php?module=user><img src=images/logo_pengguna.png width=100 height=100 border=none><br /><b>Pengguna Sistem</b></a></td>
				</tr>
			</table>";
	} else if($_GET['module']=="gantipassword"){
		echo "<br />";
		include "modul/modPassword/password.php";
	} else if($_GET['module']=="users"){
		echo "<br />";
		include "modul/modUsers/users.php";
	} 
	
	  else if($_GET['module']=="kategori"){
		echo "<br />";
		include "modul/modKategori/kategori.php";
	} else if($_GET['module']=="jenis"){
		echo "<br />";
		include "modul/modJenis/jenis.php";
	} else if($_GET['module']=="penerbit"){
		echo "<br />";
		include "modul/modPenerbit/penerbit.php";
	} else if($_GET['module']=="buku"){
		echo "<br />";
		include "modul/modBuku/buku.php";
	} 
?>