<?php
	include 'include/dbconn.php';
	include 'header.php';
?>
<div class="container">
<div class="row">
<div class="col-md-2"></div>
<div class="col-md-7">
<?php 
	$service = $nos = "";
	$nos = htmlspecialchars($_POST['subno']);
	$service = htmlspecialchars($_POST['service']);
	
	$sql = "INSERT INTO service(service_body) VALUE('" . $service ."')";
	$sql2 = "SELECT max(service_id) FROM service";
	if($mysqli->query($sql,MYSQLI_STORE_RESULT)){
		$no = $mysqli->query($sql2);
		$my = $no->fetch_array();
		?>
			<form method="post" action="addsubser.php" role="form">
				<input name="servicetitleid" type="text" value="<?php echo $my[0]?>"  hidden><br>
				<input name="servicetitle" type="text" value="<?php echo $service;?>" class="form-control" disabled><br>
				<?php 
					for ($i=0; $i < $nos; $i++) { 
						?>
							<input type="text" name="<?php echo "sub".$i;?>" placeholder="<?php echo "Enter subheading ".($i + 1);?>" class="form-control"><br>
						<?php
					}
				?>
				<button type="submit" class="btn btn-primary">
					<span class="glyphicon glyphicon-add">
						Save!
					</span>
				</button>
				<input name="serviceno" type="number" value="<?php echo $nos;?>" hidden><br>
				
			</form>
		<?php
	}else{
	}
?>
</div>
</div>
</div>
