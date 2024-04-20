<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$name = $_POST['employee_id'];
		$duedate = $_POST['duedate'];
	
		
		$sql = "UPDATE borrow SET date_head=NOW(),status ='4',due_date ='$duedate' WHERE id = '$id'";

		if($conn->query($sql)){
			$_SESSION['success'] = 'Item updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}


	header('location:verify.php');

?>
