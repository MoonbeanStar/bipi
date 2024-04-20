<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$employee = $_POST['employee'];
		
		$sql = "SELECT * FROM employees WHERE employee_id = '$employee'";
		$query = $conn->query($sql);
		if($query->num_rows < 1){
			if(!isset($_SESSION['error'])){
				$_SESSION['error'] = array();
			}
			$_SESSION['error'][] = 'Employee not found';
		}
		else{
			$row = $query->fetch_assoc();
			$employee_id = $row['id'];

			$added = 0;
			foreach($_POST['item'] as $item){
				if(!empty($item)){
					$sql = "SELECT * FROM items WHERE item = '$item' AND status != 1";
					$query = $conn->query($sql);
					if($query->num_rows > 0){
						$brow = $query->fetch_assoc();
						$bid = $brow['id'];

						$sql = "INSERT INTO borrow (employee_id, item_id, date_borrow, status) VALUES ('$employee_id', '$bid', NOW(),'1')";
						if($conn->query($sql)){
							$added++;
							$sql = "UPDATE items SET status = 1 WHERE id = '$bid'";
							$conn->query($sql);
						}
						else{
							if(!isset($_SESSION['error'])){
								$_SESSION['error'] = array();
							}
							$_SESSION['error'][] = $conn->error;
						}

					}
					else{
						if(!isset($_SESSION['error'])){
							$_SESSION['error'] = array();
						}
						$_SESSION['error'][] = 'Item with ITEM - '.$item.' unavailable';
					}
		
				}
			}

			if($added > 0){
				$item = ($added == 1) ? 'Item' : 'Items';
				$_SESSION['success'] = $added.' '.$item.' successfully borrowed';
			}

		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: borrow.php');

?>