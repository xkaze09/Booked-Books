<!DOCTYPE html>
<html>
    <head>
		<!-- Check if user is an admin -->
		<?php
		session_start();
		if (is_null($_SESSION["isAdmin"])){
			echo "<meta http-equiv=\"refresh\" content=\"0; URL='index.html'\"/>";
		}
		?>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Booked Books Admin | Dashboard</title>
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="author" content="">
		<!-- Chart.js CDN -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.0/chart.min.js" integrity="sha512-mlz/Fs1VtBou2TrUkGzX4VoGvybkD9nkeXWJm3rle0DPHssYYx4j+8kIS15T78ttGfmOjH0lLaBXGcShaVkdkg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<!-- JQuery CDN -->
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
<body class="container-fluid hide-scrollbar d-flex flex-column" style="width: 100vw;height: 100vh;">
	<div class="row flex-grow-1">
		<div class="container-fluid overflow-scroll hide-scrollbar d-flex">
			<div class="row w-100">
				<div class="col-md-3 flex-shrink-0 p-3 overflow-scroll">
					<a href="dashboard.php" class="justify-content-center align-self-center">
						<img src="images/main-logo.png" alt="logo" class="img-fluid">
					</a>
					<p class="m-0 text-center"><b class="m-0 p-0">Administrator</b></p>
					<ul class="list-unstyled ps-0 m-0">
					  <li class="mb-1">
						<button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 m-0 collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
						  Dashboard
						</button>
						<div class="collapse" id="dashboard-collapse">
						  <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small my-0">
							<li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Overview</a></li>
							<li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded"></a></li>
							<li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Monthly</a></li>
							<li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Annually</a></li>
						  </ul>
						</div>
					  </li>
					  <li class="mb-1">
						<button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 m-0 collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
						  Catalog
						</button>
						<div class="collapse" id="orders-collapse">
						  <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small my-0">
							<li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded book-toggle" data-target="library">Book Database</a></li>
							<li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded book-toggle" data-target="add-book">Add Book</a></li>
						  </ul>
						</div>
					  </li>
					  <li class="mb-1">
						<button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 m-0 collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
						  Users
						</button>
						<div class="collapse" id="home-collapse">
						  <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small my-0">
							<li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Overview</a></li>
							<li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Overdue</a></li>
							<li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Reports</a></li>
						  </ul>
						</div>
					  </li>
					  <li class="mb-1">
						<button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 m-0 collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
						  Account
						</button>
						<div class="collapse" id="account-collapse">
						  <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small my-0">
							<li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Profile</a></li>
							<li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Settings</a></li>
							<li><a href="./php/logout.php" class="link-dark d-inline-flex text-decoration-none rounded" onclick="stopSession()">Sign out</a></li>
						  </ul>
						</div>
					  </li>
					</ul>
				</div>
				<div class="col-md-9">
					<main class="ms-sm-auto px-md-4" id="admin-content">
						<!-- Dashboard -->
						<div id="main-dashboard" class="admin-panels">
							<canvas id="myChart" class="w-100"></canvas>
						</div>


						<!-- Adding Books -->
						<div id="add-book" class="admin-panels w-100">
							<h2>Add Book</h2>
							<form id="add-book-form" action="test.php" method="POST" enctype="multipart/form-data">
								<div class="row">
									<div class="col-lg-6">
										<label for="cover_image">Cover Image:</label>
										<img src="" class="img-fluid w-50" id="cover">
										<input type="file" name="cover_image" id="cover_image" onchange="previewFile()" accept=".jpg,.png">

										<label for="availability">Availability:</label>
										<select name="availability" id="availability" required>
											<option value="1">Available</option>
											<option value="0">Not Available</option>
										</select>

										<label for="quantity">Quantity:</label>
										<input type="number" name="quantity" id="quantity" min="1" value="1" required>
									</div>
									<div class="col-lg-6">
										<label for="title">Title:</label>
										<input type="text" name="title" id="title" required>

										<label for="author">Author:</label>
										<input type="text" name="author" id="author" required>

										<label for="description">Description:</label>
										<textarea name="description" id="description" class="w-100" required></textarea>

										<label for="genre">Genre:</label>
										<input type="text" name="genre" id="genre" required>
									</div>
									<input type="submit" value="Add Book" id="submitbook">
								</div>
							</form>
							<div id="message"></div> <!-- Div for displaying the message -->
						</div>

						<!-- Viewing Books -->
					</main>
				</div>
			</div>
		</div>
	</div>
	
</body>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js" integrity="sha384-gdQErvCNWvHQZj6XZM0dNsAoY4v+j5P1XDpNkcM3HJG1Yx04ecqIHk7+4VBOCHOG" crossorigin="anonymous"></script>
<script src="./js/script.js"></script>
<script>
	function previewFile() {
		var preview = $('#cover');
		var file 	= document.querySelector('#cover_image').files[0];
		// var file    = $("#cover_image").prop('files');
		console.log(file);
		var reader  = new FileReader();

		reader.onloadend = function () {
			preview.attr("src", reader.result);
		}

		if (file) {
			reader.readAsDataURL(file);
		} else {
			preview.attr("src","");
		}
	}

	$('.book-toggle').click(function() {
    console.log()
    $('#admin-content div').hide();
    var target = '#' + $(this).data('target');
    $(target).show();
	});

	$('#admin-content div').hide();
	$("#main-dashboard").show();

</script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jScrollPane/2.2.2/script/jquery.jscrollpane.min.js" integrity="sha512-EqofP+sBEn/OWcyAINAUnewpwC0e9zc0GvyiVeE3qeHYxqtdCcNocVBUiZhGWbPFWGTWxfJ60CcOK6HQ6G7uiw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
</html>