<?php 
	include 'includes/session.php';

	if(isset($_POST['type_id'])){
		$type_id = $_POST['type_id'];
		$sql = "SELECT * FROM item_types WHERE type_id = '$type_id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>