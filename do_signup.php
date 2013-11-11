<?php
	include("koneksi.php");
	include('utility.php');
	session_start();
	$ok = false;
	if (isset($_POST['daftar'])) {
		if (isset($_POST['loginusername']) && isset($_POST['loginpassword'])) {
			cleanAll($_POST);
			$username = $_POST['loginusername'];
			$password = $_POST['loginpassword'];

			$query	  =  "SELECT * FROM user WHERE username = '".$username."' AND password = '".$password."'";
			$hasil = mysql_query($query);
			if (mysql_num_rows($hasil) == 1) {
				$ok = true;
				$row = mysql_fetch_assoc($hasil);

				$_SESSION['id'] = $row['id'];
				$_SESSION['admin'] = $row['admin'];
				$_SESSION['username'] = $row['username'];
			}
		}
		else {
			header("location:login.php");
		}
	}
	else {
		header("location:login.php");
	}
?>

<!doctype html>
<html>
<head>
	<title>Jersey DW</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="description" content="jersey" />
	<meta name="keywords" content="jersey" />
</head>

<body>
	<?php
		if ($ok) {
			$counter = 5;
	?>
	MASUK SUKSES...<br />
	Anda akan diteruskan ke halaman index dalam <h1 id="counter"><?php echo $counter; ?></h1>... atau klik <a href="index.php">di sini</a>
	<?php
		};
	?>
	<script type="text/javascript">
		var counter = parseInt(document.getElementById('counter').innerHTML);
		var intervalid = window.setInterval(function() {
			document.getElementById('counter').innerHTML = --counter;
			if (counter == 0) {
				window.clearInterval(intervalid);
				window.location.replace('index.php');
			}
		},1000);
	</script>
</body>

</html>