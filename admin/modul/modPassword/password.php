<?php
//session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	echo "<script language=Javascript>
				javascript:document.location='login.php';
		</script>";
}
else{
?>
	<script language="javascript">
			function validasi(form){
			  if (form.passlama.value == ""){
				alert("Anda Belum Memasukkan Sandi Lama Anda");
				form.passlama.focus();
				return (false);
			  }    
			  if (form.passbaru.value == ""){
				alert("Anda Belum Memasukkan Sandi Baru Anda");
				form.passbaru.focus();
				return (false);
			  }
			  if (form.passlagi.value == ""){
				alert("Masukkan Lagi Sandi Baru Anda");
				form.passlagi.focus();
				return (false);
			  }
			  if (form.passlagi.value != form.passbaru.value){
				alert("Input Sandi Baru Tidak Sesuai");
				form.passlagi.focus();
				return (false);
			  }			  
			  return (true);
			}
		</script>
<?php
    echo "<form method=POST onSubmit=\"return validasi(this)\" action=modul/modPassword/aksiPassword.php>
          <table>
          <tr><th>Masukkan Sandi Lama</th><td> : <input type=text id=passlama class='form-input-gray' name='pass_lama'></td></tr>
          <tr><th>Masukkan Sandi Baru</th><td> : <input type=text id=passbaru class='form-input-gray' name='pass_baru'></td></tr>
          <tr><th>Masukkan Lagi Sandi Baru</th><td> : <input type=text id=passlagi class='form-input-gray' name='pass_ulangi'></td></tr>
          <tr><td colspan=2><input type=submit class='button orange' value=Proses>
                            <input type=button class='button orange' value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
}
?>
