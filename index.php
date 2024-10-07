<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="doubletaptogo.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="shortcut icon" href="favicon\favicon-16x16.png" type="image/x-icon">
<link rel="shortcut icon" href="favicon\site.webmanifest" type="image/x-icon">
<link href="./../css-library/style.css"  rel="stylesheet" type="text/css" />
		<title>WELCOME </title> 
		
</head>
<style>
	
</style>
<body class="body-light">
    <header class="header">
        	<?php include('includes/nav.php'); ?>
    </header>
	<!--main content-->
	<div class="container-fl" style="padding:0;">
	    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
				<?php include('includes/slideshow.php'); ?>
		</div>
	</div>

	<div class="container-fl center">
         <div>
			<h1 >Welcome</h1>
			<p style="font-size:20px">Join the ultimate gaming experience</p>
		 </div>
    </div> 
	<div class="container-lm">
		<div class="grid-two-columns">
			<div class=" imglinks">
				<a href="index.php">
					<img src="assets/images/Homeimg.jpg" alt="">
				<p>Home</p>
				</a>
			</div>

			<div class="imglinks">
				<a href="pages/clubs.php">
					<img src="assets/images/clubsimg.jpg" alt="">
				<p>Clubs</p>
				</a>
			</div>
        </div>
			
		<div class="grid-two-columns">
			<div class=" imglinks">
				<a href="pages/tournament.php">
					<img src="assets/images/tours.avif" alt="">
			          <p>Tournaments</p>
				</a>
			</div>

			<div class="imglinks">
				<a href="pages/aboutUs.php">
					<img src="assets/images/IMG-20240912-WA0201.jpg"  alt="">
					 <p>About us</P>
				</a>
			</div>
		</div>
    </div>
	<div class="card-section">
			<h2>MISSION :</h2>
				<p>MEGA's mission is to promote and support the efootball gaming community through competitions, advocacy, and social engagement as we strive to create a safe and inclusive space for efootball gamers of all backgrounds, skills and abilities, and to foster a culture of respect, sportsmanship, and creativity.
				</p>
	</div>
		
	<div class="card-section">
			<h1>VISION:</h1>
				<p>MEGA envisions becoming a leading association dedicated to promoting excellence, integrity, and inclusivity in eFootball™ gaming on a national and international level. We aim to create a vibrant and supportive community where eFootball™ gamers of all skill levels can connect, learn, and thrive. MEGA seeks to establish itself as a trusted authority in eFootball™ gaming, organize prestigious tournaments and events, cultivate a culture of sportsmanship and fair play, contribute to the development and growth of eFootball™ gaming, and empower eFootball™ gamers to reach their full potential</p>
		</div>

	<!--main content end-->
	<footer class="footer center">
            <?php include('includes/footer.php'); ?>
    </footer>
</body>
</html>