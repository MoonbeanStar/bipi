<?php include 'includes/session.php'; ?>
<?php
	if(!isset($_SESSION['employee']) || trim($_SESSION['employee']) == ''){
		header('index.php');
	}

	$stuid = $employee['id'];
	//$sql = "SELECT *,borrow.item, borrow.date_issued,borrow.due_date FROM borrow LEFT JOIN items ON items.id=borrow.item_id WHERE employee_id = '$stuid' ORDER BY date_borrow DESC";
    $sql = "SELECT *, borrow.item, borrow.date_issued,borrow.due_date, employees.employee_id AS stud, borrow.status AS barstat FROM borrow LEFT JOIN employees ON employees.id=borrow.employee_id LEFT JOIN items ON items.id=borrow.item_id LEFT JOIN category on category.id =borrow.item_id LEFT JOIN department on department.id=employees.department_id WHERE employees.id = '$stuid' ORDER BY date_borrow DESC";

	$action = 'Last Borrow';
	if(isset($_GET['action'])){
		$sql = "SELECT * FROM borrow LEFT JOIN items ON items.id=returns.item_id WHERE employee_id = '$stuid' ORDER BY date_return DESC";
		$action = $_GET['action'];
		
	
	}

?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-30 col-sm-offset-0">
	        		<div class="box">
	        			<div class="box-header with-border">
	        				<h3 class="box-title">TRANSACTION HISTORY</h3>
	        	
	        			</div>
	        			<div class="box-body">
	        				<table class="table table-bordered table-striped" id="example1">
			        			<thead>
			        				<th class="hidden"></th>
			        				<th>Date</th>
									<th>Date Issued</th>
									<th>Due Date</th>
									<th>Date Return</th>
			        				<th>Item</th>
									<th>Item Code</th>
									<th>Name</th>
									<th>Dept Name</th>
			        				<th>Due Count</th>
									<th>Remarks</th>
									
									
			        			</thead>
			        			<tbody>
			        			<?php
			        				$query = $conn->query($sql);
			        				while($row = $query->fetch_assoc()){
			        					$date = (isset($_GET['action'])) ? 'date_return' : 'date_borrow';
										$date1=date_create($row['due_date']);
										$date2=date_create($row['date_return']);
										$diff=date_diff($date1,$date2);
										if ($date1>=$date2){
			        					echo "
			        						<tr>
			        							<td class='hidden'></td>
			        							<td>".date('M d, Y', strtotime($row[$date]))."</td>
												<td>".date('M d, Y', strtotime($row['date_issued']))."</td>
												<td>".date('M d, Y', strtotime($row['due_date']))."</td>
												<td>".date('M d, Y', strtotime($row['date_return']))."</td>
			        							<td>".$row['name']."</td>
												<td>".$row['item']."</td>
												<td>".$employee['firstname'].' '.$employee['lastname']."</td>
												<td>".$row['depname']."</td>
			        					
												<td>".$diff->format('<b><font color ="blue">(%R%a On Time days)</font></b>')."</td>
												<td>".$row['statap']."</td>
			        						</tr>
			        					";
										}else {
											echo "
			        						<tr>
			        							<td class='hidden'></td>
			        							<td>".date('M d, Y', strtotime($row[$date]))."</td>
												<td>".date('M d, Y', strtotime($row['date_issued']))."</td>
												<td>".date('M d, Y', strtotime($row['due_date']))."</td>
												<td>".date('M d, Y', strtotime($row['date_return']))."</td>
			        							<td>".$row['name']."</td>
												<td>".$row['item']."</td>
												<td>".$employee['firstname'].' '.$employee['lastname']."</td>
												<td>".$row['depname']."</td>
			        					
												<td>".$diff->format('<font color ="red">(%R%a delayed days)</font>')."</td>
												<td>".$row['statap']."</td>
			        						</tr>
			        					";
										}
			        				}
			        			?>
			        			</tbody>
			        		</table>
	        			</div>
	        		</div>
	        	</div>
	        </div>
	      </section>
	     
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>

</body>
</html>