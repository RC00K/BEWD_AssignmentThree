<?php 
$server = "localhost";
$username = "root";
$password = "";
$database = "todolist";

$connect = mysqli_connect($server, $username, $password, $database);

if(!$connect) {
    die("<script>alert('Connection Failed')</script>");
}
?>