<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['type_id'];
		$name = $_POST['type_name'];

		$sql = "UPDATE item_types SET type_name = '$name' WHERE type_id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Item Type updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:type.php');

?>