<?php
//PDO Connection
require_once "PDO.php";

//Prepare and Execute SQL
$stmt = $pdo -> prepare("SELECT * FROM movies WHERE movieID BETWEEN 1 AND 4");
$stmt -> execute();

//Set the resulting array to associative
while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
	
	echo '<div class="col-md-6 m-auto p-auto" >';
	// Show movie poster
	echo '<img src="image/' . $row['movieID'] . '.jpg" alt="movie poster" width="45%">';
	// Show movie info
	echo '<ul class="list-group mb-5" style="width:50%;float:right;">';
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