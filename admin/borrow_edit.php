<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$name = $_POST['employee_id'];

		$itemcoder = $_POST['itemcoder'];
		$duedate = $_POST['duedate'];
		//$sql = "UPDATE borrow SET date_return=NOW(),status ='3' WHERE id = '$id'";
		$sql = "UPDATE borrow INNER JOIN items ON borrow.item = items.item SET date_return=NOW(), borrow.status = 3, items.status = 0
WHERE (((borrow.id)='$id'))";
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

	header('location:borrow.php');

?>
