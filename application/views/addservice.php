<?php 
	include 'header.php';
?>
					<?php 
								$query = "SELECT * FROM service";
								$res = $mysqli->query($query,MYSQLI_STORE_RESULT);
								while($row_ser = $res->fetch_array(MYSQLI_ASSOC)){
									$sid = $row_ser['service_id'];
									$sbody = $row_ser['service_body'];
									echo "<div class='container'>";
									echo "<div class='row'>";
									echo "<div class='col-md-8'>";
									echo "<a href='service.php?service=".$sbody."'>".$sbody."</a>";
									echo "</div>";
									echo "<div class='col-md-1'>";
									echo "<a href='delete.php?service=".$sid."'>Delete</a>";
									echo "</div>";
									echo "<div class='col-md-1'>";
									echo "<a href='edit.php?service=".$sid."'>Edit</a>";
									echo "</div>";
									echo "<div class='col-md-1'>";
									echo "<a href='service.php?service=".$sbody."'>view</a>";
									echo "</div>";
									echo "</div></div>";
									echo "<hr>";
								}
						if(isset($_GET['addn'])){
							include 'interface.php';
						}
					?>
						
						<div class="container">
							<button class="btn btn-warning" style="font-size:20px;margin-top:10px;">
								<a href="?addn">
									<span class="glyphicon glyphicon-plus">
										NEW SERVICE
									</span>
								</a>
							</button>
						</div>

