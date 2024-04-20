<?php 
	include 'includes/session.php';

	if(isset($_POST['category_id'])){
		$id = $_POST['id'];
		$sql = "SELECT * FROM category WHERE id = '$id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>