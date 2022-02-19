<?php 
include 'db_connect.php';

$query = "SELECT * FROM `todoitems` ORDER BY `ItemNum` ASC";
$result = mysqli_query($connect, $query);


if(mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)) {

?>

<div class="todo">
	<li class="todo-item">
		<?php echo $row['Title'] ?>
		<p>
			<?php echo $row['Description'] ?>
		</p>
	</li>
	<button id="removeBtn" aria-label="close-button" class="close-btn" data-id="<?php echo $row['ItemNum']; ?>"><span class="x">✕</span></button>
</div>

<?php 
	}
	echo '<div class="pending-text">YOU HAVE ' . mysqli_num_rows($result) . ' PENDING TASK</div>';
} else {
	echo '<li class="pending-text"><span class="text">NO TASK ON TODO LIST</span></li>';
}
?>