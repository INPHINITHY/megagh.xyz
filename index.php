<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css\customStyleSheet.css" rel="stylesheet" type="text/css" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="doubletaptogo.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

		<title>WELCOME </title> 
		
</head>

<body class="bg-dark-subtle">
	
    <header class="header">
        	<?php include('includes\nav.php'); ?>
    </header>
	<!--main content-->
	
	<div class="container ">
         <div>
			<p class="h1 text-center ">Welcome</p>
			<p class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, architecto doloribus aliquam porro veritatis dolore voluptas quis! Libero, a possimus! Eos repudiandae illo voluptate, rerum sunt dolor dolores animi quibusdam?</p>
		 </div>
    </div> 
	<div class="container text-center imglinks">
		<div class="row ">
			<div class="col">
				<a href="index.php">
					<img src="assets\images\Homeimg.jpg" class=" rounded" alt="">
				<p>Home</p>
				</a>
			</div>

			<div class="col">
				<a href="\pages\Clubs.php">
					<img src="assets\images\clubsimg.jpg" class=" rounded" alt="">
				<p>Clubs</p>
				</a>
			</div>
        </div>
			
		<div class="row">
			<div class="col">
				<a href="pages\Tournament.php">
					<img src="assets\images\tours.avif" class=" rounded" alt="">
			          <p>Tournaments</p>
				</a>
			</div>

			<div class="col">
				<a href="\pages\About-us.php">
					<img src="assets\images\IMG-20240912-WA0201.jpg" class=" rounded"  alt="">
					 <p>About us</P>
				</a>
			</div>
		</div>
    </div>

	<!--main content end-->
	<footer class="footer text-center text-lg-start text-white"
	style="background-color: #929fba">
            <?php include('includes\footer.phpp'); ?>
    </footer>
</body>
</html>