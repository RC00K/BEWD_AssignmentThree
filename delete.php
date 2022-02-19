<?php 
require_once('db_connect.php');

$itemnum = filter_input(INPUT_POST, 'ItemNum', FILTER_VALIDATE_INT);

if(isset($_POST['ItemNum'])) {
	$itemnum = $_POST['ItemNum'];
	db();
	global $link;
	$query = "DELETE FROM todoitems WHERE ItemNum = '$itemnum'";
	$delete = mysqli_query($link, $query);
	if($delete) {
		'Item successfully deleted';
	}
}