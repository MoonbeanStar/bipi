<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$item = $_POST['item_id'];
		$remarks = $_POST['remarks'];
		$dateneeded = $_POST['date_needed'];
		$datereturn = $_POST['date_return'];

		$sql = "UPDATE borrow SET item_id = '$item', remarks = '$remarks', date_needed ='$dateneeded', due_date='$datereturn' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Category updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:borrow.php');

?>