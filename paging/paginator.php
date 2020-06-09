<?php
	include_once "../config/connection.php";
	include_once "class_paging.php";
	 $p      = new Paging();
    $batas  = 5;
    $posisi = $p->cariPosisi($batas);

    $tampil = mysql_query("SELECT * FROM buku ORDER BY judul ASC LIMIT $posisi,$batas");
  
    $no = 1;
    while($r=mysql_fetch_array($tampil)){
      
      echo "<tr><td>$no</td>
                <td>$r[judul]</td>
		        </tr>";
      $no++;
    }
    echo "</table>";
	
	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM buku"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);

    echo "<div class=paging>$linkHalaman</div>";
?>
