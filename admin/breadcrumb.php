<?php
if($_GET['module']=='home'){
	echo "Beranda";
}
elseif($_GET['module']=='users'){
	echo "Pengguna Sistem";
}
elseif($_GET['module']=='gantipassword'){
	echo "Mengubah Sandi Pengguna";
}
elseif($_GET['module']=='jenis'){
	echo "Jenis Buku";
}
elseif($_GET['module']=='kategori'){
	echo "Kategori Buku";
}
elseif($_GET['module']=='buku'){
	echo "Daftar Buku";
}
elseif($_GET['module']=='penerbit'){
	echo "Penerbit Buku";
}
?>