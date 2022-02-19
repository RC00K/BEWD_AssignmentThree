<?php 
include 'db_connect.php';

$itemnum = $_POST['itemnum'];

$query = "DELETE FROM todoitems WHERE ItemNum = '$itemnum'";
$result = mysqli_query($connect, $query);


if($result) {
	echo 1;
} else {
	echo 0;
}
?>