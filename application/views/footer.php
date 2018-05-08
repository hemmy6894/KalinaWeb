		<div class="myfc">
			<div class="row">
				<div class="col-md-2">
					<ul style="list-style : none;">
						<li>
							<h4>Navigation</h4>
						</li>
						<li>
							<a href="<?=site_url('kalina')?>">Home</a>
						</li>
						<li>
							<a href="<?=site_url('kalina/about')?>">About</a>
						</li>
						<li>
							<a href="<?=site_url('kalina/service')?>">Service</a>
						</li>
						<li>
							<a href="<?=site_url('kalina/contact')?>">Contact</a>
						</li>
					</ul>
				</div>
				<div class="col-md-1"></div>
				<div class="col-md-4">

					<ul style="list-style : none;">
						<li>
							<h4>Service</h4>
						</li>
						<?php 
								/*
								$query = "SELECT * FROM service";
								$res = $mysqli->query($query,MYSQLI_STORE_RESULT);
								while($row_ser = $res->fetch_array(MYSQLI_ASSOC)){
									$sid = $row_ser['service_id'];
									$sbody = $row_ser['service_body'];
									echo "<li><a href='service.php?service=".$sbody."'>".$sbody."</a></li>";
								}
								*/
						?>
					</ul>
				</div>
				<div class="col-md-1"></div>
				<div class="col-md-5">
					<ul style="list-style : none;">
						<li>
							<h4>Contact</h4>
						</li>
						<li>
							Adress: P.o Box 34595 , Dar es Salaam
						</li>
						<li>
							Phone: (+255)623-642 084 | (+255) 678-415 008 
						</li>
						<li>
							Email: <a href="mailto:info@kalina.co.tz">info@kalina.co.tz</a>
						</li>
						<li>
							Website <a href="<?=site_url('kalina');?>">Kalina Web</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	
