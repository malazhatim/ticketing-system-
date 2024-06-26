<?php
$servername = "localhost";
$username1 = "root";
$password1 = "";
$conn = new mysqli($servername, $username1, $password1, "ticketing");
mysqli_query($conn, "SET NAMES 'utf8'");
mysqli_query($conn, 'SET CHARACTER SET utf8');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
