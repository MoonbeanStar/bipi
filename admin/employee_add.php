<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$depart = $_POST['depart'];
		$password = $_POST['employee_id'];
		
		$filename = $_FILES['photo']['name'];
		if(!empty($filename)){
			move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);	
		}
		//creating employeeid
		//$letters = '';
		//$numbers = '';
		//foreach (range('A', 'Z') as $char) {
		//    $letters .= $char;
		//}
		//for($i = 0; $i < 10; $i++){
		//	$numbers .= $i;
		//}
		//$employee_id = substr(str_shuffle($letters), 0, 3).substr(str_shuffle($numbers), 0, 9);
		//
		$sql = "INSERT INTO employees (employee_id, firstname, lastname, department_id, photo, created_on) VALUES ('$password', '$firstname', '$lastname', '$depart', '$filename', NOW())";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Employee added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: employee.php');
?>