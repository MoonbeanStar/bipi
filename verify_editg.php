<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$name = $_POST['employee_id'];
		$duedate = $_POST['duedate'];
	
		
		$sql = "UPDATE borrow SET date_guard=NOW(),status ='5' WHERE id = '$id'";

		if($conn->query($sql)){
			$_SESSION['success'] = 'Item Approve successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}


	header('location:verifyg.php');

?>
