<?php
$servername = "localhost";
$database = "management";
$username = "root";
$password = "admin123";
 
// Create connection
 
$conn = mysqli_connect($servername, $username, $password, $database);
 
// Check connection
 
if (!$conn) {
 
    die("Connection failed: " . mysqli_connect_error());
 
}
?>