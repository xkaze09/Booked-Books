<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Booked Books | Title</title>
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="author" content="">
		<!-- Website favicon -->
		<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
		<!-- Bootstrap CDN -->
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
		<!-- AOS CDN -->
		<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
		<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
		<!-- Icons -->
		<script src="https://kit.fontawesome.com/bb214b8122.js" crossorigin="anonymous"></script>
		<link rel="shortcut icon" type="image/png" href="./images/main-logo-favicon.png">
		<!-- Normalize.css for consistent styling across browsers -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
		<!-- Icomoon.css for icon fonts -->
		<link rel="stylesheet" href="icomoon/icomoon.css">
		<!-- Vendor.css for third-party libraries or frameworks -->
		<link rel="stylesheet" href="css/vendor.css">
		<!-- Style.css for custom styles -->
		<link rel="stylesheet" href="style.css">
	</head>
<body>
<!-- Header -->
<?php
	require 'php/header.php';
?>

<!-- Product -->
<section class="bg-sand padding-large">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<a href="#" class="product-image"><img src="images/it-ends-with-us.jpg"></a>
			</div>
			<div class="col-md-6 pl-5">
				<div class="product-detail">
					<h1>It Ends With Us</h1>
					<h2>Colleen Hoover</h2>
					<p>Romance, Fiction, Contemporary, New Adult</p>
					<span class="availability available">✔ Available</span>

					<p>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. 
					</p>
					<p>
						Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
					</p>
					<button type="submit" name="add-to-cart" value="27545" class="button">Add To Rent</button>
				</div>
			</div>
		</div>
	</div>
</section>
<footer id="footer">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="footer-item">
					<div class="company-brand">
						<img src="images/main-logo.png" alt="logo" class="footer-logo">
						<p>Escape into a world of endless possibilities with our online book library. </p>
					</div>
				</div>
			</div>
			<div class="col-md-2">
				<div class="footer-menu">
					<h5>About Us</h5>
					<ul class="menu-list">
						<li class="menu-item">
							<a href="/about.html#our-team">Team Members</a>
						</li>
						<li class="menu-item">
							<a href="/about.html#our-mission">Our Mission </a>
						</li>
						<li class="menu-item">
							<a href="/about.html#our-vision">Our Vision</a>
						</li>
						<li class="menu-item">
							<a href="/about.html#FAQs">FAQs</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-md-2">
				<div class="footer-menu">
					<h5>Browse</h5>
					<ul class="menu-list">
						<li class="menu-item">
							<a href="#">Books</a>
						</li>
						<li class="menu-item">
							<a href="#">Authors</a>
						</li>
						<li class="menu-item">
							<a href="#">Genres</a>
						</li>
						<li class="menu-item">
							<a href="#">Search</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-md-2">
				<div class="footer-menu">
					<h5>My Account</h5>
					<ul class="menu-list">
						<li class="menu-item">
							<a href="#">Sign In</a>
						</li>
						<li class="menu-item">
							<a href="#">View Rents</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-md-2">
				<div class="footer-menu">
					<h5>Contact</h5>
					<ul class="menu-list">
						<li class="menu-item">
							<a href="#">Information</a>
						</li>
						<li class="menu-item">
							<a href="#">Send an Email</a>
						</li>
						<li class="menu-item">
							<a href="#">FAQs</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</footer>
<div id="footer-bottom">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<div class="copyright">
					<div class="row">
						<div class="col-md-6">
							<p><strong>Booked Books</strong> © 2023 All Rights Reserved.</p>
						</div>
						<div class="col-md-6">
							<div class="social-links align-right">
								<ul>
									<li>
										<a href="#"><i class="icon icon-facebook"></i></a>
									</li>
									<li>
										<a href="#"><i class="icon icon-twitter"></i></a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="js/script.js"></script>
</body>
</html>	