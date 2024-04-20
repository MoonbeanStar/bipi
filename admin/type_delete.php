<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$type_id = $_POST['type_id'];
		$sql = "DELETE FROM item_types WHERE type_id = '$type_id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Item Type deleted successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	header('location: type.php');
	
?>