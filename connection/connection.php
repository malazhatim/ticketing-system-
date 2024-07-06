<?php
$servername = "localhost";//add the database server
$username1 = "id22394237_malaz"; //add the database user
$password1 = "Malazhatim123$";// add database password
$conn = new mysqli($servername, $username1, $password1, "id22394237_ticketing_alx"); // connect to the database
mysqli_query($conn, "SET NAMES 'utf8'");
mysqli_query($conn, 'SET CHARACTER SET utf8');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>