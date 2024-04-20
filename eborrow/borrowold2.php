<?php include 'includes/session.php'; ?>
<?php
	if(!isset($_SESSION['employee']) || trim($_SESSION['employee']) == ''){
		header('index.php');
	}

	$stuid = $employee['id'];
	$sql = "SELECT * FROM borrow LEFT JOIN items ON items.id=borrow.item_id WHERE employee_id = '$stuid' ORDER BY date_borrow DESC";
	$action = '';
	
	if(isset($_GET['action'])){
		$sql = "SELECT * FROM returns LEFT JOIN items ON items.id=returns.item_id WHERE employee_id = '$stuid' ORDER BY date_return DESC";
		$action = $_GET['action'];
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
                <thead>
                  <th class="hidden"></th>
                  <th>Date</th>
                  <th>Employee ID</th>
                  <th>Name</th>
                  <th>Item</th>
                  <th>Dept Name</th>
                  <th>Status</th>
                </thead>
                <tbody>
				
                  <?php
					$stuid = $employee['id'];
                    $sql = "SELECT *, employees.employee_id AS stud, borrow.status AS barstat FROM borrow LEFT JOIN employees ON employees.id=borrow.employee_id LEFT JOIN items ON items.id=borrow.item_id LEFT JOIN category on category.id =borrow.item_id LEFT JOIN department on department.id=employees.department_id WHERE employees.id = '$stuid' ORDER BY date_borrow DESC";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      if($row['barstat']){
                        $status = '<span class="label label-success">returned</span>';
                      }
                      else{
                        $status = '<span class="label label-info">Reserved</span>';
                      }
                      echo "
                        <tr>
                          <td class='hidden'></td>
                          <td>".date('M d, Y', strtotime($row['date_borrow']))."</td>
                          <td>".$row['stud']."</td>
                          <td>".$row['firstname'].' '.$row['lastname']."</td>
                          <td>".$row['name']."</td>
                          <td>".$row['depname']."</td>
                          <td>".$status."</td>
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
<script>
  function rem_select(){
    $('[name="item[]"]').change(function(){
      if($(this).val() == '<rem>'){
        $(this).closest('.form-group').remove()
      }
    })
  }
$(function(){
  $(document).on('click', '#append', function(e){
    e.preventDefault();
    var category = '<?php echo json_encode($brows) ?>';
    var _s = $('<select class="form-control" name="item[]"></select>')
    var _tmp = $('<div></div>')
    var option = '';
        option += '<option value="" selected disabled>Please Select Item here.</option>';
        option += '<option value="<rem>" >< remove select></option>';
        category = JSON.parse(category)
        if(category.length > 0){
          Object.keys(category).map(k=>{
            option  += '<option value="'+category[k].id+'">'+category[k].name+' ['+category[k].id+']'+'</option>'
          })
        }
        _s.append(option)
        _tmp.append(_s)
    
    // $('#append-div').append(
    //   '<div class="form-group"><label for="" class="col-sm-3 control-label">ITEM</label><div class="col-sm-9"><input type="text" class="form-control" name="item[]"></div></div>'
    // );
    $('#append-div').append(
      '<div class="form-group"><label for="" class="col-sm-3 control-label">ITEM</label><div class="col-sm-9">'+_tmp.html()+'</div></div>'
    );
    rem_select()
  });
});

</script>
</body>
</html>
