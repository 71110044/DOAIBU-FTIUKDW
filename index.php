<?php
	include("koneksi.php");
	session_start();

	if (isset($_POST['nama']) && isset($_POST['alamat']) && isset($_POST['kodepos']) && isset($_POST['telepon']) && isset($_POST['email']) && isset($_FILES['file'])) 
	{
		$dir 	= 'images/profpic/';
		$nama 	= $_POST['nama'];
		$alamat = $_POST['alamat'];
		$kodepos = $_POST['kodepos'];
		$telepon = $_POST['telepon'];
		$email= $_POST['email'];

		if ($_FILES['file']['size'] != 0) {
			
			$uploadfile = $dir.$_FILES['file']['name'];
			if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile))
			{
				$query		= "UPDATE user SET nama = '".$nama."', alamat = '".$alamat."', kodepos = '".$kodepos."', telepon = '".$telepon."', email = '".$email."', profpic='".$uploadfile."' WHERE id = ".$_SESSION['id'];
				mysql_query($query);
			}
		}
	}

	if (isset($_POST['kontak_nama']) && isset($_POST['kontak_email']) && isset($_POST['kontak_alamat']) && isset($_POST['kontak_telp']) && isset($_POST['kontak_kota']) && isset($_POST['kontak_pesan'])) {
		
		$nama = $_POST['kontak_nama'];
		$email = $_POST['kontak_email'];
		$alamat = $_POST['kontak_alamat'];
		$telp = $_POST['kontak_telp'];
		$kota = $_POST['kontak_kota'];
		$pesan = $_POST['kontak_pesan'];

		$query = "INSERT into kontakkami (idkontak,namakontak,emailkontak,teleponkontak,kotakontak,pesankontak,alamatkontak) VALUES (NULL, '".$nama."','".$email."','".$telp."','".$kota."','".$pesan."','".$alamat."')";

		mysql_query($query);
	}

