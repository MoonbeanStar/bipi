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

			$return = 0;
			foreach($_POST['item'] as $item){
				if(!empty($item)){
					$sql = "SELECT * FROM items WHERE item = '$item'";
					$query = $conn->query($sql);
					if($query->num_rows > 0){
						$brow = $query->fetch_assoc();
						$bid = $brow['id'];

						$sql = "SELECT * FROM borrow WHERE employee_id = '$employee_id' AND item_id = '$bid' AND status = 0";
						$query = $conn->query($sql);
						if($query->num_rows > 0){
							$borrow = $query->fetch_assoc();
							$borrow_id = $borrow['id'];
							$sql = "INSERT INTO returns (employee_id, item_id, date_return) VALUES ('$employee_id', '$bid', NOW())";
							if($conn->query($sql)){
								$return++;
								$sql = "UPDATE items SET status = 0 WHERE id = '$bid'";
								$conn->query($sql);
								$sql = "UPDATE borrow SET status = 1 WHERE id = '$borrow_id'";
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
							$_SESSION['error'][] = 'Borrow details not found: ITEM - '.$item.', Employee ID: '.$employee;
						}

						

					}
					else{
						if(!isset($_SESSION['error'])){
							$_SESSION['error'] = array();
						}
						$_SESSION['error'][] = 'Item not found: ITEM - '.$item;
					}
		
				}
			}

			if($return > 0){
				$item = ($return == 1) ? 'Item' : 'Items';
				$_SESSION['success'] = $return.' '.$item.' successfully returned';
			}

		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: return.php');

?>