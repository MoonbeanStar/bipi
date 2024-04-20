<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$type_name = $_POST['type_name'];
		
		$sql = "INSERT INTO item_types (type_name) VALUES ('$type_name')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Item Type added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: type.php');

?>