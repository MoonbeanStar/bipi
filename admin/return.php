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
        Borrowed Items
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Transaction</li>
        <li class="active">Borrow</li>
      </ol>
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
            <!--<div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Borrow</a>
            </div>-->
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead bgcolor='Lavender' style='color: black;'>
                  <th>Date Request</th>
                  <th>Date Issued</th>
				  <th>Due Date</th>
				  <th>Name</th>
				  <th>Item</th>
				  <th>Item Code</th>
				  <th>Dept Name</th>
				  <th>Status</th>
				  <th>Location</th>
				  
				  <th>Over Due</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT location.loc, borrow.id, employees.employee_id, borrow.date_borrow, employees.firstname, employees.lastname , department.depname, borrow.date_issued,borrow.date_return, borrow.due_date, borrow.status, category.name, borrow.item FROM borrow INNER JOIN employees ON borrow.employee_id = employees.id INNER JOIN department ON employees.department_id = department.id INNER JOIN category ON borrow.item_id = category.id INNER JOIN location ON borrow.location=location.id LEFT JOIN items ON borrow.item_id = items.id WHERE borrow.status =3 ";
				
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
						$date1=date_create($row['due_date']);
						$date2=date_create($row['date_return']);
						$diff=date_diff($date1,$date2);
						
                      if($row['status']!=3){
                        $returned = '<span class="label label-danger">not returned</span>';
					
                      }
                      else{
                        $returned = '<span class="label label-success">returned date</span>';
						
                      }
                      echo "
                        <tr>
                          <td>".date('M d, Y', strtotime($row['date_borrow']))."</td>
                          <td>".date('M d, Y', strtotime($row['date_issued']))."</td>
						  <td>".date('M d, Y', strtotime($row['due_date']))."</td>							  
						  <td>".$row['firstname'].' '.$row['lastname']."</td>
						  <td>".$row['name']."</td>
						  <td>".$row['item']."</td>
						  <td>".$row['depname']."</td>
						  <td>". $returned.' '.date('M d, Y', strtotime($row['date_return']))."</td>
						   <td>".$row['loc']."</td>
						   <td>
							".$diff->format('<font color ="red">%R%a days</font>')."
							
                    
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
  <?php include 'includes/borrow_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>

</body>
</html>
