<?php include 'includes/session.php'; ?>
 <?php
// Turn off error reporting
error_reporting(0);

// Report runtime errors
error_reporting(E_ERROR | E_WARNING | E_PARSE);

// Report all errors
error_reporting(E_ALL);

// Same as error_reporting(E_ALL);
ini_set("error_reporting", E_ALL);

// Report all errors except E_NOTICE
error_reporting(E_ALL & ~E_NOTICE);
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
	        				<h3 class="box-title">Not Returned Items</h3>
	        	
	        			</div>
	        			<div class="box-body">
	        				<table class="table table-bordered table-striped" id="example1">
			        			<thead bgcolor='Lavender' style='color: black;'>
			        				<th class="hidden"></th>
			        				<th>Line Up</th>
									<th>Borrower</th>
									<th>Date Issued</th>
									<th>Due Date</th>
									<th>Item</th>
									<th>Item Code</th>
									
									<th>Dept Name</th>
			        				<th>Due Count</th>
									<th>Remarks</th>
									<th>Status</th>
									
			        			</thead>
			        			<tbody>
			        			<?php
								 $sql = "SELECT *,employees.firstname, employees.lastname, borrow.*, location.loc,
  department.depname
FROM borrow INNER JOIN
  employees ON borrow.employee_id = employees.id INNER JOIN
  location ON borrow.location = location.id INNER JOIN
  department ON employees.department_id = department.id WHERE borrow.status = 2 or borrow.status = 4 or borrow.status = 5";

			        				$query = $conn->query($sql);
			        				while($row = $query->fetch_assoc()){
									$photo = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/profile.jpg';	
			        				$ben  = $row['item'];
									$ben2 = explode("-", $ben);	
										$date1=date_create("now");
										$date2=date_create($row['due_date']);
										$diff=date_diff($date1,$date2);
										$loc=$row['location'];
										$sta=$row['status'];
									    if($loc != 16 and $sta == 2){
                        $status = '<span class="label label-danger">not returned</span>';
						if ($date1<=$date2){
									
			        					echo "
			        						<tr>
			        							<td class='hidden'></td>
												<td>".$row['id']."</td>
												<td><center><img src='".$photo."'class='img-circle' width='75px' height='75px'><br>".$row['firstname'].' '.$row['lastname']."</br></center></td>
												<td>".date('M d, Y', strtotime($row['date_issued']))."</td>
												<td>".date('M d, Y', strtotime($row['due_date']))."</td>
												<td>".$row['item_id']."</td>
												<td>".$ben2[3]."</td>
											
												<td>".$row['depname']."</td>
			        							<td>".$diff->format('<b><font color ="blue">%a Remaining Days  </font></b>')."</td>
												<td>".$row['remarks']."</td>
												<td>".$status."</td>
			        						</tr>
			        					";
						
										}
										else
										
										{
									
											echo "
			        						<tr>
			        							<td class='hidden'></td>
			        							<td>".$row['id']."</td>
												<td><center><img src='".$photo."'class='img-circle' width='75px' height='75px'><br>".$row['firstname'].' '.$row['lastname']."</br></center></td>
												<td>".date('M d, Y', strtotime($row['date_issued']))."</td>
												<td>".date('M d, Y', strtotime($row['due_date']))."</td>
												<td>".$row['item_id']."</td>
												<td>".$ben2[3]."</td>
												
												<td>".$row['depname']."</td>
			        							<td>".$diff->format('<font color ="red">%a Days Over Due</font>')."</td>
												<td>".$row['remarks']."</td>
											    <td>".$status."</td>
			        						</tr>
			        					";
										}
									
                      }
                      elseif ($loc == 16 and $sta == 2)  {
						  $status = '<span class="label label-success">for mis head</span>';
					  if ($date1<=$date2){
									
			        					echo "
			        						<tr>
			        							<td class='hidden'></td>
												<td>".$row['id']."</td>
												<td><center><img src='".$photo."'class='img-circle' width='75px' height='75px'><br>".$row['firstname'].' '.$row['lastname']."</br></center></td>
												<td>".date('M d, Y', strtotime($row['date_issued']))."</td>
												<td>".date('M d, Y', strtotime($row['due_date']))."</td>
												<td>".$row['item_id']."</td>
												<td>".$ben2[3]."</td>
											
												<td>".$row['depname']."</td>
			        							<td>".$diff->format('<b><font color ="blue">%a Remaining Days  </font></b>')."</td>
												<td>".$row['remarks']."</td>
												<td>".$status."</td>
			        						</tr>
			        					";
						
										}
										else
										
										{
									
											echo "
			        						<tr>
			        							<td class='hidden'></td>
			        							<td>".$row['id']."</td>
												<td><center><img src='".$photo."'class='img-circle' width='75px' height='75px'><br>".$row['firstname'].' '.$row['lastname']."</br></center></td>
												<td>".date('M d, Y', strtotime($row['date_issued']))."</td>
												<td>".date('M d, Y', strtotime($row['due_date']))."</td>
												<td>".$row['item_id']."</td>
												<td>".$ben2[3]."</td>
												
												<td>".$row['depname']."</td>
			        							<td>".$diff->format('<font color ="red">%a Days Over Due</font>')."</td>
												<td>".$row['remarks']."</td>
											    <td>".$status."</td>
			        						</tr>
			        					";
										}
									
					  }	
					  elseif ($loc == 16 and $sta == 4)  {
						  $status = '<span class="label label-success">for guard</span>';
					  if ($date1<=$date2){
									
			        					echo "
			        						<tr>
			        							<td class='hidden'></td>
												<td>".$row['id']."</td>
												<td><center><img src='".$photo."'class='img-circle' width='75px' height='75px'><br>".$row['firstname'].' '.$row['lastname']."</br></center></td>
												<td>".date('M d, Y', strtotime($row['date_issued']))."</td>
												<td>".date('M d, Y', strtotime($row['due_date']))."</td>
												<td>".$row['item_id']."</td>
												<td>".$ben2[3]."</td>
											
												<td>".$row['depname']."</td>
			        							<td>".$diff->format('<b><font color ="blue">%a Remaining Days  </font></b>')."</td>
												<td>".$row['remarks']."</td>
												<td>".$status."</td>
			        						</tr>
			        					";
						
										}
										else
										
										{
									
											echo "
			        						<tr>
			        							<td class='hidden'></td>
			        							<td>".$row['id']."</td>
												<td><center><img src='".$photo."'class='img-circle' width='75px' height='75px'><br>".$row['firstname'].' '.$row['lastname']."</br></center></td>
												<td>".date('M d, Y', strtotime($row['date_issued']))."</td>
												<td>".date('M d, Y', strtotime($row['due_date']))."</td>
												<td>".$row['item_id']."</td>
												<td>".$ben2[3]."</td>
												
												<td>".$row['depname']."</td>
			        							<td>".$diff->format('<font color ="red">%a Days Over Due</font>')."</td>
												<td>".$row['remarks']."</td>
											    <td>".$status."</td>
			        						</tr>
			        					";
										}
									
					  }	
					  elseif ($loc == 16 and $sta == 5)  {
						  $status = '<span class="label label-danger">not returned</span>';
					  if ($date1<=$date2){
									
			        					echo "
			        						<tr>
			        							<td class='hidden'></td>
												<td>".$row['id']."</td>
												<td><center><img src='".$photo."'class='img-circle' width='75px' height='75px'><br>".$row['firstname'].' '.$row['lastname']."</br></center></td>
												<td>".date('M d, Y', strtotime($row['date_issued']))."</td>
												<td>".date('M d, Y', strtotime($row['due_date']))."</td>
												<td>".$row['item_id']."</td>
												<td>".$ben2[3]."</td>
											
												<td>".$row['depname']."</td>
			        							<td>".$diff->format('<b><font color ="blue">%a Remaining Days  </font></b>')."</td>
												<td>".$row['remarks']."</td>
												<td>".$status."</td>
			        						</tr>
			        					";
						
										}
										else
										
										{
									
											echo "
			        						<tr>
			        							<td class='hidden'></td>
			        							<td>".$row['id']."</td>
												<td><center><img src='".$photo."'class='img-circle' width='75px' height='75px'><br>".$row['firstname'].' '.$row['lastname']."</br></center></td>
												<td>".date('M d, Y', strtotime($row['date_issued']))."</td>
												<td>".date('M d, Y', strtotime($row['due_date']))."</td>
												<td>".$row['item_id']."</td>
												<td>".$ben2[3]."</td>
												
												<td>".$row['depname']."</td>
			        							<td>".$diff->format('<font color ="red">%a Days Over Due</font>')."</td>
												<td>".$row['remarks']."</td>
											    <td>".$status."</td>
			        						</tr>
			        					";
										}
									
					  }	
					 else{
						  $status = '<span class="label label-success"></span>';
					  if ($date1<=$date2){
									
			        					echo "
			        						<tr>
			        							<td class='hidden'></td>
												<td>".$row['id']."</td>
												<td><center><img src='".$photo."'class='img-circle' width='75px' height='75px'><br>".$row['firstname'].' '.$row['lastname']."</br></center></td>
												<td>".date('M d, Y', strtotime($row['date_issued']))."</td>
												<td>".date('M d, Y', strtotime($row['due_date']))."</td>
												<td>".$row['item_id']."</td>
												<td>".$ben2[3]."</td>
											
												<td>".$row['depname']."</td>
			        							<td>".$diff->format('<b><font color ="blue">%a Remaining Days  </font></b>')."</td>
												<td>".$row['remarks']."</td>
												<td>".$status."</td>
			        						</tr>
			        					";
						
										}
										else
										
										{
									
											echo "
			        						<tr>
			        							<td class='hidden'></td>
			        							<td>".$row['id']."</td>
												<td><center><img src='".$photo."'class='img-circle' width='75px' height='75px'><br>".$row['firstname'].' '.$row['lastname']."</br></center></td>
												<td>".date('M d, Y', strtotime($row['date_issued']))."</td>
												<td>".date('M d, Y', strtotime($row['due_date']))."</td>
												<td>".$row['item_id']."</td>
												<td>".$ben2[3]."</td>
												
												<td>".$row['depname']."</td>
			        							<td>".$diff->format('<font color ="red">%a Days Over Due</font>')."</td>
												<td>".$row['remarks']."</td>
											    <td>".$status."</td>
			        						</tr>
			        					";
										}
									
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