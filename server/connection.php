<?php
$servername = "localhost:3308";
$database = "php_project";
$username = "root";
$password = "";
$conn = mysqli_connect($servername, $username, $password, $database);
// $conn = mysqli_connect("localhost","root",'',"php_project") or die("Couldn't connect to database");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";

?>