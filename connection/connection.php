<?php
$servername = "localhost";
$username1 = "id22394237_malaz";
$password1 = "Malazhatim123$";
$conn = new mysqli($servername, $username1, $password1, "id22394237_ticketing_alx");
mysqli_query($conn, "SET NAMES 'utf8'");
mysqli_query($conn, 'SET CHARACTER SET utf8');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>