<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="application-name" content="Movies library">
        <meta name="description" content="A simple movies browsing platform.">
        <meta name="keywords" content="movies, movie database">

        <link href="\movies-library\fonts\font-awesome\css\fontawesome-all.min.css" rel="stylesheet">
        <link href="\movies-library\styles\bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="\movies-library\styles\main.css">
        <link rel="icon" type="image/png" href="\movies-library\images\favicon.png">

        <title>Movies library</title>
    </head>

    <body>
        <header>
        	<div class='modal fade' id='errorModal' tabindex='-1' role='dialog'>
			  <div class='modal-dialog' role='document'>
					<div class='modal-content'>
						<div class='modal-header'>
							<h5 class='modal-title text-danger'>Error</h5>
							<button type='button' class='close text-danger' data-dismiss='modal' aria-label='Close'>
							 	<span aria-hidden='true'>&times;</span>
							</button>
						</div>
						<div class='modal-body'>
							<p></p>
						</div>
						<div class='modal-footer'>
							<button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
						</div>
					</div>
				</div>
			</div>
        	<div class='modal fade' id='loginFailed' tabindex='-1' role='dialog'>
			  <div class='modal-dialog' role='document'>
					<div class='modal-content'>
						<div class='modal-header'>
							<h5 class='modal-title text-danger'>Login failed</h5>
							<button type='button' class='close text-danger' data-dismiss='modal' aria-label='Close'>
							 	<span aria-hidden='true'>&times;</span>
							</button>
						</div>
						<div class='modal-body'>
							<p>Username or password was incorrect!</p>
						</div>
						<div class='modal-footer'>
							<button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
						</div>
					</div>
				</div>
			</div>
			<div class='modal fade' id='movieModal' tabindex='-1' role='dialog'>
			  <div class='modal-dialog' role='document'>
					<div class='modal-content'>
						<div class='modal-header'>
							<h5 class='modal-title text-success'>Notice</h5>
							<button type='button' class='close text-success' data-dismiss='modal' aria-label='Close'>
							 	<span aria-hidden='true'>&times;</span>
							</button>
						</div>
						<div class='modal-body'>
							<p>Username or password was incorrect!</p>
						</div>
						<div class='modal-footer'>
							<button type='button' class='btn btn-success' data-dismiss='modal'>Close</button>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="loginModalLabel"><i class="fas fa-sign-in-alt"></i> Login</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							  <span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form method="post" action="\movies-library\includes\userLogin.php">
							<div class="modal-body">
									<div class="form-group">
										<label for="login-username" class="col-form-label">Username</label>
										<input type="text" class="form-control" name="username" placeholder="Input a valid username" maxlength="20" id="login-username" required>
									</div>
									<div class="form-group">
										<label for="login-password" class="col-form-label">Password</label>
										<input type="password" class="form-control" name="password" placeholder="Input a valid username" maxlength="15" minlength="5" id="login-password" required>
									</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<input type="submit" class="btn btn-primary" value="Login">
							</div>
						</form>
					</div>
				</div>
			</div>
       		<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="signupModalLabel"><i class="fas fa-user-plus"></i> Sign-up</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							  <span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form method="post" action="\movies-library\includes\userRegistration.php">
							<div class="modal-body">
									<div class="form-group">
										<label for="signin-username" class="col-form-label">Username</label>
										<input type="text" class="form-control" name="username" placeholder="Input a valid username" maxlength="20" id="signin-username" oninput="checkusername()" required>
                                        <span id="usernamestatus"></span>
									</div>
									<div class="form-group">
										<label for="passInput" class="col-form-label">Password</label>
										<input type="password" id="passInput" name="password" class="form-control" placeholder="Input a valid password" maxlength="15" minlength="5" required>
									</div>
									<div class="form-group">
										<label for="signin-password" class="col-form-label">Password confirmation</label>
										<input type="password" id="pConfInput" class="form-control" placeholder="Re-enter your password" maxlength="15" minlength="5" id="signin-password" required>
									</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<input type="submit" id="subBtn" class="btn btn-primary" value="Sign-up">
							</div>
						</form>
					</div>
				</div>
			</div>

        	<div class="jumbotron text-center">
        		<img src="\movies-library\images\logo.svg" class="mx-auto d-block" style="width: 150px;" alt="Logo">
        		<h1 class="display-4">The movie library</h1>
        		<p class="text-secondary">The future of looking up movies</p>
        	</div>

        	<nav id="navbar" class="navbar navbar-expand-lg navbar-dark bg-dark">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNavDropdown">
					<ul class="navbar-nav">
						<li class="nav-item">
							<a class="nav-link" href="\movies-library\index.php">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="\movies-library\pages\search.php?searchQuery=&filterCategory=">All movies</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						  Categories
						</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
								<a class="dropdown-item" href="\movies-library\pages\search.php?searchQuery=&filterCategory=Action">Action</a>
								<a class="dropdown-item" href="\movies-library\pages\search.php?searchQuery=&filterCategory=Adventure">Adventure</a>
								<a class="dropdown-item" href="\movies-library\pages\search.php?searchQuery=&filterCategory=Animation">Animation</a>
								<a class="dropdown-item" href="\movies-library\pages\search.php?searchQuery=&filterCategory=Comedy">Comedy</a>
								<a class="dropdown-item" href="\movies-library\pages\search.php?searchQuery=&filterCategory=Crime">Crime</a>
								<a class="dropdown-item" href="\movies-library\pages\search.php?searchQuery=&filterCategory=Documentary">Documentary</a>
								<a class="dropdown-item" href="\movies-library\pages\search.php?searchQuery=&filterCategory=Drama">Drama</a>
								<a class="dropdown-item" href="\movies-library\pages\search.php?searchQuery=&filterCategory=Fantasy">Fantasy</a>
								<a class="dropdown-item" href="\movies-library\pages\search.php?searchQuery=&filterCategory=Family">Family</a>
								<a class="dropdown-item" href="\movies-library\pages\search.php?searchQuery=&filterCategory=History">History</a>
								<a class="dropdown-item" href="\movies-library\pages\search.php?searchQuery=&filterCategory=Horror">Horror</a>
								<a class="dropdown-item" href="\movies-library\pages\search.php?searchQuery=&filterCategory=Music">Music</a>
								<a class="dropdown-item" href="\movies-library\pages\search.php?searchQuery=&filterCategory=Mystery">Mystery</a>
                                <a class="dropdown-item" href="\movies-library\pages\search.php?searchQuery=&filterCategory=Romance">Romance</a>
								<a class="dropdown-item" href="\movies-library\pages\search.php?searchQuery=&filterCategory=Science-Fiction">Science-Fiction</a>
								<a class="dropdown-item" href="\movies-library\pages\search.php?searchQuery=&filterCategory=Romance">Romance</a>
								<a class="dropdown-item" href="\movies-library\pages\search.php?searchQuery=&filterCategory=Thriller">Thriller</a>
								<a class="dropdown-item" href="\movies-library\pages\search.php?searchQuery=&filterCategory=TV-Movie">TV-Movie</a>
								<a class="dropdown-item" href="\movies-library\pages\search.php?searchQuery=&filterCategory=War">War</a>
								<a class="dropdown-item" href="\movies-library\pages\search.php?searchQuery=&filterCategory=Western">Western</a>
							</div>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="javascript:void(0)" id="aboutUs">About us</a>
						</li>
						<form method="get" action="\movies-library\pages\search.php" class="form-inline ml-4">
							<div class="btn-group mr-1">
								<button style="min-width:100px;" id="typeDD" type="button" class="btn btn-dark"><i class="fa fa-search"></i> </button>
							</div>
							<input class="form-control" type="search" style="width:550px;" placeholder="Search for a movie..." name="searchQuery" aria-label="Search" maxlength="60" required>
						</form>
					</ul>
				</div>
				<?php if($_SESSION['moderator'] > 0): ?>
					<form class="form-inline my-2 my-lg-0 mr-2">
						<div class="btn-group">
							<button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-cog fa-lg"></i> Settings
							</button>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="\movies-library\pages\users.php">Users</a>
								<a class="dropdown-item" href="\movies-library\pages\movies.php">Movies</a>
							</div>
						</div>
					</form>
				<?php endif; ?>
				<?php if($_SESSION['logged-in'] == false): ?>
					<form class="form-inline my-2 my-lg-0">
						<input class="btn btn-light mr-sm-2" data-toggle="modal" data-target="#signupModal" type="button" value="Sign up">
						<input class="btn btn-outline-light" data-toggle="modal" data-target="#loginModal" type="button" value="Login">
					</form>
				<?php else: ?>
					<form class="form-inline my-2 my-lg-0">
						<div class="btn-group">
							<button type="button" id="dropdown-username" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-user fa-lg"></i> <?php echo $_SESSION['username']; ?>
							</button>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="\movies-library\pages\library.php">My library</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="\movies-library\includes\userLogout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
							</div>
						</div>
					</form>
				<?php endif; ?>
			</nav>
        </header>