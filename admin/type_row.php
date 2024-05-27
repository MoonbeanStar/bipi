<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT * FROM type WHERE id = '$id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		// Fetch catid from the row and include it in the array
		$catid = $row['catid'];
		$row['catid'] = $catid;

		echo json_encode($row);
	}
?>
