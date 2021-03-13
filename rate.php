<?php
session_start();
//PDO Connection
require_once "PDO.php";

//Prepare and Execute SQL
//Get user id
$username = $_SESSION['username'];
$sql = "SELECT userID FROM users WHERE username=:username";
$stmt = $pdo->prepare($sql);
$stmt->execute(array(":username"=>$username));
$row = $stmt->fetch();
$userid = $row['userID'];

//insert rating and comment record
$movieID = $_POST['movieid'];
$star = $_POST['star'];
$comment = $_POST['comment'];

$sql = "INSERT into ratings (userID, movieID, rating, comment) VALUES (:userID, :movieID, :rating, :comment)";
$stmt = $pdo -> prepare($sql);
$row = $stmt -> execute(array(
	":userID" => $userid,
	":movieID" => $movieID,
	":rating" => $star,
    ":comment" => $comment
    ));
//refresh
header('Location: all_movies.php');
?>