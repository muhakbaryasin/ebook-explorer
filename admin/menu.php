<?php
	echo "<div id='menu'><ul>";
		if($_GET['module']=="home") { echo "<li class='current_page_item'><a href='media.php?module=home'>Beranda</a></li>"; } else { echo "<li><a href='media.php?module=home'>Beranda</a></li>"; }
		if($_GET['module']=="buku") { echo "<li class='current_page_item'><a href='media.php?module=buku'>Buku</a></li>"; } else { echo "<li><a href='media.php?module=buku'>Buku</a></li>"; }
		if($_GET['module']=="kategori") { echo "<li class='current_page_item'><a href='media.php?module=kategori'>Kategori</a></li>"; } else { echo "<li><a href='media.php?module=kategori'>Kategori</a></li>"; }
		if($_GET['module']=="jenis") { echo "<li class='current_page_item'><a href='media.php?module=jenis'>Jenis Buku</a></li>"; } else { echo "<li><a href='media.php?module=jenis'>Jenis Buku</a></li>"; }
		if($_GET['module']=="penerbit") { echo "<li class='current_page_item'><a href='media.php?module=penerbit'>Penerbit</a></li>"; } else { echo "<li><a href='media.php?module=penerbit'>Penerbit</a></li>"; }
		if($_GET['module']=="users") { echo "<li class='current_page_item'><a href='media.php?module=users'>Pengguna Sistem</a></li>"; } else { echo "<li><a href='media.php?module=users'>Pengguna Sistem</a></li>"; }
	echo "</ul></div>";
?>