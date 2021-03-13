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

<body>
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
		  
		  <!-- Links Container -->
		  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
	          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
				  <li class="nav-item">
				      <a class="nav-link" href="index.php">Home </a>
				  </li>
				  <li class="nav-item active">
                      <a class="nav-link" href="all_movies.php">All Movies<span class="sr-only">(current)</span></a>
                  </li>
				  <li class="nav-item">
                      <a class="nav-link" href="register.php">Register</a>
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
	
	<!-- List of Movies container -->
	  <div class="container-fluid bg-light">
		  <div class="row">
			  <div class="col-md-12 mt-3 mb-3">
				  <h1 class="display-4">List of Movies</h1>
			  </div>
		  
   
<?php
//PDO Connection
require_once "PDO.php";

//Prepare and Execute SQL
$stmt = $pdo -> prepare("SELECT * FROM movies");
$stmt -> execute();

//Set the resulting array to associative
while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
	echo '<div class="col-md-6 m-auto p-auto">';
	// Show movie poster
	echo '<img src="image/' . $row['movieID'] . '.jpg" alt="movie poster" width="45%">';
	// Show movie info
	echo '<ul class="list-group  mb-5" style="width:50%;float:right;">';
	echo '<li class="list-group-item list-group-item-secondary">'.'Title: '.$row['title'].'</li>';
	echo '<li class="list-group-item list-group-item-secondary">'.'Genre: '.$row['genre'].'</li>';
	echo '<li class="list-group-item list-group-item-secondary">'.'Director: '.$row['director'].'</li>';
	echo '<li class="list-group-item list-group-item-secondary">'.'Starring: '.$row['starring'].'</li>';
	echo '<li class="list-group-item list-group-item-secondary">'.'Language: '.$row['language'].'</li>';
	echo '<li class="list-group-item list-group-item-secondary">'.'Release date: '.$row['release_date'].'</li>';
	// View/Rate button
	echo '<li class="list-group-item list-group-item-secondary">';
	echo '<form method="post" action="movie_detail.php">';
	echo '<input type="hidden" name="movieid" value="'.$row['movieID'].'">';
	echo '<button class="btn btn-primary ml-4" style="width:80%" type="submit" name="submit">View / Rate</button></form>';
	echo '</li>';
	echo '</ul>';
	echo '</div>';
}
?>
		  </div>
	  </div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>