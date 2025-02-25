<?php
$servername = "localhost";
$username = "root";
$password = "";
$databasename = "crud";

$conn = mysqli_connect($servername, $username, $password, $databasename);

if (!$conn) {
    die("connection failed :  " . mysqli_connect_error());
}

?>


<!-- shor cut connection -->
<!-- $conn = mysqli_connect("localhost", "root", "", "crud");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} -->