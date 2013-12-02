<?php
	include("koneksi.php");
	include("utility.php");

	cleanALL($_GET);
	$id = $_GET['id'];
	$query  = "SELECT * FROM barang WHERE idbarang = $id";
	$res	= mysql_query($query);
	$harga;
	$idbarang;
	$ada = false;

	while ($data = mysql_fetch_assoc($res)) { $harga = $data['harga']; $idbarang = $data["idbarang"]; ?>

	<div id="rincian">
		<div id="rincian2">
			<img src= "<?php echo $data['gambar'];?>">
		</div>
		<div id="rincian3">
			<h3><?php echo $data['namabarang'];?></h3>
			<h4>Harga Rp. <?php echo $harga;?></h4>
			<h5>Ukuran : All Size</h5>
			<?php
			if ($data['stok'] > 0) { $ada = true;?>
				<img src="images/stok1.png"/><br/><br/>
			<?php
			} else{
			?>
				<img src="images/stok2.png"/><br/><br/>
		<?php
		}}
		?>
		Jumlah :
		<select name="jml" id="jml">
		  <option value="1">1</option>
		  <option value="2">2</option>
		  <option value="3">3</option>
		  <option value="4">4</option>
		  <option value="5">5</option>
		  <option value="6">6</option>
		</select><br/><br/>
		<img src="images/tambah.png" width="120" height="25" id="addtocart-<?php echo $idbarang; ?>-<?php echo $harga; ?>" class="<?php if($ada) echo 'addtocart'; else echo 'YuanUPLOAD'; ?>">
		</div>
		<div class="clear"></div>
	</div>