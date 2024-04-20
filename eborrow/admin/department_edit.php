<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$code = $_POST['code'];
		$depname = $_POST['depname'];

		$sql = "UPDATE department SET code = '$code', depname = '$depname' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Department updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:department.php');

?>