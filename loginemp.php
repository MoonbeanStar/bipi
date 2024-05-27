<?php
	include 'includes/session.php';

	if(isset($_POST['loginemp'])){
		$employee = $_POST['employee'];
	
		$sql = "SELECT * FROM employees WHERE employee_id = '$employee'";
		$query = $conn->query($sql);
		
		if($query->num_rows > 0){
			$row = $query->fetch_assoc();
			$_SESSION['employee'] = $row['id'];
			
			header('location: outside.php');
		}
		else{
			$_SESSION['error'] = 'Employee not found';
			header('location: index.php');
		}

	}
	else{
		$_SESSION['error'] = 'Enter employee id first';
		header('location: index.php');
	}


?>