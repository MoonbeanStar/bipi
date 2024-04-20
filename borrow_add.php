<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$employee = $_POST['employee'];
		$remarks = $_POST['remarks'];
		$dateneeded =$_POST['dateneeded'];
		$datereturn =$_POST['datereturn'];
		
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
					$sql = "SELECT * FROM category WHERE id = '$item'";
					$query = $conn->query($sql);
					if($query->num_rows > 0){
						$brow = $query->fetch_assoc();
						$bid = $brow['id'];

						$sql = "INSERT INTO borrow (employee_id, item_id, date_borrow, remarks, status, date_needed, due_date) VALUES ('$employee_id', '$bid', NOW(),'$remarks','1','$dateneeded','$datereturn')";
						if($conn->query($sql)){
							
						
						}


					}
					
		
				}
			}

			

		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: borrow.php');

?>