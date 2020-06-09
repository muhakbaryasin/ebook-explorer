<?php
include "./config/connection.php";
$judul = $_GET['judul'];
$search=mysql_query("SELECT B.deskripsi FROM	buku B where B.judul = '$judul'");
while($array = mysql_fetch_array($search)) 
		{ 
			echo "<b>Deskripsi:</b> <br>$array[0]";		
		}		
?>