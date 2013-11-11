<?php
	include("koneksi.php");
	session_start();
?>
<!doctype html>
<html>
<head>
	<title>Jersey DW</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="description" content="jersey" />
	<meta name="keywords" content="jersey" />
	<script type="text/javascript" src="js/jquery.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
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

			$("#daftar").click(function(event) {
				$("div.overlay").animate({opacity: 0.8, "z-index": 0},700);
				$("#daftarmember").animate({top: "100px"}, 1000, function() {
					$(document).mouseup(function (e) {
					    var container = $("#daftarmember");
					    var body = $("body");
					    if (!container.is(e.target)
					        && container.has(e.target).length === 0 && (body.has(e.target).length > 0) || body.is(e.target))
					    {
					    	$(document).unbind('mouseup');
					        $("#daftarmember").animate({top: "-400px"}, 1000);
					        $("div.overlay").animate({opacity: 0, "z-index": -50},700);
					    }
					});
				});
			});

			$("a.navajax").click(function(e) {
				var id = parseInt($(e.target).attr("id"));
				var page = '';
				switch (id) {
					case 1:
						page = 'topitems.php';
						break;
					case 2:
						page = 'carapemesanan.php';
						break;
					case 3:
						page = 'kontakkami.php';
						break;
					case 4:
						page = 'tentangkami.php';
						break;
					case 5:
						page = 'syarat.php';
						break;
					case 6:
						page = 'pengiriman.php';
						break;
				}
				$.get(page, function(data){
					$('#sidecenter').html(data);
				});
			});

			$("#buttlogin").click(function() {
				$("#login").append('<img src="images/ajax-loader.gif" id="loadinglogin" />');
				var username = document.getElementById("username").value;
				var password = document.getElementById("password").value;
				$.post("do_login.php", {loginusername: username, loginpassword: password}, function(data) {
					if (data.ok) {
						$("#login").fadeOut(400,function() {
							$("#login").html('');
							$("#login").fadeIn(400,function() {
								$("#login").html('<h3>Halo, '+ data.username +' | <a href="do_logout.php">Keluar</a></h3>');
							});
						});
						$.get("sideright_login.php", function(data2) {
							$("#sideright").fadeOut(400,function() {
								$("#sideright").html('');
								$("#sideright").fadeIn(400,function() {
									$("#sideright").html(data2);
								});
							});
						});
					}
					else {
						alert("Username atau password salah...");
						$("#loadinglogin").remove();
					}
				}, "json");
			});
		});
	</script>

