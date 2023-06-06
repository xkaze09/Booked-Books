<!DOCTYPE html>
<html>
    <head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Booked Books Admin | Dashboard</title>
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
<body class="container-fluid hide-scrollbar d-flex flex-column" style="width: 100vw;height: 100vh;">
	<div class="row w-100">
		<header class="navbar flex-md-nowrap p-0 my-auto d-flex">
			<div class="row m-2 align-items-center">
				<div class="col-sm-2">
					<a href="dashboard.php" class="justify-content-center align-self-center">
						<img src="images/main-logo.png" alt="logo" class="img-fluid">
					</a>
					<p class="m-0 text-center"><b class="m-0 p-0">Administrator</b></p>
				</div>
				<div class="col-sm-8">
				</div>
				<div class="navbar-nav col-sm-2">
				</div>
			</div>
		</header>
	</div>
	<div class="row flex-grow-1">
		<div class="container-fluid overflow-scroll hide-scrollbar d-flex">
			<div class="row w-100">
				<div class="col-md-3 flex-shrink-0 p-3 overflow-scroll">
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
							<li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Book Database</a></li>
							<li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Rented Books</a></li>
							<li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Add Book</a></li>
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
							<li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Sign out</a></li>
						  </ul>
						</div>
					  </li>
					</ul>
				</div>
				<div class="col-md-9">
					<main class="ms-sm-auto col-lg-10 px-md-4">
					</main>
				</div>
			</div>
		</div>
	</div>
	
</body>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js" integrity="sha384-gdQErvCNWvHQZj6XZM0dNsAoY4v+j5P1XDpNkcM3HJG1Yx04ecqIHk7+4VBOCHOG" crossorigin="anonymous"></script>
<!-- <script src="dashboard.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jScrollPane/2.2.2/script/jquery.jscrollpane.min.js" integrity="sha512-EqofP+sBEn/OWcyAINAUnewpwC0e9zc0GvyiVeE3qeHYxqtdCcNocVBUiZhGWbPFWGTWxfJ60CcOK6HQ6G7uiw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
</html>