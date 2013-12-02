<?php
	include("koneksi.php");
	session_start();

	if (isset($_POST['namabarang']) && isset($_POST['kategori']) && isset($_POST['harga']) && isset($_POST['stok'])) 
	{

		$id = $_GET['id'];
		$namabarang 	= $_POST['namabarang'];
		$kategori 		= $_POST['kategori'];
		$harga			= $_POST['harga'];
		$stok 			= $_POST['stok'];
		$dir = "";

		if ($kategori == 'klub') {
			$dir 	= 'images/jersey/klub/';
		}
		elseif ($kategori == 'negara') {
			$dir 	= 'images/jersey/negara/';
		}
		else
		{
			$dir 	= 'images/jersey/lokal/';
		}

			$uploadfile = $dir.$_FILES['file']['name'];
			if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile))
			{
				$query		= "UPDATE barang SET namabarang = '".$namabarang."', kategori = '".$kategori."', harga = ".$harga.", stok = ".$stok.", gambar='".$uploadfile."' WHERE idbarang =".$id;
				mysql_query($query);
			}
			else {
				$query		= "UPDATE barang SET namabarang = '".$namabarang."', kategori = '".$kategori."', harga = ".$harga.", stok = ".$stok." WHERE idbarang =".$id;
				mysql_query($query);
			}
	}

	if (isset($_POST['namamember']) && isset($_POST['alamatmember']) && isset($_POST['emailmember']) && isset($_POST['teleponmember'])) 
	{

		$id = $_GET['id'];
		$query = "DELETE FROM user WHERE id = ".$id;	
		mysql_query($query);	
	}

	if (isset($_POST['kontak1']) && isset($_POST['kontak2']) && isset($_POST['kontak4']) && isset($_POST['kontak5'])) 
	{

		$id = $_GET['idkontak'];
		$query = "DELETE FROM kontakkami WHERE idkontak = ".$id;	
		mysql_query($query);	
	}

	if (isset($_POST['submitconfirm'])) {
		$arrid = $_POST['idnota'];
		$len = count($arrid);
		for ($i=0; $i < $len; $i++) {
			$idnota = $arrid[$i];
			mysql_query("UPDATE nota set terkirim = 1 where idnota = ".$idnota);
			
			$qq = "SELECT * FROM keranjang WHERE idnota = ".$idnota;
			$res = mysql_query($qq);
			while($data = mysql_fetch_assoc($res)) {
				$qq = "SELECT stok, totalbeli FROM barang WHERE idbarang = ".$data['idbarang'];
				$barang = mysql_fetch_assoc(mysql_query($qq));
				$query = "UPDATE barang set stok = ".($barang['stok']-$data['jumlahbeli']).", totalbeli = ".($barang['totalbeli']+$data['jumlahbeli'])." WHERE idbarang = ".$data['idbarang'];
				mysql_query($query);
			}
		}
	}

?>
<!doctype html>
<html>
<head>
	<title>Admin</title>
	<link rel="stylesheet" type="text/css" href="styleadmin.css">
	<script type="text/javascript" src="js/jquery-2.0.3.min.js"></script>

	<script type="text/javascript">
		function showLoading(divtarget, height = 50, width = 50) {
			divtarget.append('<img src="images/ajax-loader.gif" id="loadingBox" height="'+height+'px" width="'+width+'px" />');
			$("#loadingBox").show();
		}

		function hideLoading() {
			$("#loadingBox").hide();
			$("#loadingBox").detach();
		}

		$(document).ready(function(e) {
			$(".detailjual").click(function(ee) {
				var id = $(ee.target).attr("id");
				var split = id.split("-");
				var idnota = parseInt(split[1]);
				// $.post("getdetailjual.php",{idnota: idnota},function(data) {

				// });
			});

			$(".checkvalid").click(function(ee) {
				var c = ee.target.checked;
				var id = $(ee.target).attr("id");
				var split = id.split("-");
				var idnota = parseInt(split[1]);
				var tr = "jual-"+idnota;

				var hidden = '<input type="hidden" name="idnota[]" value="'+idnota+'" id="hidden'+idnota+'"/>';
				if (c) {
					$("#"+tr).append(hidden);
				}
				else {
					$("#hidden"+idnota).detach();
				}
			});
		});
	</script>
