<?php
$servername = 'localhost';
$username = 'root';
$password = '';

// Create connection to MySQL
try {
	$pdo = new PDO("mysql:host=$servername;dbname=dit4202_assignment", $username, $password);
	// Set the PDO error mode to exception
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>