<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];

		// Retrieve catid before deletion
		$sql_select = "SELECT catid FROM type WHERE id = '$id'";
		$result = $conn->query($sql_select);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$catid = $row['catid'];

			// Now perform deletion
			$sql_delete = "DELETE FROM type WHERE id = '$id' AND catid = '$catid'";
			if($conn->query($sql_delete)){
				$_SESSION['success'] = 'Item Type deleted successfully';
			}
			else{
				$_SESSION['error'] = $conn->error;
			}
		} else {
			$_SESSION['error'] = 'Invalid item ID';
		}
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	header('location: type.php');
?>