?>
<!doctype html>
<html>
<head>
	<title>Jersey DW</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="description" content="jersey" />
	<meta name="keywords" content="jersey" />
	<script type="text/javascript" src="js/jquery-2.0.3.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui.min.js"></script>
	<link rel="stylesheet" href="jquery-ui.min.css" />
	<link rel="stylesheet" type="text/css" href="style.css" />
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
		function showLoading(divtarget, height = 50, width = 50) {
			divtarget.append('<img src="images/ajax-loader.gif" id="loadingBox" height="'+height+'px" width="'+width+'px" />');
			$("#loadingBox").show();
		}

		function hideLoading() {
			$("#loadingBox").hide();
			$("#loadingBox").detach();
		}

		function getKeranjangBelanja() {
			showLoading($("#belanja"));
			$.get("getkeranjang.php",function(data) {
				hideLoading();
				$("#totalbayar").text(data.totalbayar);
				$("#totalbarang").text(data.totalbarang);
			},"json");
		}

		function hapus(e) {
			var id = $(e.target).attr("id");
			var split = id.split("-");
			var idnota = parseInt(split[1]);
			var idbarang = parseInt(split[2]);
			showLoading($("#tampilcart"),100,100);
			$.post("hapuskeranjang.php",{idnota: idnota, idbarang: idbarang},function(data) {
				hideLoading();
				getKeranjangBelanja();
				$("#tampilcart").html(data);
				$(".hapus").click(hapus);
			});
		}

		function lihatprofil(e) {
			var id = $(e.target).attr("name");
			var split = id.split("-");
			var iduser = parseInt(split[1]);
			if (iduser > 0) {
				showLoading($("#sidecenter"),100,100);
				$.get("profil.php?id="+iduser, function(data){
					hideLoading();
					$('#sidecenter').html(data);
					$(".hapus").click(hapus);
					$("#checkout").click(function(e) {
						var mm = document.getElementById("metode");
						var metode = mm.options[mm.selectedIndex].value;
						var pesan = document.getElementById("pesan").value;
						var tt = document.getElementById("transfer");
						var transfer = tt.options[tt.selectedIndex].value;

						var totalbeli = $("#totalbeli").text();
						var id = $(e.target).attr("name");
						var split = id.split("-");
						var idnota = parseInt(split[1]);

						$.post("konfirmasibeli.php",{metode: metode, transfer: transfer, pesan: pesan, totalbeli: totalbeli, idnota: idnota}, function(data2) {
							alert(data2);
							window.location = 'index.php';
							// showLoading($("#tampilcart"),100,100);
							// $.get("getcart.php",function(data3) {
							// 	hideLoading();
							// 	$("#tampilcart").html(data3);
							// });
						});
					});
					$(".konfirmasi").click(function(e) {
						var id = $(e.target).attr("name");
						var split = id.split("-");
						var idnota = parseInt(split[1]);

						var rekening = document.getElementById("rekening-"+idnota).value;
						var tanggaltransfer = document.getElementById("tanggaltransfer-"+idnota).value;

						$.post("konfirmasibayar.php",{idnota: idnota, rekening: rekening, tanggaltransfer: tanggaltransfer}, function(data2) {
							alert(data2);
							window.location = "index.php";
						});
					});
					$(function() {
						$(".tanggaltransfer").datepicker({ dateFormat: 'yy-mm-dd' });
					});
				});
			}
			else {
				alert("Anda harus masuk terlebih dahulu untuk melakukan pembelian.");
			}
		}

		function addtocart(e) {
			var objectjml, jumlahbeli;
				if (document.getElementById("jml")) {
					objectjml = document.getElementById("jml");
					jumlahbeli = parseInt(objectjml.options[objectjml.selectedIndex].value);
				}
				else {
					jumlahbeli = 1;
				}
				var id = $(e.target).attr("id");
				var split = id.split("-");
				var idbarang = parseInt(split[1]);
				var harga = parseInt(split[2]);

				showLoading($("#belanja"));
				$.post("addtocart.php", {id: idbarang, harga: harga, jumlahbeli: jumlahbeli}, function(data) {
					hideLoading();
					if (data.ok) {
						$("#totalbarang").text(data.totalbarang);
						$("#totalbayar").text(data.totalbayar);
						if (data.login)
							alert("Barang berhasil ditambahkan ke keranjang\nUntuk melihat rincian keranjang, silakan lihat profil.");
						else
							alert("Barang berhasil ditambahkan ke keranjang\nSilakan masuk dulu untuk melakukan pembelian.");
					}
					else {
						alert("Barang gagal ditambahkan ke keranjang.\nTolong coba lagi.");
					}
				}, "json");
		}

		function detailbarang(e) {
			var id = parseInt($(e.target).attr("id"));
				showLoading($("#sidecenter"),100,100);
				$.get("detail.php?id="+id, function(data){
					hideLoading();
					$('#sidecenter').html(data);
					$(".addtocart").click(addtocart);
				});
		}

		function dologin(data) {
			$("#login").fadeOut(400,function() {
				$("#login").html('');
				$("#login").fadeIn(400,function() {
					$("#login").html('<h3>Halo, '+ data.username +' | <a href="do_logout.php">Keluar</a></h3>');
					if (data.admin)
						$("#navigation ul").append('<li><a href="admin.php">Admin</a></li>');
				});
			});
			$.get("sideright_login.php", function(data2) {
				$("#sideright").fadeOut(400,function() {
					$("#sideright").html('');
					$("#sideright").fadeIn(400,function() {
						$("#sideright").html(data2);
						$(".lihatprofil").click(lihatprofil);
					});
				});
			});
			$("#belanja").fadeOut(400,function() {
				$.get("getkeranjang.php",function(data) {
					$("#belanja").fadeIn(400,function() {
						$("#totalbayar").text(data.totalbayar);
						$("#totalbarang").text(data.totalbarang);
					});
				},"json");
			});
			document.getElementById("beli").name = "beli-"+data.id;
			document.getElementById("kosongkan").name = "beli-"+data.id;
		}

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

			getKeranjangBelanja();

			$(".lihatprofil").click(lihatprofil);

			$(".detailbarang").click(detailbarang);

			$(".addtocart").click(addtocart);

			$("#beli").click(lihatprofil);

			$("#cari").click(function(e) {
				var search = document.getElementById("textcari").value;
				showLoading($("#sidecenter"),100,100);
				$.post("search.php",{search: search},function(data) {
					hideLoading();
					$("#sidecenter").html("<center><h2>Hasil Pencarian</h2></center>"+data);
					$(".addtocart").click(addtocart);
				});
			});

			$("#kosongkan").click(function(e) {
				showLoading($("#belanja"));
				$.get("clearkeranjang.php",function(data2) {
					$.get("getkeranjang.php",function(data) {
						hideLoading();
						$("#totalbayar").text(data.totalbayar);
						$("#totalbarang").text(data.totalbarang);
					},"json");

					var id = $(e.target).attr("name");
					var split = id.split("-");
					var iduser = parseInt(split[1]);
					if (iduser > 0) {
						showLoading($("#sidecenter"),100,100);
						$.get("profil.php?id="+iduser, function(data){
							hideLoading();
							$('#sidecenter').html(data);
							$(".hapus").click(hapus);
						});
					}
				});
			});

			$(".hapus").click(hapus);

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
				showLoading($("#sidecenter"),100,100);
				$.get(page, function(data){
					hideLoading();
					$('#sidecenter').html(data);
					if (id == 1) {
						$(".addtocart").click(addtocart);
					}
				});
			});

			$("#buttlogin").click(function() {
				showLoading($("#login"));
				var username = document.getElementById("username").value;
				var password = document.getElementById("password").value;
				$.post("do_login.php", {loginusername: username, loginpassword: password}, function(data) {
					hideLoading();
					if (data.ok) {
						dologin(data);
					}
					else {
						alert("Username atau password salah...");
					}
				}, "json");
			});

			$("#buttsignup").click(function(){
				var daftarusername = document.getElementById("daftarusername").value;
				var daftarpassword = document.getElementById("daftarpassword").value;
				var konfirmpassword = document.getElementById("konfirmpassword").value;
				var daftarnama = document.getElementById("daftarnama").value;
				var daftaremail = document.getElementById("daftaremail").value;
				var daftaralamat = document.getElementById("daftaralamat").value;
				var daftarkodepos = document.getElementById("daftarkodepos").value;
				var daftartelp = document.getElementById("daftartelp").value;

				showLoading($("#daftarmember"));
				$.post("do_signup.php", {daftarusername: daftarusername, daftarpassword: daftarpassword, konfirmpassword: konfirmpassword, 
				 daftarnama: daftarnama, daftaremail: daftaremail, daftaralamat:daftaralamat, daftarkodepos:daftarkodepos,daftartelp : daftartelp}, function(data) {
				 	hideLoading();
				 	if (data.ok) {
				 		alert("Daftar berhasil");
						$(document).unbind('mouseup');
					    $("#daftarmember").animate({top: "-400px"}, 1000);
					    $("div.overlay").animate({opacity: 0, "z-index": -50},700);
					    dologin(data);
				 	}
				 	else {
				 		alert(data.error);
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
							<td>Nama Pengguna : </td>
							<td><input class="input" type="text" name="loginusername" placeholder="Nama pengguna" id="username"/></td>
						</tr>
						<tr>
							<td>Kata Kunci : </td>
							<td><input class="input" type="password" name="loginpassword" placeholder="Kata kunci" id="password"/></td>
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
				<?php if (isset($_SESSION['admin'])) {?>
				<li><a href="admin.php">Admin</a></li>
				<?php } ?>
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
					<div id= "belanja">Total barang = <span id="totalbarang">...
					</span><br/>Total bayar = <span id="totalbayar">...
					</span><br/>
						<input type="submit" value="Beli" name="beli-<?php if (isset($_SESSION['id'])) { echo $_SESSION['id']; } else { echo '0'; } ?>" class="submit" id="beli"/>
						<input type="submit" value="Kosongkan" name="beli-<?php if (isset($_SESSION['id'])) { echo $_SESSION['id']; } else { echo '0'; } ?>" class="submit" id="kosongkan"/>
					</div>
				</div>
				<div id ="kategori">
					<img src="images/kategori.png" alt = "kategori" width="200" height="25">
					<dl>
						<dt> <a href="#">Klub</a></dt>
						<dd>
							<ul>
							<?php
								$query = "SELECT * FROM barang WHERE kategori LIKE 'klub' ";
								$res = mysql_query($query);
								while ($data = mysql_fetch_assoc($res)) {
							?>
								<li><a href="#sidecenter" class="detailbarang" id="<?php echo $data['idbarang']; ?>"><?php echo $data['namabarang']; }?></a></li>
							</ul>
						</dd>
						<dt><a href="#">Negara</a></dt>
						<dd>
							<ul>
							<?php
								$query = "SELECT * FROM barang WHERE kategori LIKE 'negara' ";
								$res = mysql_query($query);
								while ($data = mysql_fetch_assoc($res)) {
							?>
								<li><a href="#sidecenter" class="detailbarang" id="<?php echo $data['idbarang']; ?>"><?php echo $data['namabarang']; }?></a></li>
							</ul>
						</dd>
						<dt><a href="#">Lokal</a></dt>
						<dd>
							<ul>
							<?php
								$query = "SELECT * FROM barang WHERE kategori LIKE 'lokal' ";
								$res = mysql_query($query);
								while ($data = mysql_fetch_assoc($res)) {
							?>
								<li><a href="#sidecenter" class="detailbarang" id="<?php echo $data['idbarang']; ?>"><?php echo $data['namabarang']; }?></a></li>
							</ul>
						</dd>
					</dl>
				</div>
			</div>
			<div id ="sidecenter">
				<?php
					$query = "SELECT * FROM barang WHERE stok > 0 order by totalbeli desc LIMIT 12";
					$res = mysql_query($query);
					while ($data = mysql_fetch_assoc($res)) {
				?>
				<div class="gambar"><?php echo $data['namabarang'];?><br/><a href="#"><img src="<?php echo $data['gambar']; ?>" width="100" height="110"></a>
					<br/>Rp <?php echo $data['harga'];?>,-
					<br/><img src="images/tambah.png" width="120" height="25" id="addtocart-<?php echo $data['idbarang']; ?>-<?php echo $data['harga']; ?>" class="addtocart" />
				</div>
				<?php } ?>
				<div class="clear"></div>
			</div>		
			<div id ="sideright">
				<div id="fsearch">
					<img src="images/cari.png" width="186px"/>
						<input type="text" name="search"  style="width: 130px;" id="textcari"/>
						<input type="submit" value="Cari" style="width: 40px;" id="cari"/>
				</div>
				<?php
					if (isset($_SESSION['id'])) {
						$query = "SELECT profpic FROM user WHERE id = ".$_SESSION['id'];
						$res = mysql_query($query);
						$data = mysql_fetch_assoc($res);
				?>
				<div id="profil">
					<img src="images/profil.png" width="186px"/><br/>
					<img src="<?php echo $data['profpic'];?>" alt="fotoprofil" width= "75px" height="70px"/>
					<a href="#sidecenter" name="lihatprofil-<?php echo $_SESSION['id']; ?>" class="lihatprofil">Lihat Profil</a>
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
					<table>
					<tr>
						<td>Username</td>
						<td><input class="input" type="text" id="daftarusername" size="20" maxlength="50" value=""/></td>
					</tr>

					<tr>
						<td>Password</td>
						<td><input class="input" type="password" id="daftarpassword"  size="20" maxlength="50" value=""/></td>
					</tr>
					<tr>
						<td>Konfirmasi Password</td>
						<td><input class="input" type="password" id="konfirmpassword"  size="20" maxlength="50" value=""/></td>
					</tr>
					<tr>
						<td>Nama</td>
						<td><input class="input" type="text" id="daftarnama"  size="20" maxlength="50" value=""/></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><input class="input" type="text" id="daftaremail"  size="20" maxlength="50"/></td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td><input class="input" type="text" id="daftaralamat"  size="20" maxlength="50"/></td>
					</tr>
					<tr>
						<td>Kodepos</td>
						<td><input class="input" type="text" id="daftarkodepos"/></td>
					</tr>
					<tr>
						<td>Telp/HP</td>
						<td><input class="input" type="text" id="daftartelp"/></td>
					</tr>
					<tr colspan="2">
						<td><input class="submit" id="buttsignup" type="submit" value="Daftar" name="daftar"/></td>
					</tr>
				</table>
		</div>
	</div>
</body>
</html>