<?php
	include 'includes/session.php';

	if(isset($_POST['cancelm'])){
		$id = $_POST['id'];
		$cancel = $_POST['cancelremarks'];
		
		//$sql = "DELETE FROM borrow WHERE id = '$id'";
		$sql = "UPDATE borrow SET status ='7',cancel_remarks='$cancel' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Request deleted successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Select Line up to cancel first';
	}

	header('location: verify.php');
	
?>