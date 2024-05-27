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
	        				<h3 class="box-title">Delivery Schedule</h3>
	        </div>
			<div class="box-body">			
              <table id="example1" class="table table-bordered">
					<thead bgcolor='Lavender' style='color: black;'>
				    <th>Line Up</th>
            <th>ANS No.</th>
            <th>Name</th>
            <th>Delivery Date</th>
            <th>Delivery Time</th>
            <th>DR Photo</th>
				    <th>Status</th>
				  <th><center>Actions</center></th>
                </thead>
                <tbody>

                 <!-- Image Modal -->
            <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">DR Photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" alt="DR Photo" class="img-fluid">
                </div>
                </div>
            </div>
            </div>            
                  <?php
 
            $sql = "SELECT schedule_data.*, supplier.firstname, supplier.lastname  FROM schedule_data 
            JOIN supplier ON schedule_data.supplier_id = supplier.id 
            ORDER BY schedule_data.id ASC ";
		
		$query = $conn->query($sql);
               
    if ($query->num_rows > 0) {
      while ($row = $query->fetch_assoc()) {
          $sta = $row['status'];
          if ($sta == 2) {
              $status = '<span class="label label-info"><font size=2>For Guard</font></span>';
              
              echo "<tr bgcolor='Orange' style='color: black;'>";
              echo "<td>" . $row["id"] . "</td>";
              echo "<td>" . $row["ans_no"] . "</td>";
              echo "<td>" . ucwords($row['firstname'] . ' ' . $row['lastname']) . "</td>";
              echo "<td>" . $row["delDate"] . "</td>";
              echo "<td>" . $row["delTime"] . "</td>";
              echo "<td><img src='images/" . $row['drPhoto'] . "' alt='DR Photo' style='width:80px;height:80px;cursor:pointer;' onclick='showImageModal(\"images/" . $row['drPhoto'] . "\")'></td>";
              echo "<td><span class='label label-success'>Approved</span></td>";
              echo "<td>";
              echo "<button class='btn btn-success btn-sm editg btn-flat' data-id='" . $row["id"] . "'><i class='fa fa-edit'></i> Delivered</button>";
           
              echo "</td>";
              echo "</tr>";
          }
        }
                      }else{
                        echo "<tr><td colspan='10'>No data available</td></tr>";
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

<script>
function showImageModal(src) {
    $('#modalImage').attr('src', src);
    $('#imageModal').modal('show');
}
</script>

</body>
</html>
