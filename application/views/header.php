<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?=base_url('assets/css/bootstrap.min.css');?>">
  <link rel="shortcut icon" href="<?=base_url('upload/logo.png');?>" />
  <script src="js/bootstrap.min.js"></script>
  <style type="text/css">
		body{
			font-size: 16px;
			font-family: Arial;
		}
		#link{
			padding : 30px 2px 2px 2px;
			font-size: 20px;
		}
		.myfc{
			background-color: #ccc;
			padding : 20px;
		}

		@media screen and (max-width: 780px){
			#link{
				padding-left: 20px;
				float: left;
			}
		}
		#body_image{
			height : 100%;
			width: 100%;
		}
		
		#map {
			height: 400px;
			width: 100%;
		   }
  </style>
  <script type="text/javascript">
      function initMap() {
        var uluru = {lat: -6.8158884, lng: 39.287554};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 18,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
	</script>
</head>
<body>
<?php 	
	//include 'include/dbconn.php'; 
	if(isset($_GET['add'])){
		header('location:addservice.php');
	}
?>
		<div class="row">
			<div class = "col-md-12 text-right text-padding" style="background-color:skyblue;padding:20px;">
				Phone: <a href="tel:0623642084">(+255) 623-642 084</a> | <a href="tel:0678415008">(+255) 678-415 008</a>  | info@kalina.com
				<br>
			</div>
		</div>
		<div class="row">
			<div class="col-md-1 col-sm-12">
				<img src="<?=base_url('upload/logo.png');?>" height="100" width="250" class="img image-rounded"/>
			</div>
			<div class="col-md-6"></div>
			<div class="col-md-1 col-sm-3  col-xm-3 text-center">
				<span class="glyphicon glyphicon" id="link">
					<a href="<?=site_url('kalina')?>"> Home</a>
				</span>
			</div>
			<div class="col-md-1 col-sm-3 col-xm-3 text-center" id="link">
				<span class="glyphicon glyphicon">
					<a href="<?=site_url('kalina/about')?>"> About</a>
				</span>
			</div>
			<div class="col-md-1 col-sm-3 col-xm-3 text-center" id="link">
				<span class="glyphicon glyphicon">
					<a href="<?=site_url('kalina/service')?>"> Service</a>
				</span>
			</div>
			<div class="col-md-1 col-sm-3 col-xm-3 text-center" id="link">
				<span class="glyphicon glyphicon">
					<a href="<?=site_url('kalina/contact')?>"> Contacts</a>
				</span>
			</div>
		</div>
		<hr>