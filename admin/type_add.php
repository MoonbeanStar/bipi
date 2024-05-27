<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$name = $_POST['name'];
		$catid = isset($_POST['catid']) ? $_POST['catid'] : 0; // Assuming 0 as default if not provided in the form
		
		$sql = "INSERT INTO type (catid, name) VALUES ('$catid', '$name')";
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
