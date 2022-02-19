<?php
require_once('db_connect.php');

$itemnum = filter_input(INPUT_POST, 'ItemNum', FILTER_VALIDATE_INT);
$title = filter_input(INPUT_POST, 'Title', FILTER_UNSAFE_RAW);
$description = filter_input(INPUT_POST, 'Description', FILTER_UNSAFE_RAW);

if(isset($_POST['submit'])) {
	$title = $_POST['Title'];
	$description = $_POST['Description'];

	function check($string) {
		$string = htmlspecialchars($string);
		$string = strip_tags($string);
		$string = trim($string);
		$string = stripslashes($string);
		return $string;
	}

	if(empty($title)) {
		$error = true;
		$titleErrorMsg = "Title cannot be empty";
	}

	if(empty($description)) {
		$error = true;
		$descriptionErrorMsg = "Description cannot be empty";
	}

	db();
	global $link;
	$query = "INSERT INTO todoitems(Title, Description) VALUES ('$title', '$description')";
	$insertTodo = mysqli_query($link, $query);
	if($insertTodo) {
		'You added a new item';
	} else {
		mysqli_error($link);
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="presconnec noopener" href="https://fonts.gstatic.com">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.10.2/Sortable.min.js"></script>
	<script src="https://use.fontawesome.com/289831cdda.js"></script>
	<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&display=swap" rel="stylesheet preload noopener" as="font">
	<link rel="stylesheet" href="css/main.css">
	<title>ToDo List Assignment</title>
</head>

<?php  
require_once('db_connect.php');

$itemnum = filter_input(INPUT_POST, 'ItemNum', FILTER_VALIDATE_INT);
$title = filter_input(INPUT_POST, 'Title', FILTER_UNSAFE_RAW);
$description = filter_input(INPUT_POST, 'Description', FILTER_UNSAFE_RAW);
?>

<body>
	<div class="container" id="container">
		<h2>ToDo List</h2>
		<div class="form-container new-container">
		<form method="POST" action="create.php" class="todo-form" aria-label="todo-input">
			<?php if(isset($_GET['mess']) && $_GET['mess'] == 'error') { ?>
			
			<input type="text" name="Title" class="todo-input" aria-label="todo-input" 
			placeholder="Title" aria-placeholder="new-todo..." required>
			
			<input type="text" name="Description" class="tododesc-input" aria-label="tododesc-input" 
			placeholder="Description" aria-placeholder="new-desc..." required>
			
			<button type="submit" name="submit" value="submit" class="submit-btn">Add Item</button>
			<button type="submit" name="submit" value="submit" class="submit-btn" onclick="location.href='index.php'">List</button>
			<?php } else { ?>
			
			<input type="text" name="Title" class="todo-input" aria-label="todo-input" 
			placeholder="Title" aria-placeholder="new-todo..." required>
			
			<input type="text" name="Description" class="tododesc-input" aria-label="tododesc-input" 
			placeholder="Description" aria-placeholder="new-desc..." required>
			<div class="buttons">
			<button type="submit" name="submit" value="submit" class="submit-btn">Add Item</button>
			<button type="submit" name="submit" value="submit" class="submit-btn" onclick="location.href='index.php'">List</button>
			</div>
			<?php } ?>
		</form>
	</div>
	</div>
</body>
</html>