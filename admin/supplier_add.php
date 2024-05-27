<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$password = $_POST['supplier_id'];
	
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
		$sql = "INSERT INTO supplier (supplier_id, firstname, lastname, created_on) VALUES ('$password', '$firstname', '$lastname', NOW())";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Supplier added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: supplier.php');
?>