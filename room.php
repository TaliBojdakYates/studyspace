<?php
	session_start();
	$time = $_SESSION['classes'];
	$buildingName = $_SESSION['building'];
	$roomNumber = $_SESSION['rooms'];

	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<title>Room</title>
	<style type="text/css">
		.submitRed {
	      border-color: #cc0000;
	      color:  #cc0000;
	    }

		.submitRed:hover {
		    background: #cc0000;
		    color: white;
		}
		#page-container {
			position: relative;
			min-height: 100vh;
		}

		#content-wrap {
		  padding-bottom: 2.5rem;    /* Footer height */
		}

		#footer {
		  position: absolute;
		  bottom: 0;
		  width: 100%;
		  height: 2.5rem;            /* Footer height */
		}

		#
	</style>
</head>
<body>
	
	<?php include("templates/header.php");?>

	<div id="page-container">
		 <div id="content-wrap">
		 	<div class="text-center">
		 		<h4 class="d-flex justify-content-center m-1"> <?php echo $buildingName . ' Room ' . $roomNumber ?></h4>		
		 	</div>
				
			<?php foreach($time as $schedule){?>
				<div class="card m-3" style="background-color: rgb(204, 0, 0,0.1); border-color: #cc0000;">
				  <div class="card-header">Time: <?php echo $schedule["class_time"]; ?></div>
				  <div class="card-body">
				    <?php echo $schedule["class"]?>
				  </div>
				</div>
			<?php }; ?>

		 </div>
		 <footer id="footer">
		 	<?php  include("templates/footer.php"); ?>
		 </footer>
	</div>
		
	
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>