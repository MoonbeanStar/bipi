<?php include 'includes/session.php'; ?>
<?php
	if(!isset($_SESSION['supplier']) || trim($_SESSION['supplier']) == ''){
		header('index.php');
	}

?>
<?php
function generateANS() {
    // You can customize the ANS format according to your requirements
    $prefix = "ANS"; // Prefix for ANS number
    $random_number = mt_rand(10000, 99999); // Generate a random 5-digit number
    $ans_number = $prefix . $random_number;
    return $ans_number;
}
?>

      
      <?php include 'includes/header.php'; ?>
      <body class="hold-transition skin-blue layout-top-nav">
      <div class="wrapper">
        <?php include 'includes/navbar.php'; ?>
      
        <div class="content-wrapper">
      
          <section class="content-header">
            <h1>
              Schedule Delivery
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
                      <li><?php echo $_SESSION['error']; ?></li>
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
  <div class="box box-primary">
    <div class="box-header with-border">
        <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> ANS Creation</a>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
    <div class="table-responsive">
        <table id="example1" class="table table-bordered">
            <thead style="background: #2E5984; color: white;">
                <tr>
                    <th class="hidden"></th>
                    <th>#</th> 
                    <th>ANS No.</th>
                    <th>Name</th>
                    <th>Delivery Date</th>
                    <th>Delivery Time</th>
                    <th>Item Category</th>
                    <th>Item Type</th>  
                    <th>DR Photo</th>
                    <th>Status</th>
                    <th>Remarks</th>
                    <th>Actions</th>
                </tr>
            </thead>
                <tbody>
                  
				         
             
                <?php   
                  $supplier_id = $supplier['id'];
                  $sql = " SELECT schedule_data.*,supplier.firstname, supplier.lastname, schedule_data.status AS barstat FROM schedule_data 
                  JOIN supplier ON schedule_data.supplier_id = supplier.id 
                  WHERE schedule_data.supplier_id = '$supplier_id' 
                  ORDER BY schedule_data.delTime DESC";

                  
                 $query = $conn->query($sql);
                 $i = 1; // Initialize $i before the loop
                 $rowsFound = false; // Flag to track if any rows were processed
                 
                 while($row = $query->fetch_assoc()){
                     $rowsFound = true; // Set the flag to true if we enter the loop
                 
                     if($row['barstat'] == 1){
                         $status = '<span class="label label-info">For Approval</span>';
                     } elseif($row['barstat'] == 2){
                         $status = '<span class="label label-success">Approved</span>';
                     } elseif($row['barstat'] == 5){
                         $status = '<span class="label label-danger">Cancel Booked</span>';
                     } elseif($row['barstat'] == 3){
                         $status = '<span class="label label-success">Successfully Delivered</span>';
                     }
                 
                     echo "
                     <tr>
                         <td class='hidden'></td>
                         <td>" . $i . "</td>
                         <td>" . $row['ans_no'] . "</td>
                         <td>" . ucwords($row['firstname'] . ' ' . $row['lastname']) . "</td>
                         <td>" . $row['delDate'] . "</td>
                         <td>" . $row['delTime'] . "</td>
                         <td>" . $row['category'] . "</td>
                         <td>" . $row['type'] . "</td>
                         <td><img src='images/" . $row['drPhoto'] . "' alt='DR Photo' style='width:80px;height:80px;cursor:pointer;' onclick='showImageModal(\"images/" . $row['drPhoto'] . "\")'></td>
                         <td>" . $status . "</td>
                         <td>" . $row['remarks'] . "</td>
                         <td>
                             <button class='btn btn-info btn-sm view btn-flat' data-id='" . $row['id'] . "'><i class='fa fa-eye'></i> View</button>";
                 
                     if($row['barstat'] == 1) {
                         echo "<button class='btn btn-info btn-sm edit btn-flat' data-id='" . $row['id'] . "'><i class='fa fa-edit'></i> Edit</button>";
                     }
                 
                     echo "<button class='btn btn-danger btn-sm delete btn-flat' data-id='" . $row['id'] . "' onclick='deleteRecord(" . $row['id'] . ")'><i class='fa fa-trash'></i> Delete</button>
                         </td>
                     </tr>
                     ";
                     $i++;
                 }
                 
                 if (!$rowsFound) {
                     echo "Error fetching schedule data.";
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
  <?php include 'includes/schedule_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>

<script>
function deleteRecord(id) {
    if (confirm('Are you sure you want to delete this record?')) {
        $.ajax({
            url: 'schedule_delete.php',
            type: 'POST',
            data: { action: 'deleteRecord', id: id },
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message);
                    location.reload(); // Reload the page to see the changes
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + error);
                alert('An error occurred while trying to delete the record.');
            }
        });
    }
}
</script>
<script>



function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'schedule_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.catid').val(response.id);
	  $('#edit_name').val(response.id);
	  $('#catselect').val(response.item_id);
	  $('#edit_remarks').val(response.remarks);
      $('#del_cat').html(response.id);

    }
  });
}
</script>



<script>
$(document).ready(function(){
    $('#name').change(function(){
        var categoryId = $(this).val();
        if(categoryId){
            $.ajax({
                type: 'POST',
                url: 'get_types.php', // PHP file to fetch type names
                data: {categoryId: categoryId},
                success: function(response){
                    $('#itemType').html(response);
                }
            });
        }
        else{
            $('#itemType').html('<option value="" selected disabled>Please Select Item Type Here.</option>');
        }
    });
});
</script>


</body>
</html>
