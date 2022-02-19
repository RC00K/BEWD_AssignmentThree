<?php 
require_once('db_connect.php');

if(isset($_GET['ItemNum'])) {
	$itemnum = $_GET['ItemNum'];
	db();
	global $link;
	$query = "SELECT Title, Description, date FROM todoitems WHERE ItemNum = '$itemnum'";
	$result = mysqli_query($link, $query);
	if(mysqli_num_rows($result)==1) {
		$row = mysqli_fetch_array($result);
		if($row) {
			$title = $row['Title'];
			$description = $row['Description'];

			echo "
			<h1>$title</h1>
			<p>$description</p>
			";
		} else {

		}
	}
}