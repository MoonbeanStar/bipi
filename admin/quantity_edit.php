<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$qtyname = $_POST['qtyname'];

		$sql = "UPDATE quantity SET qtyname = '$qtyname' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Quantity updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location: quantity.php');

?>