<?php include 'includes/session.php'; ?>
<?php
	if(!isset($_SESSION['employee']) || trim($_SESSION['employee']) == ''){
		header('index.php');
	}

?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">
  <?php include 'includes/navbar.php'; ?>

  <div class="content-wrapper">

    <section class="content-header">
      <h1>
        Borrow Items
      </h1>
	  
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          ?>
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-warning"></i> Error!</h4>
                <ul>
                <?php
                  foreach($_SESSION['error'] as $error){
                    echo "
                      <li>".$error."</li>
                    ";
                  }
                ?>
                </ul>
            </div>
          <?php
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
            <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Reserved Item</a>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead span style="background:gray;"><font color="black";>
                  <th class="hidden"></th>
				
				  <th><font color="white";>Line Up</font></th>
				  <th><font color="white";>Date</font></th>
				  <th><font color="white";>Date Needed</font></th>
				  <th><font color="white";>Date Return</font></th>
                  <th><font color="white";>Name</font></th>
				   <th><font color="white";>Dept Name</font></th>
                  <th><font color="white";>Item</font></th>
				  <th><font color="white";>Item Code</font></th>
                  <th><font color="white";>Purpose</font></th>
				  <th><font color="white";>Status</font></th>
				  <th><font color="white";>Actions</font></th>
                  </thead>
                <tbody>
				
                  <?php
					$stuid = $employee['id'];
                    $sql = "SELECT *,borrow.id, borrow.remarks,borrow.item, borrow.date_issued,borrow.due_date, employees.employee_id AS stud, borrow.status AS barstat FROM borrow LEFT JOIN employees ON employees.id=borrow.employee_id LEFT JOIN items ON items.id=borrow.item_id LEFT JOIN category on category.id =borrow.item_id LEFT JOIN department on department.id=employees.department_id WHERE employees.id = '$stuid' ORDER BY date_borrow DESC";
                   
				   $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      if($row['barstat']==0){
                        $status = '<span class="label label-info">For Verify</span>';
 echo "
                        <tr bgcolor='Lavender' style='color: black;'>
                          <td class='hidden'></td>
						  <td>".$row['id']."</td>
                          <td>".date('M d, Y', strtotime($row['date_borrow']))."</td>
						  <td>".date('M d, Y', strtotime($row['date_needed']))."</td>
						  <td>".date('M d, Y', strtotime($row['due_date']))."</td>	
                          <td>".$row['firstname'].' '.$row['lastname']."</td>
						  <td>".$row['depname']."</td>
                          <td>".$row['name']."</td>
						  <td>".$row['item']."</td>
						  <td>".$row['remarks']."</td>
                          <td>".$status."</td>
						    <td>
							    <button class='btn btn-danger btn-sm delete btn-flat' data-id='".$row['id']."'><i class='fa fa-trash'></i> Delete</button>
                            </td>
                        </tr>
                      ";                    
					}
					 
                      elseif($row['barstat']==1)
					  {
                        $status = '<span class="label label-info">Reserved</span>';
echo "
                        <tr>
                          <td class='hidden'></td>
					       <td>".$row['id']."</td>
                          <td>".date('M d, Y', strtotime($row['date_borrow']))."</td>
						  <td>".date('M d, Y', strtotime($row['date_needed']))."</td>
						   <td>".date('M d, Y', strtotime($row['due_date']))."</td>	
                          <td>".$row['firstname'].' '.$row['lastname']."</td>
						  <td>".$row['depname']."</td>
                          <td>".$row['name']."</td>
						  <td>".$row['item']."</td>
						   <td>".$row['remarks']."</td>
                          <td>".$status."</td>
						  <td>
                            <button class='btn btn-info btn-sm edit btn-flat' data-id='".$row['id']."'><i class='fa fa-edit'></i> Edit</button>
                            <button class='btn btn-danger btn-sm delete btn-flat' data-id='".$row['id']."'><i class='fa fa-trash'></i> Delete</button>
				
                          </td>
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
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/borrow_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
  function rem_select(){
    $('[name="item[]"]').change(function(){
      if($(this).val() == '<rem>'){
        $(this).closest('.form-group').remove()
      }
    })
  }

  document.getElementById('append').addEventListener('click', function() {
        var newFormGroup = document.createElement('div');
        newFormGroup.className = 'form-group';
        newFormGroup.innerHTML = `
            <label class="col-sm-3 control-label">Total No. of Delivery:</label>
            <div class="col-sm-9 mb-4">
                <div class="row">
                    <div class="col-sm-6">
                        <select class="form-control" name="ttl_del"><?php for ($i = 1; $i <= 10; $i++) echo "<option value='$i'>$i</option>"; ?></select>
                    </div>
                    <div class="col-sm-6">
                        <select class="form-control" name="uom_dropdown">
                            <option value="boxes">boxes</option>
                            <option value="pails">pails</option>
                            <option value="drum">drum</option>
                        </select>
                    </div>
                </div>
            </div>`;
        document.getElementById('append-div').appendChild(newFormGroup);
    });

    document.getElementById('append_qty').addEventListener('click', function() {
        var newFormGroup = document.createElement('div');
        newFormGroup.className = 'form-group';
        newFormGroup.innerHTML = `
            <label class="col-sm-3 control-label">Total Quantity:</label>
            <div class="col-sm-9 mb-4">
                <div class="row">
                    <div class="col-sm-6">
                        <select class="form-control" name="ttl_qty"><?php for ($i = 1; $i <= 10; $i++) echo "<option value='$i'>$i</option>"; ?></select>
                    </div>
                    <div class="col-sm-6">
                        <select class="form-control" name="uom_dropdown">
                              <option value="kg">kg</option>
                              <option value="pcs">pcs</option>
                              <option value="prs">prs</option>
                              <option value="prs">packs</option>
                        </select>
                    </div>
                </div>
            </div>`;
        document.getElementById('append-div-qty').appendChild(newFormGroup);
    });

    <script>
  document.getElementById("addVehicle").addEventListener("click", function() {
    document.getElementById("vehicleDetails").innerHTML += `
      <div class="vehicle-info">
        <div class="form-group">
          <label for="vehicleModel">Vehicle Model:</label>
          <input type="text" class="form-control" name="vehicleModel[]">
        </div>
        <div class="form-group">
          <label for="plateNo">Plate No.:</label>
          <input type="text" class="form-control" name="plateNo[]">
        </div>
        <div class="form-group">
          <label for="driverName">Driver Name:</label>
          <input type="text" class="form-control" name="driverName[]">
        </div>
        <div class="form-group">
          <label for="helperName">Helper Name:</label>
          <input type="text" class="form-control" name="helperName[]">
        </div>
      </div>
    `;
  });
</script>

$(function(){
  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.delete', function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'borrow_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.catid').val(response.id);
	  $('#dateneeded_edit').val(response.date_needed);
	  $('#datereturn_edit').val(response.due_date);
	  $('#edit_name').val(response.id);
	  $('#catselect').val(response.item_id);
	  $('#edit_remarks').val(response.remarks);
      $('#del_cat').html(response.id);

    }
  });
}
</script>
</body>
</html>
