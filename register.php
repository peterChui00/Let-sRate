<?php
session_start();
if(!isset($_SESSION['username'])){
	session_unset();
	session_destroy();
}
?>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Let'sRate</title>

  </head>

	
	
<body class="bg-light">
	 <!-- Navigation Bar -->
	  <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
		  <!-- Brand Logo-->
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
		  <span class="navbar-toggler-icon"></span>
		  </button>
          <a class="navbar-brand" href="#">
			  Let'sRate&#x2B50;
			  <img src="image/account_icon.png">
			  <?php
			  //Show username after user logged in
			  if(isset($_SESSION['username'])){
				  echo '<i>'.$_SESSION['username'].' </i>';
			  }
			  ?>
		  </a>
		  
		 <!-- Navigation buttons Container -->
		  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
	          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
				  <li class="nav-item">
				      <a class="nav-link" href="index.php">Home</a>
				  </li>
				  <li class="nav-item">
                      <a class="nav-link" href="all_movies.php">All Movies</a>
                  </li>
				  <li class="nav-item active">
                      <a class="nav-link" href="register.php">Register<span class="sr-only">(current)</span></a>
                  </li>
				  <li class="nav-item">
                      <a class="nav-link" href="login.php">Login</a>
                  </li>
				  <?php
				  //Show logout button if logged in
			      if(isset($_SESSION['username'])){
					  echo '<li class="nav-item">
                                <a class="nav-link" href="logout.php">Logout</a>
                             </li>';
			      }
			      ?>
			  </ul>
			  
			  <!-- Search Bar -->
			  <form class="form-inline" method="post" action="search_result.php">
                  <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
			  </form>
		  </div>
	  </nav>
	
	<!-- Register form -->
	<form class="needs-validation m-5" method="post" action="adduser.php" novalidate>
	  <div class="form-row">
		<div class="col-md-5 mb-3 ml-auto mr-auto">
		  <label for="username">Username</label>
		  <div class="input-group">
			<input type="text" name="username" class="form-control" id="username" placeholder="Username" aria-describedby="inputGroupPrepend" required>
		  </div>
		</div>
	  </div>

	  <div class="form-row">
		<div class="col-md-5 mb-3 ml-auto mr-auto">
		  <label for="password">Password</label>
		  <input type="text" name="password" class="form-control" id="password" placeholder="Password" required>
		</div>
	  </div>

	  <div class="form-row">
		<div class="col-md-5 mb-3 ml-auto mr-auto">
		  <label for="cpassword">Confirm Password</label>
		  <input type="text" name="cpassword" class="form-control" id="cpassword" placeholder="Confirm password" required>

		</div>
	  </div>

	  <div class="form-row">
		<div class="col-md-5 mb-3 ml-auto mr-auto">
		  <label for="email">Email</label>
		  <input type="text" name="email" class="form-control" id="email" placeholder="Email" required>
		</div>
	  </div>

	 <div class="col-md-5 mb-3 ml-auto mr-auto">
		  <button class="btn btn-primary ml-4" style="width: 40%" type="submit" name="submit">Submit form</button>

		 <button class="btn btn-primary ml-md-4" style="width: 40%" type="reset" name="reset">Reset form</button>
	 </div>
	</form>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>