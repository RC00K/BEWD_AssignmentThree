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
		<button type="submit" name="submit" value="submit" class="submit-btn" onclick="location.href='create.php'">New Item</button>
	</header>
	<?php 
		db();
		global $link;
		$query = "SELECT ItemNum, Title, Description FROM todoitems ORDER BY ItemNum ASC";
		$result = mysqli_query($link, $query);
		
		if(mysqli_num_rows($result) >= 1){
    		while($row = mysqli_fetch_array($result)){
        		$itemnum = $row['ItemNum'];
        		$title = $row['Title'];
        		$description = $row['Description'];
	?>
	<main class="todo-container">
		<ul class="todo-list" id="all-todos">
			<div class="todo">
				<li class="todo-item">
					<h1><?php echo $title ?></h1>
        			<p><?php echo $description ?></p>
				</li>
				<button aria-label="close-button" class="close-btn" value="ItemNum" method="POST" action="delete.php"><span class="x">✕</span></button>
			</div>
		</ul>
	<script>
		const allTodo = document.getElementById('all-todos')
		new Sortable(allTodo, {
			animation: 200
		})

		$(document).ready(function(){
            $('.close-btn').click(function(){
                const id = $(this).attr('id');
                
                $.post("delete.php", 
                    {
                        id: id
                    },
                    (data)  => {
                        if(data){
                            $(this).parent().hide(600);
                    }
                }
            );
        });
	</script>
	<script src="js/script.js"></script>
	</main>
	<?php 
  		}
  	}
  	?>
</body>
</html>