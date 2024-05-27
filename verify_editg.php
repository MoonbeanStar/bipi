<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$asnNo = $_POST['asn_no'];
		$name = $_POST['supplier_id'];
	
		
		$sql = "UPDATE schedule_data SET date_guard=NOW(),status ='3' WHERE id = '$id'";

		if($conn->query($sql)){
			$_SESSION['success'] = 'Successfully Delivered';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}


	header('location:verifyg.php');

?>
