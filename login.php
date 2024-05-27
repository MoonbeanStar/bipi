<?php
	include 'includes/session.php';

	if(isset($_POST['login'])){
		$supplier = $_POST['supplier'];
		$sql = "SELECT * FROM supplier WHERE supplier_id = '$supplier'";
		$query = $conn->query($sql);
		
		if($query->num_rows > 0){
			$row = $query->fetch_assoc();
			$_SESSION['supplier'] = $row['id'];
			
			header('location: schedule.php');
		}
		else{
			$_SESSION['error'] = 'Supplier not found';
			header('location: index.php');
		}

	}
	else{
		$_SESSION['error'] = 'Enter supplier ID first';
		header('location: index.php');
	}


?>