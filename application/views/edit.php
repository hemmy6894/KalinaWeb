<?php
	include 'include/dbconn.php';
	include 'header.php';
?>
<div class="container">
<div class="row">
<div class="col-md-1"></div>
<div class="col-md-9">
<?php 
	if(isset($_GET['service'])){
			$service = htmlspecialchars($_GET['service']);
			
			$sql = "SELECT service_body FROM service WHERE service_id = " . $service;
			$sql2 = "SELECT * FROM service_desc WHERE service_id = " . $service ;
			if($we = $mysqli->query($sql,MYSQLI_STORE_RESULT)){
				$wo = $we->fetch_array();
				$no = $mysqli->query($sql2);
				
				?>
					<form method="post" action="updsubser.php" role="form">
						<input name="servicetitleid" type="text" value="<?php echo $service ?>"  hidden><br>
						<input name="servicetitle" type="text" value="<?php echo $wo[0]. " Service";?>" class="form-control" disabled><br>
						<?php 
							$i = -1;
							while($my = $no->fetch_array()) { 
								$i++;
								?>
									<div class="row">
										<div class="col-md-11">
											<input type="text" name="<?php echo "sub".$i;?>" value="<?php echo $my['service_desc_body'];?>" class="form-control">
										</div>
										<div class="col-md-1">
											<a href="delete_sub?sub='<?php echo $my['service_desc_id']?>'">
												<span class="glyphicon glyphicon-trash"></span>
											</a>
										</div>
									</div>
									<br>
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
	}else{
		header('location:addservice.php');
	}
?>
</div>
</div>
</div>
