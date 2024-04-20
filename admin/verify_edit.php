<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$name = $_POST['employee_id'];

		$itemcode = $_POST['itemcode'];
		$duedate = $_POST['duedate'];
		$location = $_POST['loc'];
		
		$sql = "UPDATE borrow SET employee_id = '$name' , item='$itemcode',date_issued=NOW(),status ='2',due_date ='$duedate',location ='$location' WHERE id = '$id'";

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
	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$name = $_POST['employee_id'];

		$itemcode = $_POST['itemcode'];
		
	
		$sql = "UPDATE items SET status = 1 WHERE item = '$itemcode'";
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
