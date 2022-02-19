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
	<header>
		<h2>ToDo List</h2>
		<form method="POST" class="todo-form" aria-label="todo-input">			
			<input type="text" id="title" class="todo-input" aria-label="todo-input" 
			placeholder="Title" aria-placeholder="new-todo..." required>
			
			<input type="text" id="description" class="tododesc-input" aria-label="tododesc-input" 
			placeholder="Description" aria-placeholder="new-desc..." required>
			
			<button type="submit" id="addBtn" name="submit" value="submit" class="submit-btn">Add Item</button>
	</header>
	<main class="todo-container">
		<ul class="todo-list" id="tasks">
			
		</ul>
	</main>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>	
	<script>
		$(document).ready(function() {
			// Show Items
			function loadTasks() {
				$.ajax({
					url: "detail.php",
					type: "POST",
					success: function(data) {
						$("#tasks").html(data);
					}
				});
			}

			loadTasks();


			// Add Task
			$("#addBtn").on("click", function(e) {
				e.preventDefault();

				var title = $("#title").val();
				var description = $("#description").val();

				$.ajax({
					url: "create.php",
					type: "POST",
					data: {title: title, description: description},
					success: function(data) {
						loadTasks();
						$("#title").val('');
						$("#description").val('');
						if (data == 0) {
							alert("Something went wrong. Please try again.");
						}
					}
				});
			});

			// Delete Items
			$(document).on("click", "#removeBtn", function(e) {
				e.preventDefault();
				var itemnum = $(this).data('itemnum');

				$.ajax({
					url: "delete.php",
					type: "POST",
					data: {itemnum: itemnum},
					success: function(data) {
						loadTasks();
						if(data == 0) {
							alert("Something went wrong. Please try again.");
						}
					}
				});
			});
		});
	</script>
</body>
</html>