
<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
	    $itemcode = $_POST['item'];

		$rremarks = $_POST['rremarks'];
		
		$sql = "UPDATE borrow SET date_return=NOW(), status = 3, returnremarks='$rremarks' WHERE id = '$id'";

		if($conn->query($sql)){
			$_SESSION['success'] = 'Item Return successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}
	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$name = $_POST['employee_id'];

		$itemcode = $_POST['item'];
		
	
		$sql = "UPDATE tbl_inventory SET status = 'AVAILABLE' WHERE itemcode = '$itemcode'";
		if($conn2->query($sql)){
			$_SESSION['success'] = 'Item updated successfully';
		}
		else{
			$_SESSION['error'] = $conn2->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:borrow.php');

?>
