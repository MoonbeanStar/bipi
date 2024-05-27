<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$qtyname = $_POST['qtyname'];
		
		$sql = "INSERT INTO quantity (qtyname) VALUES ('$qtyname')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Quantity added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: quantity.php');

?>