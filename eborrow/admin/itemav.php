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
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Item List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Items</li>
        <li class="active">Item List</li>
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
                  <th>Category</th>
                  <th>Item Code</th>
                  <th>Dept Name</th>
                  <th>Supplier</th>
                  <th>Personnel</th>
                  <th>Status</th>
                 
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT tbl_inventory.*, tbl_inventory.dept, tbl_inventory.classification
FROM tbl_inventory
WHERE tbl_inventory.dept ='mis' AND tbl_inventory.classification='mne' AND tbl_inventory.status='AVAILABLE'";
                    $query = $conn2->query($sql);
                    while($row = $query->fetch_assoc()){
						$ben  = $row['itemcode'];
					    $ben2 = explode("-", $ben);
                      echo "
                        <tr>
                          <td>".$row['item']."</td>
                          <td>".$ben2[3]."</td>
                          <td>".$row['dept']."</td>
                          <td>".$row['supplier']."</td>
                          <td>".$row['user']."</td>
                          <td>".$row['status']."</td>
                      
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

</div>
<?php include 'includes/scripts.php'; ?>

</body>
</html>
