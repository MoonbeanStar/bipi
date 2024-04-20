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
        Employee List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Employees</li>
        <li class="active">Employee List</li>
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
            <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead bgcolor='Lavender' style='color: black;'>
                  
                  <th>Photo</th>
                  <th>Password</th>
                  <th>Firstname</th>
                  <th>Lastname</th>
				  <th>Department</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT *, employees.id AS empid FROM employees LEFT JOIN department ON department.id=employees.department_id ORDER BY firstname asc ";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      $photo = (!empty($row['photo'])) ? '../images/'.$row['photo'] : '../images/profile.jpg';
                      echo "
                        <tr>
                          
                          <td><center>
						  
                            <img src='".$photo."'class='img-circle' width='75px' height='75px'>
                            </center>
							</br>
								<a href='#edit_photo' data-toggle='modal' class='pull-right photo' data-id='".$row['empid']."'><span class='fa fa-edit'>Add Picture</span></a></center>
                          </td>
                          <td>".$row['employee_id']."</td>
                          <td>".$row['firstname']."</td>
                          <td>".$row['lastname']."</td>
						  <td>".$row['code']."</td>
                          <td>
                            <button class='btn btn-info btn-sm edit btn-flat' data-id='".$row['empid']."'><i class='fa fa-edit'></i> Edit</button>
                            <button class='btn btn-danger btn-sm delete btn-flat' data-id='".$row['empid']."'><i class='fa fa-trash'></i> Delete</button>
						
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
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/employee_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
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

  $(document).on('click', '.photo', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'employee_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.empid').val(response.empid);
      $('#edit_firstname').val(response.firstname);
      $('#edit_lastname').val(response.lastname);
      $('#edit_password').val(response.employee_id);
	  $('#seldepartment').val(response.department_id);
      $('#seldepartment').html(response.code);
      $('.del_stu').html(response.firstname+' '+response.lastname);
    }
  });
}
</script>
</body>
</html>
