<?php
	include 'include/dbconn.php';

	$id = $_POST['servicetitleid'];
	$myService = array();
	$j = 0;
	for ($i=0; $i < $_POST['serviceno']; $i++) { 
		$ser = "sub".$i;
		if(!empty($_POST[$ser])){
			$myService[$j] = $_POST[$ser];
			$j++;
		}
	}

	if(sizeof($myService) > 0){
		for ($i=0; $i < sizeof($myService); $i++) { 
			$sql = "INSERT INTO service_desc(service_id,service_desc_body) VALUES(".$id.",'".$myService[$i]."')";
			$mysqli->query($sql);
			echo mysqli_error($mysqli);
		}
		header('location:addservice.php');
	}else{
		echo "string";
	}
?>