<?php include 'includes/session.php'; ?>
<?php
	if(!isset($_SESSION['supplier']) || trim($_SESSION['supplier']) == ''){
		header('index.php');
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
	        				<h3 class="box-title">SCHEDULED HISTORY</h3>
	        	
	        			</div>
	        			<div class="box-body">
	        				<table class="table table-bordered table-striped" id="example1">
			        			<thead>
			        				<th class="hidden"></th>
									<th>ID No.</th>
									<th>ANS No.</th>
									<th>Name</th>
									<th>Delivery Date</th>
									<th>Delivery Time</th>
									<th>Category</th>
									<th>Type</th>
									<th>DR Photo</th>
									<th>Status</th>
									<th>Remarks</th>
			        			</thead>
			        			<tbody>
								<?php
                                $supplier_id = $supplier['id'];
								$sql = "SELECT scheduled_history.*, supplier.firstname, supplier.lastname 
								FROM scheduled_history 
								JOIN supplier ON scheduled_history.supplier_id = supplier.id 
								WHERE scheduled_history.supplier_id = '$supplier_id' 
								ORDER BY scheduled_history.del_date DESC";

								$query = $conn->query($sql);
						
								if ($query && $query->num_rows > 0) {
									while ($row = $query->fetch_assoc()) {
										$status = $row['status'];
										$status_label = '';
								
										if (in_array($status, [1, 2, 5])) {
											$status_label = '<span class="label label-danger">Unsuccessful Delivered</span>';
										} elseif ($status == 3) {
											$status_label = '<span class="label label-success">Successfully Delivered</span>';
										}
								
                                            echo "<tr>
                                                <td class='hidden'></td>
                                                <td>{$row['id']}</td>
                                                <td>{$row['ans_no']}</td>
                                                <td>" . ucwords($row['firstname'] . ' ' . $row['lastname']) . "</td>
                                                <td>{$row['delDate']}</td>
                                                <td>{$row['delTime']}</td>
												<td>{$row['category']}</td>
												<td>{$row['type']}</td>
                                                <td><img src='images/{$row['drPhoto']}' alt='DR Photo' style='width:80px;height:80px;cursor:pointer;' onclick='showImageModal(\"images/{$row['drPhoto']}\")'></td>
												<td>{$status_label}</td>
                                                <td>{$row['remarks']}</td>
                                            </tr>";

										}
									} else {
										echo "<tr><td colspan='9'>No scheduled history found.</td></tr>";
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