<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$item = $_POST['item'];
		$depname = $_POST['depname'];
		$category = $_POST['category'];
		$supplier = $_POST['supplier'];
		$personnel = $_POST['personnel'];
		$date_issued = $_POST['date_issued'];

		$sql = "UPDATE items SET item = '$item', depname = '$depname', category_id = '$category', supplier = '$supplier', personnel = '$personnel', date_issued = '$date_issued' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Item updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:item.php');

?>