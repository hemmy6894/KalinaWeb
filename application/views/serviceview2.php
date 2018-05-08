
					
							<?php 
								$query = "SELECT * FROM service WHERE service_body = '" . $_GET['service'] . "'";
								$res = $mysqli->query($query,MYSQLI_STORE_RESULT);
								if(mysqli_num_rows($res) < 1){
									header('location:service.php');
								}
								while($row_ser = $res->fetch_array(MYSQLI_ASSOC)){
									$sid = $row_ser['service_id'];
									$sbody = $row_ser['service_body'];
							?>
					<div class="row">
						<div class="col-md-12 text-center">
							<img src="<?php echo 'image/'.$sbody.'.jpg'?>" class="img img-resposive">
						</div>
					</div>
					<div class="row" style="margin-top:10px">
						<div class="col-md-7">
							<ul class="list-group">
							<li class="list-group-item">
								<div class="row">
									<div class="col-md-12 text-uppercase">
										<h4> <?php echo $sbody;?>  Service</h4>
									</div>
								</div>
							</li>
							<li class="list-group-item">
							<div class="row">
								<div class="col-md-12 text-justify">
									<ul>
							<?php
								$query2 = "SELECT * FROM service_desc WHERE service_id = " . $sid;
								$res2 = $mysqli->query($query2,MYSQLI_STORE_RESULT);
									while ($row_desc = $res2->fetch_array(MYSQLI_ASSOC)) {
										$desc = $row_desc['service_desc_body'];
										echo "<li>" . $desc . "</li>";
									}
									echo "</ul></div></div></li>";
								}
							?>
							</li>
					</ul>