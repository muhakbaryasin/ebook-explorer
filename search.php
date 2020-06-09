<?php
	if($_GET['key']=="") {
		echo "<script language=Javascript>
				javascript:document.location='./';
		      </script>";
	}else {
		
		include "./config/connection.php";
		include "./paging/class_paging.php";
		
		$p      = new Paging();
    	$batas  = 5;
    	$posisi = $p->cariPosisi($batas);
		
		$search=mysql_query("SELECT B.judul, B.nama_pengarang, K.nama_kategori, J.nama_jenis, P.nama_penerbit, B.nama_file, SUBSTRING(B.deskripsi,1,250) FROM 
			buku B, kategori K , jenis J, penerbit P WHERE B.id_kategori=K.id_kategori AND B.id_jenis=J.id_jenis AND P.id_penerbit=B.id_penerbit AND B.judul like '%$_GET[key]%' order by B.judul ASC LIMIT $posisi,$batas");
		
		$jmldata = mysql_num_rows(mysql_query("SELECT B.judul, B.nama_pengarang, K.nama_kategori, J.nama_jenis, P.nama_penerbit, B.nama_file FROM 
			buku B, kategori K , jenis J, penerbit P WHERE B.id_kategori=K.id_kategori AND B.id_jenis=J.id_jenis AND P.id_penerbit=B.id_penerbit AND B.judul like '%$_GET[key]%' order by B.judul"));
    	$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    	$linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);
	
?>
<!DOCTYPE html>
<html lang="en">
  <head>
   <meta charset="utf-8">
    <title><?=$_GET['key']?></title>
    <meta name="description" content="Telusuri Buku Buku">
	 <script src="html5.js"></script><!-- this is the javascript allowing html5 to run in older browsers -->   
    <script src="js/jquery.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="reset.css" media="screen" title="html5doctor.com Reset Stylesheet" />
	 <link rel="stylesheet" type="text/css" href="general.css" media="screen" />
	 <link rel="stylesheet" type="text/css" href="grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/styles2.css" media="screen" >
<title><?=$_GET['key']?></title>			

<style>
/* Feel free to remove these styles, they are for demo page */
header { position:relative; }
header nav { background-color:#525252; color:#fff; height:30px;}
.logo {font-size:2.5em; height:52px; padding-top:28px; font-weight:700; text-shadow:1px 1px 2px #000; color:#353535; filter: Shadow(Color=#666666, Direction=135, Strength=3);}
	nav ul {list-style:none;}
	nav ul li {float:left; margin-left:5px;}
	nav ul li a {display:block; color:#fff; text-decoration:none; padding:2px 8px; margin-top:8px;  
					-moz-border-radius-topleft: 5px; -webkit-border-top-left-radius: 5px; -moz-border-radius-topright: 5px; -webkit-border-top-right-radius: 5px;}
	nav ul li a:hover, nav ul li.active a {background-color:#fff; text-decoration:none; color:#000; font-weight: bolder;}
	
header .head_box { background: #e0e0e0; width: 100%; border-bottom: solid 1px #ccc;}

form {padding: 20px 10px 20px 0px;}

.content {min-height:280px; font-family:Arial, Helvetica, sans-serif;}

form #utama { height: 25px; font-size: 1.6em;}

	.submit, .submit:visited {
				
		font-weight: bold;
		font-size: 1.2em;
		background: #525252; 
		display: inline-block; 
		padding: 8px 10px 6px; 
		color: #fff; 
		-moz-border-radius: 5px; 
		-webkit-border-radius: 5px;
		box-shadow: 0 1px 3px rgba(0,0,0,0.5);
		-moz-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
		-webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
		border:none;
		text-shadow: 0 -1px 1px rgba(0,0,0,0.25);
		position: relative;
		cursor: pointer;
		margin-bottom:5px;
		width: 90px;
	}
	
	.submit:hover{
		background: #8e8e8e;
	}
	
	.result { padding-left: 10px;}
	.result a{ color: blue; text-decoration: underline; font-size: 1.6em; }
	.paging .prevnext { padding: 2px; border: solid 1px red; margin-left: 1px; margin-right: 1px; margin-bottom: 2px;}
	.paging .prevnext:hover{background: #ccc;}
	.paging .prevnext a{ color: red; text-decoration: none; font-size: 1.2em; }
	.paging .prevnext a:hover{ color: white;}
	
	

footer { font-size:.8em; } 
</style>

<script type="text/javascript" language="javascript">    
</script>
</head>

<body>
<div class="row">
	<header>
			<div class="clear"></div>
        
        <nav>
        	<ul>
            	<li class="active"><a href="./">Pencarian</a></li>
                <li><a href="doc.php">Dokumentasi</a></li>
                <li><a href="about.php">Perpustakaan ini</a></li>
            </ul>
        </nav>
   	<div class="clear"></div>
   	<div class="head_box left">
   		<div class="col_2 col"><div class="logo align_center">E-lib</div></div>
			<div class="col_12 col">
				<form >   			
   				<input size="50" id="utama" type="text" name="key" value="<?=$_GET['key']?>"/>
   			<button class="submit">>></button>
   			</form>
			</div>
   		
   	</div>     
        

    </header>
        
   <div class="clear"></div> 
   <aside class="col_2 col">
    	<br>        
    </aside>
    <section class="content col_12 col ">
    <div class="clear" style="height:10px;"></div>
<?php $n = 0; 
		while($array = mysql_fetch_array($search)) 
		{ 
			$hasil[$n][0] = $array[0];//judul
			$hasil[$n][1] = $array[1];//pengarang
			$hasil[$n][2] = $array[2];//kategori
			$hasil[$n][3] = $array[3];//jenis
			$hasil[$n][4] = $array[4];//penerbit
			$hasil[$n][5] = $array[5];//nama_file
			$hasil[$n][6] = $array[6];//deskripsi
			$n++;}		
		}
		
		if($n!=0){
				
		?>    
			<div class="result">	
				<span class="count" style="color:#888; font-size:1.2em;">Terdapat <?=$n?> hasil.</span>
				<div class="clear" style="height:10px;"></div>			
<?php	
		}else {?>
		<div class="result">	
				<span class="count" style="color:#000; font-size:1.2em; font-weight: bold;">Tidak ditemukan hasil untuk <i>"<?=$_GET['key']?>"</i>.</span>
				<div class="clear" style="height:10px;"></div>
<?php
		}
		
		if($n>0){
			for($i = 0; $i < count($hasil); $i++) {
				?>
					<a href="./files/<?=$hasil[$i][5]?>" class="preview" title="<?=$hasil[$i][0]?>">[<?=$hasil[$i][3]?>] <?=$hasil[$i][0]?></a><a class="right" style="font-size:1.0em;" href="#" ><?=$hasil[$i][2]?></a><span class="right">>></span>
					<br>oleh <span class="author" style="color:#109933; font-size:1.2em;"><?=$hasil[$i][1]?></span> penerbit <span class="print" style="color:#109933; font-size:1.2em;"><?=$hasil[$i][4]?></span> 
					<p><?=$hasil[$i][6]?>&nbsp;...&nbsp;<span class="print" style="color:#109933;"><?=$hasil[$i][5]?></span></p>
				<?php
			}
			
			echo "<div class=\"paging\" align=\"center\">$linkHalaman</div>";						
		}	
?>				
			</div>
    </section><!-- end content -->
  <div class="clear" style="height:10px; border-bottom:1px solid #ccc;"></div>
</div><!-- end wrap -->

<footer class="row">
    <section class="col_8 col align_left">
    All rights reserved 52framework owned by <a href="http://enavu.com">enavu network</a>
    </section>
    <section class="col_8 col align_right">
    Have questions? Contact me at angel@enavu.com | Even if it's just to say thanks!
    </section>
</footer>         

<script type="text/javascript" language="javascript">

// Kick off the jQuery with the document ready function on page load
$(document).ready(function(){
	imagePreview();
});

// Configuration of the x and y offsets
this.imagePreview = function(){	
		xOffset = -20;
		yOffset = 40;		
		
    $("a.preview").hover(function(e){
    	this.t = this.title;
      this.title = "";	
	   var c = (this.t != "") ? "<br/>" + this.t : "";    	
    	$.ajax({
    		type:"GET",
    		url:"get_selamat.php",    
    		data: 'judul=' +this.t,        
    		success: function(html){                 
      		$("body").append("<p id='preview'></p>");
      		$('#preview').html(html);								 
         	$("#preview")
            .css("top",(e.pageY - xOffset) + "px")
            .css("left",(e.pageX + yOffset) + "px")
            .fadeIn("slow");
      	}
      });
        
         
    },
	
    function(){
        this.title = this.t;
        $("#preview").remove();

    });	
	
    $("a.preview").mousemove(function(e){
        
        $("#preview")
            .css("top",(e.pageY - xOffset) + "px")
            .css("left",(e.pageX + yOffset) + "px");
    });			
};

</script>
</body>
</html>
