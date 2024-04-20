
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
				  <th>Date Request</th>
                  <th>Date Needed</th>
				  <th>Date Return</th>
				  <th>Name</th>
				  <th>Item</th>
				  <th>Item Code</th>
				  <th>Dept Name</th>
				  <th>Status</th>
				  <th><center>Actions</center></th>
                </thead>
                <tbody>
				              <?php
                $sql = "SELECT * FROM items where category_id = 1";
                $query = $conn->query($sql);

                echo "<h3>".'CPU'.$query->num_rows."</h3>";
              ?>
                    <?php
 
$sql ="SELECT *, borrow.id, employees.employee_id, borrow.date_borrow, employees.firstname, employees.lastname , department.depname, borrow.date_issued, borrow.due_date, borrow.status, category.name, borrow.item FROM borrow INNER JOIN employees ON borrow.employee_id = employees.id INNER JOIN department ON employees.department_id = department.id INNER JOIN category ON borrow.item_id = category.id LEFT JOIN items ON borrow.item_id = items.id WHERE borrow.status=1 ";         
		
		$query = $conn->query($sql);
               
						 while($row = $query->fetch_assoc()){
							 $id=$row['id'];
							 $categ=$row['name'];
							 
                      if($row['status']){
                        $status = '<span class="label label-info">reserved</span>';
                      }
                      else{
                        $status = '';
                      }
					  
                      echo "
 
                        <tr>
						  <td>".$row['id']."</td>
						  <td>".date('M d, Y', strtotime($row['date_borrow']))."</td>
                          <td>".date('M d, Y', strtotime($row['date_needed']))."</td>
						  <td>".date('M d, Y', strtotime($row['due_date']))."</td>				  
						  <td>".$row['firstname'].' '.$row['lastname']."</td>
						  
						  <td>".$categ."</td>
						  <td>".$row['item']."</td>
						  <td>".$row['depname']."</td>
						  <td><center>". $status."</center></td>
                          <td>

                            <center><button class='btn btn-info btn-sm activate btn-flat' data-id='".$id."'><i class='fa fa-desktop'></i> Activate</button>
							<button class='btn btn-danger btn-sm cancel btn-flat' data-id='".$id."'><i class='fa fa-desktop'></i> Cancel</button></center>
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
	  <?php include 'includes/verifyact_modal.php'; ?>

