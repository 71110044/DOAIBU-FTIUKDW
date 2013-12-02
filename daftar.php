<?php
	include("koneksi.php");
	if (isset($_POST['daftarusername']) && isset($_POST['daftarpassword']) && isset($_POST['konfirmpassword']) && isset($_POST['daftaralamat']) && isset($_POST['daftarkodepos']) && isset($_POST['daftartelp']) && isset($_POST['daftarnama']) && isset($_POST['daftaremail'])) 
	{

		$daftarusername = $_POST['daftarusername'];
		$daftarpassword = $_POST['daftarpassword'];
		$konfirmpassword = $_POST['konfirmpassword'];
		$daftarnama 	= $_POST['daftarnama'];
		$daftaralamat	= $_POST['daftaralamat'];
		$daftarkodepos  = $_POST['daftarkodepos'];
		$daftartelp		= $_POST['daftartelp'];
		$daftaremail	= $_POST['daftaremail'];


		$query = "INSERT INTO user (id,username,password,nama,alamat,kodepos,telepon,admin,email) VALUES (NULL,'".$daftarusername."','".$daftarpassword."','".$daftarnama."','".$daftaralamat."','".$daftarkodepos."','".$daftartelp."',0,'".$daftaremail."')";

		$res = mysql_query($query) or die ("ini gagal query");
	}
?>

<!doctype html>
<html>
<head>
	<title>Jersey DW - Kontak Kami</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="description" content="jersey" />
	<meta name="keywords" content="jersey" />
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript">
		var image1 = new Image()
		image1.src = "images/slider/1.png"

		var image2 = new Image()
		image2.src = "images/slider/2.png"

		var image3 = new Image()
		image3.src = "images/slider/3.png"

		var image4 = new Image()
		image4.src = "images/slider/4.png"
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$("dd:not(:first)").hide();
			$("dt a").click(function() {
				$("dd:visible").slideUp("slow");
				$(this).parent().next().slideDown("slow");
				return false;
			});
		});
	</script>

