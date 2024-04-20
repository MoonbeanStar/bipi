<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">
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
  <?php include 'includes/navbaroutg.php'; ?>
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <div class="row">
       <div class="col-sm-30 col-sm-offset-0">
          <div class="box">

        	<div class="box-header with-border">
	        				<h3 class="box-title">For Approval </h3>
	        </div>
			<div class="box-body">			
              <table id="example1" class="table table-bordered">
					<thead bgcolor='Lavender' style='color: black;'>
				  <th>Line UP</th>
			      <th>Date Issued</th>
				 <!-- <th>Date Return</th>-->
			      <th>Borrower Name / <font color=green>Dept</font></th>
				
				  <th>Item Name /<font color=green> Item Code</font></th>
			
				  <th>Purpose</th>
				 <!-- <th>Status</th>-->
				  <th><center>Actions</center></th>
                </thead>
                <tbody>
                  <?php
 
$sql ="SELECT *,borrow.remarks, borrow.id, employees.employee_id, borrow.date_borrow, employees.firstname, employees.lastname , department.depname, borrow.date_issued, borrow.due_date, borrow.status, category.name, borrow.item FROM borrow INNER JOIN employees ON borrow.employee_id = employees.id INNER JOIN department ON employees.department_id = department.id INNER JOIN category ON borrow.item_id = category.id LEFT JOIN items ON borrow.item_id = items.id WHERE borrow.location=16";         
		
		$query = $conn->query($sql);
               
						 while($row = $query->fetch_assoc()){
						     $loc=$row['location'];
							 $sta=$row['status'];
							 $dep=$row['department_id'];
							 $vid=$row['id'];
							 $categ=$row['name'];
                       if($loc==16 and $sta==4){
                        $status = '<span class="label label-info"><font size=2>For Guard</font></span>';
						echo"
                        <tr bgcolor='Orange' style='color: black;'>
						  <td><font size=10><b>".$row['id']."</td>
					      <td><font size=5><b>".date('M d, Y', strtotime($row['date_issued']))."</b></td>
								  
						  <td><font size=5><b>".$row['firstname'].' '.$row['lastname'].' | <font color=green> '.$row['depname']."</td>
						
						  <td><font size=5><b>".$categ.' | <font color=green>'.$row['item']."</td>
					
						  <td><font color='black'>".$row['remarks']."</td>
						  
					
                          <td><center>
                            <button class='btn btn-info btn-sm editg btn-flat' data-id='".$vid."'><i class='fa fa-edit'></i><font size=5> Guard</font></button>
                            <button class='btn btn-danger btn-sm cancel btn-flat' data-id='".$vid."'><i class='fa fa-arrow-down'></i> Cancel</button></center>
                          </td>
                        </tr>
                      ";
                      }
                   //   elseif($loc==16 and $sta==2)
					 // {
                       
					  // $status = '<span class="label label-success">for MIS</span>';
					   //echo"
                       // <tr>
					//	  <td>".$row['id']."</td>
					//
                          //<td>".date('M d, Y', strtotime($row['date_needed']))."</td>
						  //<td>".date('M d, Y', strtotime($row['due_date']))."</td>					  
						  //<td>".$row['firstname'].' '.$row['lastname']."</td>
						  //<td>".$categ."</td>
						  //<td>".$row['item']."</td>
						  //<td>".$row['depname']."</td>
						  //<td><textarea readonly>".$row['remarks']."</textarea></td>
						  
						  //<td>". $status."</td>
                          //<td><center>
                            //<button class='btn btn-success btn-sm edit btn-flat' data-id='".$vid."'><i class='fa fa-edit'></i> MIS</button>
                           // <button class='btn btn-danger btn-sm cancelm btn-flat' data-id='".$vid."'><i class='fa fa-arrow-down'></i> Cancel</button></center>
                         // </td>
                       // </tr>
                      //";
					 // }		
					 else{

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
  <?php include 'includes/verify_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $(document).on('click', '.editg', function(e){
    e.preventDefault();
    $('#editg').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });



  $(document).on('click', '.cancel', function(e){
    e.preventDefault();
    $('#cancel').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
  $(document).on('click', '.cancelm', function(e){
    e.preventDefault();
    $('#cancelm').modal('show');
    var id = $(this).data('id');
    getRow(id);
  }); 
 
});


function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'verify_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.catid').val(response.id);
	  $('.misid').val(response.id);
	  $('.canid').val(response.id);
	  $('.cancelid').val(response.id);

      $('#editm_name').val(response.employee_id);
	  $('#remarks').val(response.remarks);
	  
	  $('#datepicker_edit').val(response.due_date);

	   $('#loc').html(response.location);

      $('#act_cat').html(response.id);
	  $('#act_mis').html(response.id);
	  $('#act_can').html(response.id); 
	  $('#act_canm').html(response.id); 

    }
  });
}
</script>
</body>
</html>
