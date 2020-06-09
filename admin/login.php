<html>
	<head>
		<!-- Tambahkan Link ke CSS untuk Tombol CSS3 -->
		<link href="login.css" rel="stylesheet" type="text/css" />
		<script language="javascript">
			function validasi(form){
			  if (form.username.value == ""){
				alert("Anda Belum Memasukkan Nama Pengguna");
				form.username.focus();
				return (false);
			  }    
			  if (form.password.value == ""){
				alert("Anda Belum Memasukkan Sandi Pengguna");
				form.password.focus();
				return (false);
			  }
			  return (true);
			}
		</script>
		<title>Halaman Login</title>
	</head>
	
	<body align=center class="warna-body">
		<form method='post' action="checkLogin.php" onSubmit="return validasi(this)">
			<center>
			<br><br><br><br>
			<h1 class="logStyle">Halaman Login</h1>
			<table class="table-login">
				<tr>
					<td rowspan=6 colspan=3>
						<img src="images/login.png" height="140" width="140" />
					</td>
				</tr>
				<tr>
					<td colspan=3 align=right>
						<!--<a href="#" class="links">Lupa Sandi?</a>-->&nbsp;
					</td>
				</tr>
				<tr>
					<td rowspan=5>
						&nbsp;
					</td>
				</tr>
				<tr>
					<th>
						Nama Pengguna
					</th>
					<td>
						<input type="text" name="username" id="username" class="form-input-gray" />
					</td>
				</tr>
				<tr>
					<th>
						Sandi Pengguna
					</th>
					<td>
						<input type="password" name="password" id="password" class="form-input-gray" />
					</td>
				</tr>
				<tr>
					<td colspan="4" align="right">
						<input type="submit" name="btn" id="btn" class="button gray" value="Masuk">
					</td>
				</tr>
			</table>
			<p class="logStyle">Copyright &copy; Fakultas Teknik Universitas Haluoleo. Created By <a href="http://genetika.kendari.linux.or.id/" target="_blank">Genetika</a>. All Right Reserved.</p>
			</center>
		</form>
	</body>
</html>