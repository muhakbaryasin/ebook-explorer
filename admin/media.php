<?php
	session_start();
	error_reporting(0);
	include "../config/connection.php";
	include "../config/library.php";
	include "../config/fungsi_indotgl.php";
	include "../config/fungsi_combobox.php";
	include "timeout.php";
	
	if($_SESSION['login']==1){
	if(!checkLogin()){
		$_SESSION['login'] = 0;
	}
}
	if($_SESSION['login']==0){
		header('location:logtimeout.php');
	}
	else{
		if(!isset($_SESSION['namauser']) or !isset($_SESSION['passuser'])){
		echo "<script language=Javascript>
				javascript:document.location='login.php';
			</script>";
		} else if(isset($_SESSION['namauser']) and isset($_SESSION['passuser'])){
			$login=mysql_query("SELECT * FROM user WHERE username='$_SESSION[namauser]' AND password='$_SESSION[passuser]'");
			$ketemu=mysql_num_rows($login);
			$r=mysql_fetch_array($login);

			if ($ketemu > 0){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 2.5 License

Name       : Arthropod  
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20100422

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php include "breadcrumb.php"; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="buttonform.css" rel="stylesheet" type="text/css" media="screen" />
<link href="greenblack.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body onload="setInterval('chat.update()', 1000)">
<div id="wrapper">
	<!--<div id="header">
		<div id="logo">
			<h1><a href="#">Arthropod </a></h1>
			<p> design by <a href="http://www.freecsstemplates.org/">Free CSS Templates</a></p>
		</div>
	</div>--><br /><br />
	<!-- end #header -->
	<?php
		include "menu.php";
	?>
	<!-- end #menu -->
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="content">
					<div class="post">
						<?php
							//$jam=date("H:i:s");
							$tgl=tgl_indo(date("Y m d"));
						echo "<p class='meta'><span class='date'><b>$hari_ini, $tgl</b></span><span class='posted'>"; include "breadcrumb.php"; echo "</span></p>
						<div style='clear: both;'>&nbsp;</div>";
							include "content.php";
						?>
					</div>
				</div>
				<!-- end #content -->
				<div id="sidebar">
					<ul>
						<li>
							<h2>Perpus Digital</h2>
							<br />
							<table align=center>
								<tr>
									<th colspan=2>Data Login</th>
								</tr>
								<tr>
									<th width=90>Nama User</th>
									<td width=150><?php echo $_SESSION['namauser']; ?></td>
								</tr>
								<tr>
									<th width=90>Nama Lengkap</th>
									<td width=150><?php echo $_SESSION['namalengkap']; ?></td>
								</tr>
								<tr>
									<td colspan=2><a href="media.php?module=gantipassword">Ubah Sandi Pengguna</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=logout.php>Keluar Log</a></td>
								</tr>
							</table>
						</li>
						<!--<li>
							<h2>Categories</h2>
							<ul>
								<li><a href="#">Aliquam libero</a></li>
								<li><a href="#">Consectetuer adipiscing elit</a></li>
								<li><a href="#">Metus aliquam pellentesque</a></li>
								<li><a href="#">Suspendisse iaculis mauris</a></li>
								<li><a href="#">Urnanet non molestie semper</a></li>
								<li><a href="#">Proin gravida orci porttitor</a></li>
							</ul>
						</li>-->
					</ul>
					<br /><br /><br /><br /><br /><br /><br /><br /><br />
					<br /><br /><br /><br /><br /><br /><br /><br />
					<br /><br /><br /><br /><br /><br /><br /><br />
				</div>
				<!-- end #sidebar -->
				<div style="clear: both;">&nbsp;</div>
			</div>
		</div>
	</div>
	<!-- end #page -->
</div>
<div id="footer">
	<p>Copyright &copy; 2012 Fakultas Teknik Universitas Haluoleo. Created By <a href="http://genetika.kendari.linux.or.id/" target="_blank">Genetika</a>. All rights reserved.</p>
</div>
<!-- end #footer -->
</body>
</html>
<?php
	} else {
				echo "<script language=Javascript>
						javascript:document.location='login.php';
					</script>";
			}
		}
	}
?>