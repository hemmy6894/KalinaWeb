<?php
	include 'include/dbconn.php';
	if(isset($_GET['service'])){
		$sql = "DELETE FROM service WHERE service_id = " . $_GET['service'];
		if($mysqli->query($sql)){
			$sql2 = "DELETE FROM service_desc WHERE service_id = " . $_GET['service'];
			if($mysqli->query($sql2))
				header('location:addservice.php');
		}
	}
?>