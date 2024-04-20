<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$department = $_POST['department'];
		$password = $_POST['employee_id'];

		$sql = "UPDATE employees SET firstname = '$firstname', lastname = '$lastname', department_id = '$department', employee_id = '$password' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Employee updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:employee.php');

?>