<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$loc = $_POST['loc'];
		
		$sql = "INSERT INTO location (loc) VALUES ('$loc')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Location added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: location.php');

?>