</head>
<body>
	<div id="wrapper">
	<div class="overlay"></div>
		<div id = "header">
			<img src="images/logo.png" width= "290" height= "90">
			<div id="login">
				<?php
					if (!isset($_SESSION['id'])) {
				?>
					<table>
						<tr>
							<td>Username : </td>
							<td><input class="input" type="text" name="loginusername" placeholder="username" id="username"/></td>
						</tr>
						<tr>
							<td>Password : </td>
							<td><input class="input" type="password" name="loginpassword" placeholder="password" id="password"/></td>
						</tr>
					</table>
					<button name="masuk" class="submit" id="buttlogin">Masuk</button> | <a href="#" id="daftar">Daftar Member!</a>
				<?php
					}
					else {
				?>
				<h3>Halo, <?php echo $_SESSION['username']." "; ?> | <a href="do_logout.php">Keluar</a></h3>
				<?php
					};
				?>
			</div>
		</div>
		<div class="clear"></div>
		<div id = "navigation">
			<ul>
				<li><a href="#navigation" class="navajax" id="1">Beranda</a></li>
				<li><a href="#navigation" class="navajax" id="2">Cara Pemesanan</a></li>
				<li><a href="#navigation" class="navajax" id="3">Kontak Kami</a></li>
				<li><a href="#navigation" class="navajax" id="4">Tentang Kami</a></li>
				<li><a href="#navigation" class="navajax" id="5">Syarat&Kondisi</a></li>
				<li><a href="#navigation" class="navajax" id="6">Pengiriman</a></li>
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
			<div id ="sidecenter">
				<div class="gambar">Arsenal<br/><a href="#"><img src="images/jersey/klub/arsenal 1.png" width="100" height="110"></a>
					<br/>Rp 150.000,-
					<br/><img src="images/beli.png" width="60" height="25">
				</div>

				<div class="gambar">Atletico Madrid<br/><a href="#"><img src="images/jersey/klub/atm.jpg" width="100" height="110"></a>
					<br/>Rp 130.000,-
					<br/><img src="images/beli.png" width="60" height="25">
				</div>

				<div class="gambar">Barcelona FC<br/><a href="#"><img src="images/jersey/klub/barca 2.jpg" width="120" height="110"></a>
					<br/>Rp 150.000,-
					<br/><img src="images/beli.png" width="60" height="25">
				</div>

				<div class="gambar">Chelsea<br/><a href="#"><img src="images/jersey/klub/chelsea 1.png" width="100" height="110"></a>
					<br/>Rp 150.000,-
					<br/><img src="images/beli.png" width="60" height="25">
				</div>

				<div class="gambar">Dortmund<br/><a href="#"><img src="images/jersey/klub/dortmund.png" width="100" height="110"></a>
					<br/>Rp 150.000,-
					<br/><img src="images/beli.png" width="60" height="25">
				</div>

				<div class="gambar">Liverpool<br/><a href="#"><img src="images/jersey/klub/liverpool 1.png" width="100" height="110"></a>
					<br/>Rp 150.000,-
					<br/><img src="images/beli.png" width="60" height="25">
				</div>

				<div class="gambar">Manchester Utd<br/><a href="#"><img src="images/jersey/klub/MU 1.png" width="100" height="110"></a>
					<br/>Rp 150.000,-
					<br/><img src="images/beli.png" width="60" height="25">
				</div>

				<div class="gambar">Holland<br/><a href="#"><img src="images/jersey/negara/holland.jpg" width="120" height="110"></a>
					<br/>Rp 150.000,-
					<br/><img src="images/beli.png" width="60" height="25">
				</div>

				<div class="gambar">England<br/><a href="#"><img src="images/jersey/negara/england.jpg" width="120" height="110"></a>
					<br/>Rp 150.000,-
					<br/><img src="images/beli.png" width="60" height="25">
				</div>

				<div class="gambar">German<br/><a href="#"><img src="images/jersey/negara/german.jpg" width="120" height="110"></a>
					<br/>Rp 150.000,-
					<br/><img src="images/beli.png" width="60" height="25">
				</div>

				<div class="gambar">Indonesia<br/><a href="#"><img src="images/jersey/negara/indonesia.jpeg" width="95" height="110"></a>
					<br/>Rp 100.000,-
					<br/><img src="images/beli.png" width="60" height="25">
				</div>

				<div class="gambar">Spain<br/><a href="#"><img src="images/jersey/negara/spain.jpg" width="110" height="110"></a>
					<br/>Rp 150.000,-
					<br/><img src="images/beli.png" width="60" height="25">
				</div>
				<div class="clear"></div>
			</div>		
			<div id ="sideright">
				<div id="fsearch">
					<img src="images/cari.png" width="186px"/>
					<form method="" action="">
						<input type="text" name="search"  style="width: 130px;"/>
						<input type="submit" value="Cari" style="width: 40px;">
					</form>
				</div>
				<?php
					if (isset($_SESSION['id'])) {
				?>
				<div id="profil">
					<img src="images/profil.png" width="186px"/><br/>
					<img src="images/default.png" alt="fotoprofil" width= "75px" height="70px"/>
					<a href="#">Lihat Profil</a>
				</div>
				<?php
					};
				?>
				<div id="bayar">
					<img src="images/pembayaran.png" width="186px"/><br/>
					<img src="images/bca.png" height="40px" title="BCA"/><br/>
					123456789<br/>a/n Herlius Caraka<br/><br/>
					<img src="images/mandiri.png" height="40px" title="MANDIRI"/><br/>
					123456789<br/>a/n Herlius Caraka
				</div>
				<div id="jne">
					<img style="width: 126px; height: 50px;" src="http://i.imgur.com/JzyLE.png" alt="JNE" title="JNE">
					<form action="http://www.jne.co.id/index.php" method="get" name="input" target="_new2">
					    <input name="mib" value="tracking.detail" type="hidden">
					    <label for="textJNE">JNE:</label> <input name="awb" type="text" class="textongkir" id="textJNE">
					    <input value="Submit" type="submit">
					</form>
					<img style="width: 126px; height: 50px;" src="http://i.imgur.com/Wlfnn.jpg" alt="TIKI" title="TIKI">
					<form method="post" action="http://www.tiki-online.com/?cat=Verty7788JasKJ" name="frmtracksg">
						<label for="textTIKI">TIKI:</label> <input name="get_con" type="text" class="textongkir" id="textTIKI">
        				<input class="tombol" name="submit" value="Submit" type="submit">
        			</form>
				</div>
			</div>	
		</div><!--end of content-->
		<div class="clear"></div>
		<div id = "footer">&copy 2013 <a href="#">JerseyDW.com</a> Desain oleh DOA IBU-FTI UKDW</div>

		<div id ="daftarmember">
				<h3>Daftar Member</h3>
				<form method="post" action="do_signup.php">
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
						<td><input class="submit" type="submit" value="Daftar" name="daftar"/></td>
					</tr>
				</table>
				</form>
		</div>
	</div>
</body>
</html>