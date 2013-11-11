<?php
	include("koneksi.php");
	include('utility.php');
	session_start();
	$ok = false;
		if (isset($_POST['loginusername']) && isset($_POST['loginpassword'])) {
			cleanAll($_POST);
			$username = $_POST['loginusername'];
			$password = $_POST['loginpassword'];

			$query	  =  "SELECT * FROM user WHERE username = '".$username."' AND password = '".$password."'";
			$hasil = mysql_query($query);
			if (mysql_num_rows($hasil) == 1) {
				// $ok = true;
				$row = mysql_fetch_assoc($hasil);
				$_SESSION['id'] = $row['id'];
				$_SESSION['admin'] = $row['admin'];
				$_SESSION['username'] = $row['username'];
				echo json_encode(array("ok"=>true, "username"=>$row['username']));
			}
			else {
				echo json_encode(array("ok"=>false));
			}
		}
		else {
			echo json_encode(array("ok"=>false));
		}
?>