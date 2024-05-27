<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$catid = $_POST['catid']
		$name = $_POST['name'];

		$sql = "UPDATE type SET name = '$name' WHERE id = '$id' and catid = '$catid' ";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Item Type updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:type.php');

?>