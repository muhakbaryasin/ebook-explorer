<!DOCTYPE html>
<html lang="en">
<head>
<meta charset=utf-8>
<title>Perpustakaan Digital</title>
<meta name="keywords" content="perpustakaan" />
<meta name="description" content="perpustakaan digital" />

<script src="html5.js"></script><!-- this is the javascript allowing html5 to run in older browsers -->

<link rel="stylesheet" type="text/css" href="reset.css" media="screen" title="html5doctor.com Reset Stylesheet" />
<link rel="stylesheet" type="text/css" href="general.css" media="screen" />
<link rel="stylesheet" type="text/css" href="grid.css" media="screen" />



<style>
/* Feel free to remove these styles, they are for demo page */

header {height:112px; position:relative; margin-bottom:5px;}
	header .logo {font-size:2.5em; height:52px; padding-top:28px; font-weight:700; text-shadow:1px 1px 2px #000; color:#353535; filter: Shadow(Color=#666666, Direction=135, Strength=3);}
	header .statement {width:20%; text-align:right; padding-top:30px;}
header nav { background-color:#525252; color:#fff; height:30px;}
	nav ul {list-style:none;}
	nav ul li {float:left; margin-left:5px;}
	nav ul li a {display:block; color:#fff; text-decoration:none; padding:2px 8px; margin-top:8px;  
					-moz-border-radius-topleft: 5px; -webkit-border-top-left-radius: 5px; -moz-border-radius-topright: 5px; -webkit-border-top-right-radius: 5px;}
	nav ul li a:hover, nav ul li.active a {background-color:#fff; text-decoration:none; font-weight: bolder; color:#000;}
	
	
.content {min-height:280px;}	

form #utama { height: 40px; font-size: 26px;}

	.submit, .submit:visited {
		font-weight: bold;
		font-size: 1.4em;
		background: #525252; 
		display: inline-block; 
		padding: 5px 10px 6px; 
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
		
	}
	
	.submit:hover{
		background: #8e8e8e;
	}

footer { font-size:.8em; } 
</style>
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

        <div class="logo align_center">Perpustakaan Digital</div>
    </header>
    
        
   <div class="clear" style="height:10px; border-bottom:1px solid #ccc;"></div> 
    
    <section class="content align_center">
      <form method="get" action="search.php">
      		<input id="utama" size="50" type="text" name="key"/>
  				<div class="clear" style="height:10px;"></div>
  				<button class="submit">Telusuri Buku Buku</button>    		
      </form>
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
</body>
</html>