</head>
<body>
	<div id="wrapper">

		<div id = "header">
			<img src="images/logo.png" width= "290" height= "90">
		</div>
		<div id = "navigation">
			<ul>
				<li><a href="index.php">Beranda</a></li>
				<li><a href="carapemesanan.php">Cara Pemesanan</a></li>
				<li><a href="kontakkami.php">Kontak Kami</a></li>
				<li><a href="tentangkami.php">Tentang Kami</a></li>
				<li><a href="syarat.php">Syarat&Kondisi</a></li>
				<li><a href="pengiriman.php">Pengiriman</a></li>
			</ul>
		</div>
		<div class="clear"></div>
		<div id = "runningtext">
			<marquee>Ayo pilih Jerseymu lalu  SMS ke : 0812345678  BBM: 22AABBCC (respon cepat)</marquee>
		</div>
		<div id = "slider">
			<img src="images/slider/4.png" name="slide" width="960" height="280">
			<script>
				var step=1
				function slideit(){
				if (!document.images)
					return
				document.images.slide.src=eval("image"+step+".src")
				if (step<4)
					step++
				else
					step=1
				setTimeout("slideit()",2800)
				}
				slideit();
			</script>
		</div>
		<div class="clear"></div>
		<div id = "content">
			<div id = "sideleft">	
				<div id = "keranjang">
					<img src="images/keranjang.png" alt = "kategori" width="200" height="25">
					<div id= "belanja">Total item = 0 <br/>Total bayar = 0<br/>
						<input type="submit" value="Beli" name="beli" class="submit"/>
					</div>
				</div>
				<div id ="kategori">
					<img src="images/kategori.png" alt = "kategori" width="200" height="25">
					<dl>
						<dt> <a href="#">Klub</a></dt>
						<dd>
							<ul>
								<li><a href="#">Arsenal</a></li>
								<li><a href="#">Atletico Madrid</a></li>
								<li><a href="#">Barcelona FC</a></li>
								<li><a href="#">Bayern Munchen</a></li>
								<li><a href="#">Chelsea</a></li>
								<li><a href="#">Dortmund</a></li>
								<li><a href="#">Everton</a></li>
								<li><a href="#">Fulham</a></li>
								<li><a href="#">Hull</a></li>
								<li><a href="#">Inter Milan</a></li>
								<li><a href="#">Juventus</a></li>
								<li><a href="#">Liverpool</a></li>
								<li><a href="#">Manchester City</a></li>
								<li><a href="#">Manchester United</a></li>
								<li><a href="#">Milan</a></li>
								<li><a href="#">New Castle</a></li>
								<li><a href="#">Sunderland</a></li>
								<li><a href="#">Totenham</a></li>
							</ul>
						</dd>
						<dt><a href="#">Negara</a></dt>
						<dd>
							<ul>
								<li><a href="#">Argentina</a></li>
								<li><a href="#">Brasil</a></li>
								<li><a href="#">Croatia</a></li>
								<li><a href="#">Czech</a></li>
								<li><a href="#">Denmark</a></li>
								<li><a href="#">England</a></li>
								<li><a href="#">France</a></li>
								<li><a href="#">German</a></li>
								<li><a href="#">Holland</a></li>
								<li><a href="#">Indonesia</a></li>
								<li><a href="#">Italy</a></li>
								<li><a href="#">Ivory-Coast</a></li>
								<li><a href="#">Japan</a></li>
								<li><a href="#">Portugal</a></li>
								<li><a href="#">Spain</a></li>
								<li><a href="#">Sweden</a></li>
								<li><a href="#">Uruguay</a></li>
							</ul>
						</dd>
						<dt><a href="#">Lokal</a></dt>
						<dd>
							<ul>
								<li><a href="#">Arema</a></li>
								<li><a href="#">Persebaya</a></li>
								<li><a href="#">Persib</a></li>
								<li><a href="#">Persipura</a></li>
								<li><a href="#">Semen Padang</a></li>
							</ul>
						</dd>
					</dl>
				</div>
			</div>
			<div id ="daftarmember">
				<h3>Daftar Member</h3>
				<form method="post" action="daftar.php">
					<table>
					<tr>
						<td>Username</td>
						<td><input class="input" type="text" name="daftarusername" size="20" maxlength="50" value=""/></td>
					</tr>

					<tr>
						<td>Password</td>
						<td><input class="input" type="password" name="daftarpassword"  size="20" maxlength="50" value=""/></td>
					</tr>
					<tr>
						<td>Konfirmasi Password</td>
						<td><input class="input" type="password" name="konfirmpassword"  size="20" maxlength="50" value=""/></td>
					</tr>
					<tr>
						<td>Nama</td>
						<td><input class="input" type="text" name="daftarnama"  size="20" maxlength="50" value=""/></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><input class="input" type="text" name="daftaremail"  size="20" maxlength="50"/></td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td><input class="input" type="text" name="daftaralamat" style="width: 290px; height: 64px;"/></td>
					</tr>
					<tr>
						<td>Kodepos</td>
						<td><input class="input" type="text" name="daftarkodepos"/></td>
					</tr>
					<tr>
						<td>Telp/HP</td>
						<td><input class="input" type="text" name="daftartelp"/></td>
					</tr>
					<tr colspan="2">
						<td><input class="submit" type="submit" value="Daftar"/></td>
					</tr>
				</table>
				</form>
			</div>		
			<div id ="sideright">
				<div id="fsearch">
					<img src="images/cari.png" width="186px"/>
					<form method="" action="">
						<input type="text" name="search"  style="width: 130px;"/>
						<input type="submit" value="Cari" style="width: 40px;">
					</form>
				</div>
				<div id="profil">
					<img src="images/profil.png" width="186px"/><br/>
					<img src="images/default.png" alt="fotoprofil" width= "75px" height="70px"/>
					<a href="#">Lihat Profil</a>
				</div>
				<div id="bayar">
					<img src="images/pembayaran.png" width="186px"/><br/>
					<img src="images/bca.png" height="40px"/><br/>
					123456789<br/>a/n Herlius Caraka<br/><br/>
					<img src="images/mandiri.png" height="40px"/><br/>
					123456789<br/>a/n Herlius Caraka
				</div>
				<div id="jne">
					<img style="width: 126px; height: 50px;" src="http://i.imgur.com/JzyLE.png" alt="JNE" title="JNE">
					<form action="http://www.jne.co.id/index.php" method="get" name="input" target="_new2">
					    <input name="mib" value="tracking.detail" type="hidden">
					    JNE: <input name="awb" type="text">
					    <input value="Submit" type="submit">
					</form>
					<img style="width: 126px; height: 50px;" src="http://i.imgur.com/Wlfnn.jpg" alt="TIKI" title="TIKI">
					<form method="post" action="http://www.tiki-online.com/?cat=Verty7788JasKJ" name="frmtracksg">
						TIKI:<input class="input" name="get_con" type="text">
        				<input class="tombol" name="submit" value="Submit" type="submit">
        			</form>
				</div>
			</div>	
		</div><!--end of content-->
		<div class="clear"></div>
		<div id = "footer">&copy 2013 <a href="#">JerseyDW.com</a> Desain oleh DOA IBU-FTI UKDW</div>
	</div>

</body>
</html>