<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$sql = "DELETE FROM borrow WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Reserve deleted successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Select Borrow to delete first';
	}

	header('location: borrow.php');
	
?>
