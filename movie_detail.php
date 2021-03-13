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
	<link rel="stylesheet" href="css/rating.css">
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
			  if(isset($_SESSION['username'])){
				  echo '<i>'.$_SESSION['username'].' </i>';
			  }
			  ?>
		  </a>
		  
		  <!-- Navigation buttons Container -->
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
	
	  <div class="container-fluid">
		  <div class="row">
			  <div class="col-md-12 mt-3 mb-3">
				  <h1 class=""></h1>
			  </div>
		  </div>
	  </div>
	
      <div class="container-fluid">
	      <div class="row">
			<?php
			//PDO Connection
			require_once "PDO.php";

			//Prepare and Execute SQL
			$movieid = $_POST['movieid'];
			$sql = 'SELECT * FROM movies WHERE movieID="'.$movieid.'"';
			$stmt = $pdo -> prepare($sql);
			$stmt -> execute();

			//Set the resulting array to associative
			while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
				//Show movie details
				echo '<div class="col-md-6 m-auto p-auto">';
				//show movie poster
				echo '<img src="image/' . $row['movieID'] . '.jpg" alt="movie poster" width="45%">';
				//show movie info
				echo '<ul class="list-group  mb-3 bg-light" style="width:50%;float:right;">';
				echo '<li class="list-group-item list-group-item-secondary">'.'Title: '.$row['title'].'</li>';
				echo '<li class="list-group-item list-group-item-secondary">'.'Genre: '.$row['genre'].'</li>';
				echo '<li class="list-group-item list-group-item-secondary">'.'Director: '.$row['director'].'</li>';
				echo '<li class="list-group-item list-group-item-secondary">'.'Starring: '.$row['starring'].'</li>';
				echo '<li class="list-group-item list-group-item-secondary">'.'Language: '.$row['language'].'</li>';
				echo '<li class="list-group-item list-group-item-secondary">'.'Running time: '.$row['running_time'].'</li>';
				echo '<li class="list-group-item list-group-item-secondary">'.'Release date: '.$row['release_date'].'</li>';
				echo '</ul>';
				echo '</div>';
				echo '<div class="col-md-6">';
				echo '<div class="card" style="margin: auto;">';
				echo '<div class="card-body bg-info text-white">';
				echo '<h5 class="card-title">Description</h5>';
				echo '<p class="card-text">'.$row['description'].'</p>';
				echo '</div>';
				echo '</div>';
				echo '</div>';
			}
			?>
		  </div>
		  
              <!-- Average rating-->
			  <div class="col-md-6 card bg-success text-white mt-3 mb-4">
				  <div class="card-body ">
					  <h5 class="card-title">Average rating:   
					  <?php
					  //Prepare and Execute SQL
						$sql = 'SELECT AVG(rating) FROM ratings WHERE movieID="'.$movieid.'"';
						$stmt = $pdo->prepare($sql);
						$stmt->execute();
						$row = $stmt->fetch();
						if(isset($row['AVG(rating)'])) {
							echo $row['AVG(rating)'].' / 5';
						}else{
							echo 'No rating';
						}
					  ?>
					  </h5>
					  <?php
					  //show rate and comment function if user logged in and have not submited the same form
					  if(isset($_SESSION['username'])){
						  $sql = 'SELECT ratings.userID FROM users, movies, ratings WHERE users.userID=ratings.userID AND movies.movieID=ratings.movieID AND movies.movieID='.$movieid.' AND users.username="'.$_SESSION['username'].'"';
						  $stmt = $pdo->prepare($sql);
						  $stmt->execute();
						  $row = $stmt->fetch();
						  if(isset($row['userID'])) {
							  echo 'You have already rated/commented.';
						  }else{
							  echo '<h5 class="card-title mt-5">Rate and Comment</h5>';
							  echo '<form  method="post" action="rate.php">';
							  // star rating
							  echo '
							      <div class="rating" style="font-size: 40px;">
									<input id="star5" name="star" type="radio" value="5" class="radio-btn hide" />
									<label for="star5" >☆</label>
									<input id="star4" name="star" type="radio" value="4" class="radio-btn hide" />
									<label for="star4" >☆</label>
									<input id="star3" name="star" type="radio" value="3" class="radio-btn hide" />
									<label for="star3" >☆</label>
									<input id="star2" name="star" type="radio" value="2" class="radio-btn hide" />
									<label for="star2" >☆</label>
									<input id="star1" name="star" type="radio" value="1" class="radio-btn hide" />
									<label for="star1" >☆</label>
									<div class="clear"></div>
								 </div>';
							  // pass movieid
							  echo '<input type="hidden" name="movieid" value="'.$movieid.'">';
							  echo'<div>';
							  //movie comment 
							  echo'<textarea name="comment" rows="6" cols="50" class="form-control mt-3 mb-3"></textarea>';
							  echo' </div>';
							  echo '
							  <button class="btn btn-primary ml-4" style="width: 40%" type="submit" name="submit">Submit</button>
							  <button class="btn btn-primary ml-md-4" style="width: 40%" type="reset" name="reset">Reset</button>';
							  echo '</form>';
						  }
					  }
					  ?>
					  <p class="card-text"></p>
			  </div>
		  </div>
		  <!-- show all movie comments -->
		  <div class="col-md-6 card bg-warning mt-3 mb-4">
				  <div class="card-body" style="background-color: #FFF7773">
					  <h5 class="card-title">Comment:</h5>
					  <?php
					  $sql = 'SELECT r.comment, u.username FROM users u, ratings r WHERE u.userID=r.userID AND movieID='.$movieid;
					  $stmt = $pdo -> prepare($sql);
					  $stmt -> execute();
					  $row = $stmt -> fetch();
					  if(isset($row['comment'])){
						  $stmt = $pdo -> prepare($sql);
					      $stmt -> execute();
						  while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
						      echo '<ul class="list-unstyled">';
							  echo '<li class="media">';
							  echo '<img src="image/account_icon.png" width="36px" class="mr-3" alt="icon of user">';
							  echo '<div class="media-body">';
							  echo '<h5 class="mt-0 mb-1">';
							  echo $row['username'].'</h5>';
							  echo $row['comment'];
							  echo '</div>';
							  echo '</li></ul>';
					      }
					  }else{
						  echo '<p class="card-text">No comment</p>';
					  }
					  
					  ?>
			      </div>   
	  </div></div>
	

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>