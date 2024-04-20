<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
           Verify List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Verify</li>
        <li class="active">Verify</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">

            <div class="box-body">
              <table id="example1" class="table table-bordered">
					<thead bgcolor='Lavender' style='color: black;'>
				  <th>Line UP</th>
			      <th>Picture</th>
				  <th>Date Needed</th>
				  <th>Date Return</th>
			
			      <th>Name</th>
				  <th>Item</th>
		
				  <th>Dept Name</th>
				  <th>Status</th>
				  <th><center>Actions</center></th>
                </thead>
                <tbody>
                  <?php
 
$sql ="SELECT *,borrow.id, borrow.date_borrow, borrow.date_needed, borrow.due_date,
  employees.firstname, employees.lastname, borrow.item_id, department.depname,
  borrow.status
FROM borrow INNER JOIN
  employees ON borrow.employee_id = employees.id INNER JOIN
  department ON employees.department_id = department.id
WHERE borrow.status = 0 ";         
		
		$query = $conn->query($sql);
               
						 while($row = $query->fetch_assoc()){
							 $photo = (!empty($row['photo'])) ? '../images/'.$row['photo'] : '../images/profile.jpg';
							 $vid=$row['id'];
							 $categ=$row['item_id'];
                      if($row['status']){
                        $status = '<span class="label label-danger">not returned</span>';
                      }
                      else{
                        $status = '<span class="label label-info">Verify</span>';
                      }
                      echo "
 
                        <tr>
						  <td>".$row['id']."</td>
						  <td><img class='img-circle' src='".$photo."' width='50px' height='50px'></td>
                          <td>".date('M d, Y', strtotime($row['date_needed']))."</td>
						  <td>".date('M d, Y', strtotime($row['due_date']))."</td>					  
						  <td>".$row['firstname'].' '.$row['lastname']."</td>
						  <td>".$categ."</td>
						
						  <td>".$row['depname']."</td>
						  <td>". $status."</td>
                          <td>
                            <button class='btn btn-success btn-sm edit btn-flat' data-id='".$vid."'><i class='fa fa-edit'></i> Verify</button>
                            <button class='btn btn-danger btn-sm down btn-flat' data-id='".$vid."'><i class='fa fa-arrow-down'></i> Down</button></center>
                          </td>
                        </tr>
                      ";
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    </section>   
	<?php include 'verifyactivate.php'; ?>
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/verify_modal.php'; ?>
</div>
<?php include 'includes/scriptsact.php'; ?>
<script>
$(function(){
  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.activate', function(e){
    e.preventDefault();
    $('#activate').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
    $(document).on('click', '.available', function(e){
    e.preventDefault();
    $('#available').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
  $(document).on('click', '.cancel', function(e){
    e.preventDefault();
    $('#cancel').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
  $(document).on('click', '.down', function(e){
    e.preventDefault();
    $('#down').modal('show');
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
	  $('.canid').val(response.id);
	  $('.dowid').val(response.id);
	  $('.avaid').val(response.id);
      $('#edit_name').val(response.employee_id);
	  $('#remarks').val(response.remarks);
	  
	  $('#datepicker_edit').val(response.due_date);

	   $('#loc').html(response.location);

      $('#act_cat').html(response.id);
	  $('#act_can').html(response.id); 
	  $('#act_dow').html(response.id); 
	  $('#act_ava').html(response.id); 
    }
  });
}
</script>
</body>
</html>
