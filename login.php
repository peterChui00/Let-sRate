<?php
    $error_message = '';
	// check if the form is submitted
	if (isset($_POST['login'])) {		
		$uname = "";
	    $pw = "";
		$id = "";
		$username_error = false;
	    $password_error = false;
		$username_exist = false;
		
		if (isset($_POST["username"]) && isset($_POST["password"])) {
		$uname = $_POST['username'];
		$pw = $_POST['password'];
	    }
		if ($uname==""){
			$error_message .= "ERROR: username is empty<br>";
			$username_error = true;
		}
		if ($pw==""){
			$error_message .= "ERROR: password is empty<br>";
			$password_error = true;
		}
		
		if(!$username_error && !$password_error){
			//check username_exist
			require_once('PDO.php');
			$check_sql = "SELECT username FROM users WHERE username=:username";
			$check_stm = $pdo->prepare($check_sql);
			$check_res = $check_stm->execute(array(":username"=>$uname));
			$check_row = $check_stm->fetch();
			if(!$check_row) {
				$error_message .= "ERROR: username does not exists, please check or register.<br>";
			    
			} else {
				$username_exist = true;
			}
			
			if($username_exist){
				//check password
				$check_sql = "SELECT password FROM users WHERE username=:username";
				$check_stm = $pdo->prepare($check_sql);
				$check_res = $check_stm->execute(array(":username"=>$uname));
				$check_row = $check_stm->fetch();
				$db_password = $check_row['password'];
				if ($check_row && password_verify($pw, $db_password)){
					// login successful
					session_start();
					//register the username as a session variable
					$_SESSION['username'] = $uname;

					header('Location: index.php');
				}else{
					// login error
					$error_message .= "ERROR: Wrong password!<br>";
				}
			}
		}
	}
    
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
				  <li class="nav-item">
                      <a class="nav-link" href="register.php">Register</a>
                  </li>
				  <li class="nav-item active">
                      <a class="nav-link" href="login.php">Login<span class="sr-only">(current)</span></a>
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
	
	<?php
	echo $error_message;
	?>
	<!-- Show Login form-->
	<form class="needs-validation m-5" method="post" action="login.php">

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

	 <div class="col-md-5 mb-3 ml-auto mr-auto">
		 <?php
		 // Disable login button if user logged in
		 if(isset($_SESSION['username'])){
			echo '<button class="btn btn-primary ml-4 disabled" style="width: 40%" type="button" name="login">Login</button>';
		 }else{
			echo '<button class="btn btn-primary ml-4" style="width: 40%" type="submit" name="login">Login</button>';
		 }
		 ?>
		 <button class="btn btn-primary ml-md-4" style="width: 40%" type="reset" name="reset">Reset</button>
	 </div>
	</form>
</body>
</html>