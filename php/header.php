<?php
    echo '<div id="header-wrap" class="sticky-top bg-light">
	<header id="header" class="pb-0">
		<div class="container">
			<div class="row">
				<!-- Logo -->
				<div class="col-md-2 h-60">
					<div class="main-logo">
						<a href="index.html"><img src="images/main-logo.png" alt="logo" class="img-fluid"></a>
					</div>
				</div>
				<!-- Navbar -->
				<div class="col-md-10 h-60">
					<nav id="navbar">
						<div class="main-menu stellarnav">
							<ul class="menu-list">
								<li class="menu-item active"><a href="./index.html" class="nav-link" data-effect="Home">Home</a></li>
								<li class="menu-item"><a href="./about.php" class="nav-link" data-effect="About">About</a></li>
								<li class="menu-item"><a href="./browse.php" class="nav-link" data-effect="Browse">Browse</a></li>
								<li class="menu-item"><a href="./contact.php" class="nav-link" data-effect="Contact">Contact</a></li>
							</ul>
							<div class="hamburger">
				                <span class="bar"></span>
				                <span class="bar"></span>
				                <span class="bar"></span>
				            </div>
						</div>
					</nav>
				</div>
			</div>
		</div>
		<!-- Search Bar-->
		<div class="top-content pb-0 h-40">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="container m-0 p-0">
							<div class="d-flex m-0 p-0">
								<div class="searchbar p-0" onmousedown="searchActive()">
									<a href="#" class="search_icon"><i class="fas fa-search"></i></a>
									<input class="search_input m-0" type="text" name="" id="searchbar" placeholder="Search...">
								</div>
							</div>
						</div>
					</div>
					<!-- User Activity Section -->
					<div class="col-md-6">
						<div class="right-element d-flex btn-group float-end m-0 align-top">';

						    session_start();

							if(isset($_SESSION['name'])){
								echo '<div class="m-0" id="subnav"><a href="#" class="user-account for-buy bg-transparent btn m-0 dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">Welcome, '.$_SESSION['name'].'</a>
										<div class="dropdown-menu" id="logout-menu">
											<a type="button" class="btn btn-default bg-light py-1 my-0 mx-auto" href="./php/logout.php" name="logout">Log-out</a>
										</div>
										</div>';
							}else{
								echo '<div class="dropdown m-0 p-1" id="subnav">
								<a href="#" class="user-account for-buy bg-transparent btn dropdown-toggle m-0" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" data-bs-offset="60,20"><i class="icon icon-user"></i><span> Log in</span></a>
								<form action="php/login.php" method="POST" class="dropdown-menu px-3 dropdown-menu-end" style="width: 200% !important;" id="login">
									<h3 class="text-center p-0 m-1">Log-In</h3>
									<div class="mb-1">
										<label for="exampleDropdownFormEmail2" class="form-label">Username</label>
										<input name="username" class="form-control" id="exampleDropdownFormEmail2" placeholder="Enter your username" required>
									</div>
									<div class="mb-1">
   	 									<label for="exampleDropdownFormPassword2" class="form-label">Password</label>
    									<input name="password" type="password" class="form-control" id="exampleDropdownFormPassword2" placeholder="Password" required>
									</div>
									<div class="mb-1">
										<div class="form-check align-middle">
											<input type="checkbox" class="form-check-input my-1" id="dropdownCheck2">
											<label class="form-check-label align-top p-0" for="dropdownCheck2">
											Remember me
											</label>
										</div>
									</div>
									<div class="align-center d-flex flex-column">
										<button type="submit" class="btn btn-default bg-light py-1 my-0 mx-auto" style="font-size: small;" name="user" onclick="changeAction(\'php/login.php\')">Log in as user</button>
										<button type="submit" class="btn btn-default bg-light py-1 my-0 mx-auto" style="font-size: small;" name="admin" onclick="changeAction(\'php/login.php\')">Log in as admin</button>
										<a href="#" style="font-size: 14px;" onclick="window.location.href=\'php/signup.php\'">Don\'t have an account? Sign up now.</a>
									</div>
								</form>
							</div>';
							}

							echo '<div class="dropdown m-0 p-1" id="subnav">
								<a href="#" class="cart for-buy btn bg-transparent dropdown-toggle m-0" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" data-bs-offset="10,20"><i class="icon icon-clipboard"></i><span> To Rent: 0</span></a>
								<form class="dropdown-menu px-3 dropdown-menu-end" style="width: 200%;">
									<h3 class="text-center">Books to be rented:</h3>
									<div class="align-center">
										<h1>None</h1>
									</div>
									<div class="align-center">
										<button type="submit" class="btn py-1 text-center">Check Out</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
</div>
';
?>