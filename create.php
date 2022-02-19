<?php
include 'db_connect.php';

$title = $_POST['title'];
$description = $_POST['description'];

$query = "INSERT INTO todoitems(Title, Description) VALUES ('$title', '$description')";
$result = mysqli_query($connect, $query);

if($result) {
	echo 1;
} else {
	echo 0;
}
?>
