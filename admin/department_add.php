<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$code = $_POST['code'];
		$depname = $_POST['depname'];
		
		$sql = "INSERT INTO department (code, depname) VALUES ('$code', '$depname')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Department added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: department.php');

?>