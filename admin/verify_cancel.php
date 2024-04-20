<?php
	include 'includes/session.php';

	if(isset($_POST['cancel'])){
		$id = $_POST['id'];
		$statap = $_POST['statap'];
		
		//$sql = "DELETE FROM borrow WHERE id = '$id'";
		$sql = "UPDATE borrow SET status ='4', statap ='$statap' WHERE id = '$id'";
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