</head>
<body>
	
	<div id="wrapper">
		<div id="header">
			<img src="images/logo.png" width= "290" height= "90">
			<div id ="login">
				<?php if (isset($_SESSION['admin'])) {
				?>
				<h3>Halo, <?php echo $_SESSION['username']." "; ?> | <a href="do_logout.php">Keluar</a></h3>
			</div>
		</div>
		<div id="navigation">
			<ul>
				<li><a href="#stok">Stok Barang</a></li>
				<li><a href="#laporan">Laporan Penjualan</a></li>
				<li><a href="#member">Edit Member</a></li>
				<li><a href="#pesan">Pesan</a></li>
			</ul>
			<div class="clear"></div>
		</div>
		<div id="content">
			<div id="stok">
				<h2>Edit Stok Barang</h2>
				<?php
					$query = "SELECT * FROM barang";
					$res = mysql_query($query);
					while ($data = mysql_fetch_assoc($res)) {?>
					<table border="1">
						<tr>
							<td>Nama Barang</td>
							<td>Kategori</td>
							<td>Harga</td>
							<td>Stok</td>
							<td>Gambar</td>
						</tr>
						<tr>
							<form method="post" action="admin.php?id=<?php echo $data['idbarang']?>" enctype="multipart/form-data">
							<td><input type="text" name="namabarang" value="<?php echo $data['namabarang'];?>"/></td>
							<td><input type="text" name="kategori" value="<?php echo $data['kategori'];?>"/></td>
							<td><input type="text" name="harga" value="<?php echo $data['harga'];?>"/></td>
							<td><input type="text" name="stok" value="<?php echo $data['stok'];?>"/></td>
							<td><img src="<?php echo $data['gambar'];?>" width="50" height="50"/>
								<input type="file" name="file"></td>
							<td><input type="submit" Value="Update"></td>
							</form>
						</tr>
					</table>	
						<?php } ?>			
			</div>
			<div id="laporan">
				<h2>Laporan Penjualan</h2>
				<center><h3>Belum melakukan pembelian</h3></center>
					<table border="1">
						<thead>
							<th>Idnota</th>
							<th>Nama</th>
							<th>Alamat</th>
							<th>NamaBarang</th>
							<th>Jumlahbeli</th>
							<th>SubTotal</th>
							<th>Total</th>
							<th>TanggalBeli</th>
							<th>No Rekening</th>
							<th>Transfer ke</th>
							<th>Tanggal Bayar</th>
							<th>Pesan</th>
							<th>Metode</th>
						</thead>
						<?php
					$query = "SELECT b.idnota as idnota, a.nama as nama, a.alamat as alamat, d.namabarang as namabarang, c.jumlahbeli as jumlahbeli, c.subtotal as subtotal, b.total as total,b.tanggalbeli as tanggalbeli, b.norek as norek, b.transfer as transfer, b.tanggalbayar as tanggalbayar, b.terkirim as terkirim, b.pesan as pesan, b.metode as metode FROM user a, nota b, keranjang c, barang d
WHERE a.id=b.id AND c.idnota=b.idnota AND c.idbarang = d.idbarang AND b.tanggalbeli IS NULL";
					$res = mysql_query($query);
					while ($data = mysql_fetch_assoc($res)) {?>
						<tr class="detailjual">
							<td><?php echo $data['idnota'];?></td>
							<td><?php echo $data['nama'];?></td>
							<td><?php echo $data['alamat'];?></td>
							<td><?php echo $data['namabarang'];?></td>
							<td><?php echo $data['jumlahbeli'];?></td>
							<td><?php echo $data['subtotal'];?></td>
							<td><?php echo $data['total'];?></td>
							<td><?php echo $data['tanggalbeli'];?></td>
							<td><?php echo $data['norek'];?></td>
							<td><?php echo $data['transfer'];?></td>
							<td><?php echo $data['tanggalbayar'];?></td>
							<td><?php echo $data['pesan'];?></td>
							<td><?php echo $data['metode'];?></td>
						</tr>
						<?php } ?>	
					</table>

			<center><h3>Belum melakukan konfirmasi</h3></center>
					<table border="1">
						<thead>
							<th>Idnota</th>
							<th>Nama</th>
							<th>Alamat</th>
							<th>NamaBarang</th>
							<th>Jumlahbeli</th>
							<th>SubTotal</th>
							<th>Total</th>
							<th>TanggalBeli</th>
							<th>No Rekening</th>
							<th>Transfer ke</th>
							<th>Tanggal Bayar</th>
							<th>Pesan</th>
							<th>Metode</th>
						</thead>
						<?php
					$query = "SELECT b.idnota as idnota, a.nama as nama, a.alamat as alamat, d.namabarang as namabarang, c.jumlahbeli as jumlahbeli, c.subtotal as subtotal, b.total as total,b.tanggalbeli as tanggalbeli, b.norek as norek, b.transfer as transfer, b.tanggalbayar as tanggalbayar, b.terkirim as terkirim, b.pesan as pesan, b.metode as metode FROM user a, nota b, keranjang c, barang d
WHERE a.id=b.id AND c.idnota=b.idnota AND c.idbarang = d.idbarang AND b.tanggalbeli IS NOT NULL AND b.tanggalbayar IS NULL ORDER BY b.idnota DESC";
					$res = mysql_query($query);
					$temp = -1;
					while ($data = mysql_fetch_assoc($res)) {if ($temp!=-1 && $temp!=$data['idnota']) {
						echo "<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
						echo "<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
						echo "<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
						echo "<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
					} $temp = $data['idnota']; ?>
						<tr class="detailjual" id="jual-<?php echo $data['idnota']; ?>">
							<td><?php echo $data['idnota'];?></td>
							<td><?php echo $data['nama'];?></td>
							<td><?php echo $data['alamat'];?></td>
							<td><?php echo $data['namabarang'];?></td>
							<td><?php echo $data['jumlahbeli'];?></td>
							<td><?php echo $data['subtotal'];?></td>
							<td><?php echo $data['total'];?></td>
							<td><?php echo $data['tanggalbeli'];?></td>
							<td><?php echo $data['norek'];?></td>
							<td><?php echo $data['transfer'];?></td>
							<td><?php echo $data['tanggalbayar'];?></td>
							<td><?php echo $data['pesan'];?></td>
							<td><?php echo $data['metode'];?></td>
						</tr>
						<?php } ?>	
					</table>

				<center><h3>Sudah melakukan konfirmasi</h3></center>
				<form action="admin.php" method="POST">
					<table border="1">
						<thead>
							<th>Idnota</th>
							<th>Nama</th>
							<th>Alamat</th>
							<th>NamaBarang</th>
							<th>Jumlahbeli</th>
							<th>SubTotal</th>
							<th>Total</th>
							<th>TanggalBeli</th>
							<th>No Rekening</th>
							<th>Transfer ke</th>
							<th>Tanggal Bayar</th>
							<th>Pesan</th>
							<th>Metode</th>
							<th>Valid</th>
						</thead>
						<?php
					$query = "SELECT b.idnota as idnota, a.nama as nama, a.alamat as alamat, d.namabarang as namabarang, c.jumlahbeli as jumlahbeli, c.subtotal as subtotal, b.total as total,b.tanggalbeli as tanggalbeli, b.norek as norek, b.transfer as transfer, b.tanggalbayar as tanggalbayar, b.terkirim as terkirim, b.pesan as pesan, b.metode as metode FROM user a, nota b, keranjang c, barang d
WHERE a.id=b.id AND c.idnota=b.idnota AND c.idbarang = d.idbarang AND b.tanggalbeli IS NOT NULL AND b.tanggalbayar IS NOT NULL GROUP BY b.idnota ORDER BY b.terkirim ASC";
					$res = mysql_query($query);
					$cc = 0;
					while ($data = mysql_fetch_assoc($res)) {?>
						<tr class="detailjual" id="jual-<?php echo $data['idnota']; ?>">
							<td><?php echo $data['idnota'];?></td>
							<td><?php echo $data['nama'];?></td>
							<td><?php echo $data['alamat'];?></td>
							<td><?php echo $data['namabarang'];?></td>
							<td><?php echo $data['jumlahbeli'];?></td>
							<td><?php echo $data['subtotal'];?></td>
							<td><?php echo $data['total'];?></td>
							<td><?php echo $data['tanggalbeli'];?></td>
							<td><?php echo $data['norek'];?></td>
							<td><?php echo $data['transfer'];?></td>
							<td><?php echo $data['tanggalbayar'];?></td>
							<td><?php echo $data['pesan'];?></td>
							<td><?php echo $data['metode'];?></td>
							<td><?php if ($data['terkirim']) { ?>OK<?php } else { ?> <input type="checkbox" name="valid[]" id="checkvalid-<?php echo $data['idnota']; ?>" class="checkvalid"/> <?php } ?></td>
						</tr>
						<?php } ?>	
					</table>
					<center><input type="submit" class="submit" value="Submit" name="submitconfirm"/></center>
				</form>
			</div>
			<div id="member">
				<h2>Edit Member</h2>
				<?php
					$query = "SELECT * FROM user";
					$res = mysql_query($query);
					while ($data = mysql_fetch_assoc($res)) {?>
					<table border="1">
						<tr>
							<td>Nama</td>
							<td>Alamat</td>
							<td>Kodepos</td>
							<td>Telepon</td>
							<td>Email</td>
							<td>Profpic</td>
							<td>Hapus</td>
						</tr>
						<tr>
							<form method="post" action="admin.php?id=<?php echo $data['id']?>" enctype="multipart/form-data">
							<td><input type="text" name="namamember" value="<?php echo $data['nama'];?>"</td>
							<td><input type="text" name="alamatmember" value="<?php echo $data['alamat'];?>"</td>
							<td><input type="text" name="kodeposmember" value="<?php echo $data['kodepos'];?>"</td>
							<td><input type="text" name="teleponmember" value="<?php echo $data['telepon'];?>"</td>
							<td><input type="text" name="emailmember" value="<?php echo $data['email'];?>"</td>
							<td><img src="<?php echo $data['profpic'];?>" width="50" height="50"/></td>
							<td><input type="submit" Value="Hapus"></td>
							</form>
						</tr>
					</table>	
						<?php } ?>	
			</div>
			<div id="pesan">
				<h2>Kontak Kami</h2>
				<?php
					$query = "SELECT * FROM kontakkami";
					$res = mysql_query($query);
					while ($data = mysql_fetch_assoc($res)) {?>
					<table border="1">
						<tr>
							<td>Nama</td>
							<td>Email</td>
							<td>Telepon</td>
							<td>Alamat</td>
							<td>Pesan</td>
							<td>Hapus</td>
						</tr>
						<tr>
							<form method="post" action="admin.php?idkontak=<?php echo $data['idkontak']?>"/>
							<td><input type="text" name="kontak1" value="<?php echo $data['namakontak'];?>"</td>
							<td><input type="text" name="kontak2" value="<?php echo $data['emailkontak'];?>"</td>
							<td><input type="text" name="kontak3" value="<?php echo $data['teleponkontak'];?>"</td>
							<td><input type="text" name="kontak5" value="<?php echo $data['alamatkontak'];?>"</td>
							<td><input type="text" name="kontak6" value="<?php echo $data['pesankontak'];?>"</td>
							<td><input type="submit" Value="Hapus" style={width:"50px";}></td>
							</form>
						</tr>
					</table>	
						<?php } ?>	
			</div>
		</div>
		<div id = "footer">&copy 2013 <a href="#">JerseyDW.com</a> Desain oleh DOA IBU-FTI UKDW</div>
		<?php } ?> 
	</div>
</body>
</html>