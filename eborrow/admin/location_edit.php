<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$loc = $_POST['loc'];
		$address = $_POST['address'];

		$sql = "UPDATE location SET loc = '$loc', address = '$address' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Location updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:location.php');

?>