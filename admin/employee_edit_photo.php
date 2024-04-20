<?php
	include 'includes/session.php';

	if(isset($_POST['upload'])){
		$id = $_POST['id'];
		$filename = date('YmdHis').$_FILES['photo']['name'];
		if(!empty($filename)){
			move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);	
		}
		
		$sql = "UPDATE employees SET photo = '$filename' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Employee photo updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Select employee to update photo first';
	}

	header('location: employee.php');
?>