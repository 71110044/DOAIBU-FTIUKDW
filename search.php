<?php
	include("koneksi.php");
	include("utility.php");
	session_start();
	if (isset($_POST['search'])) {
		cleanALL($_POST);
		$search = $_POST['search'];
		$query  = "SELECT * FROM barang WHERE namabarang LIKE '%$search%'";
		$res	= mysql_query($query);
		?>
		<div id="search123">
		<?php while ($data = mysql_fetch_assoc($res)) {?>
			<div class="gambar">
				<?php echo $data['namabarang'];?><br/><a href="#"><img src="<?php echo $data['gambar']; ?>" width="100" height="110"/></a>
				<br/>Rp <?php echo $data['harga'];?>,-
				<br/><img src="images/tambah.png" width="120" height="25" id="addtocart-<?php echo $data['idbarang']; ?>-<?php echo $data['harga']; ?>" class="<?php echo 'addtocart'; ?>"/>
			</div>
	<?php } 

		}?>
	</div>