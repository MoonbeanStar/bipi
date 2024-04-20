<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$item = $_POST['item'];
		$depname = $_POST['depname'];
		$category = $_POST['category'];
		$supplier = $_POST['supplier'];
		$personnel = $_POST['personnel'];
		$date_issued = $_POST['date_issued'];

		$sql = "INSERT INTO items (item, category_id, depname, supplier, personnel, date_issued) VALUES ('$item', '$category', '$depname', '$supplier', '$personnel', '$date_issued')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Item added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: item.php');

?>