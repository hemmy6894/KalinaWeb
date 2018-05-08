					<ul class="list-group">
						<li class="list-group-item">
							<div class="row">
								<div class="col-md-12 text-uppercase">
									<h3> Services </h3>
								</div>
							</div>
						</li>
							<?php 
								$query = "SELECT * FROM service";
								$res = $mysqli->query($query,MYSQLI_STORE_RESULT);
								while($row_ser = $res->fetch_array(MYSQLI_ASSOC)){
									$sid = $row_ser['service_id'];
									$sbody = $row_ser['service_body'];
							?>
							<li class="list-group-item">
							<div class="row">
								<div class="col-md-12">
									<h4> <?php echo $sbody;?>  Service</h4>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 text-justify">
									<ul>
							<?php
								$query2 = "SELECT * FROM service_desc WHERE service_id = " . $sid . " limit 2";
								$res2 = $mysqli->query($query2,MYSQLI_STORE_RESULT);
									while ($row_desc = $res2->fetch_array(MYSQLI_ASSOC)) {
										$desc = $row_desc['service_desc_body'];
										echo "<li>" . $desc . "</li>";
									}
									echo "<a href='service.php?service=".$sbody."'>more..</a>";
									echo "</ul></div></div></li>";
								}
							?>
					</ul>