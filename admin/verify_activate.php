<?php
	include 'includes/session.php';

	if(isset($_POST['activate'])){
		$id = $_POST['id'];
		//$sql = "DELETE FROM borrow WHERE id = '$id'";
		$sql = "UPDATE borrow SET status ='0' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Request deleted successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	header('location: verify.php');
	
?>