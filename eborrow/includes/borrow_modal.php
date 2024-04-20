<?php
if(!isset($conn)){
  include 'includes/conn.php';
}
?>

<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Borrow Items</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="borrow_add.php">
          		  <div class="form-group">
                  	<label for="employee" class="col-sm-3 control-label">Employee Name</label>

                  	<div class="col-sm-9">
                    	<!-- <input type="text" class="form-control" id="employee" name="employee" required> -->
                      <select class="form-control" name="employee" id="employee" required="">
                        <option value="" selected="" disabled=""> Please Select Employee Here.</option>
                        <?php  
                            $sql = "SELECT * FROM employees WHERE id = '".$_SESSION['employee']."'";
							
                            $qry = $conn->query($sql);
                            while($row = $qry->fetch_array()):
                        ?>
                          <option value="<?php echo $row['employee_id'] ?>"><?php echo ucwords($row['firstname'].' '.$row['lastname']) ?></option>
                        <?php endwhile;  ?>
                      </select>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="item" class="col-sm-3 control-label">Item</label>

                    <div class="col-sm-9">
                      <!-- <input type="text" class="form-control" id="item" name="item[]" required> -->
                       <select class="form-control" name="item[]" required>
                        <option value="" selected="" disabled=""> Please Select Item Here.</option>
                        <?php  
                            $items = "SELECT tbl_inventory.item, tbl_inventory.dept, tbl_inventory.classification
FROM tbl_inventory
GROUP BY tbl_inventory.item, tbl_inventory.dept, tbl_inventory.classification
HAVING (((tbl_inventory.dept)='mis') AND ((tbl_inventory.classification)='mne'))";
                            
							$b_qry = $conn2->query($items);
                            $brows=array();
                            while($row = $b_qry->fetch_array()):
                               $brows[] = $row;
                        ?>
                          <option value="<?php echo $row['item'] ?>"><?php echo ucwords($row['item'])?></option>
                        <?php endwhile;  ?>
                      </select>
                    </div>
				</div>
                <span id="append-div"></span>
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                      <button class="btn btn-primary btn-xs btn-flat" id="append"><i class="fa fa-plus"></i> Item Field</button>
                    </div>
					
                </div>
				<div class="form-group">
                    <label for="datepicker_edit" class="col-sm-3 control-label">Date Needed</label>

                    <div class="col-sm-9">
                      <div class="date">
                        <input type="date" class="form-control" id="datepicker_edit" name="dateneeded" required>
                      </div>
                    </div>
                </div>
								         <div class="form-group">
                    <label for="datepicker_editreturn" class="col-sm-3 control-label">Date Return</label>

                    <div class="col-sm-9">
                      <div class="date">
                        <input type="date" class="form-control" id="datepicker_editreturn" name="datereturn" required>
                      </div>
                    </div>
                </div>
				<div class="form-group">
                    <label for="remarks" class="col-sm-3 control-label">Purpose</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" name="remarks" id="remarks" required></textarea>
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Edit Reserved</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="borrow_edit.php">
                <input type="hidden" class="catid" name="id">

			<div class="form-group">
                    <label for="edit_remarks" class="col-sm-3 control-label">Purpose</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" name="remarks" id="edit_remarks" required></textarea>
                    </div>
                </div>
  		      <div class="form-group">
                    <label for="catselect" class="col-sm-3 control-label">Category</label>

                    <div class="col-sm-9">
                      <select class="form-control" name="item_id" id="catselect">
                        <option value="" selected id="catselect"></option>
                        <?php
                          $sql = "SELECT tbl_inventory.item, tbl_inventory.dept, tbl_inventory.classification
FROM tbl_inventory
GROUP BY tbl_inventory.item, tbl_inventory.dept, tbl_inventory.classification
HAVING (((tbl_inventory.dept)='mis') AND ((tbl_inventory.classification)='mne'))";
                          $query = $conn2->query($sql);
                          while($crow = $query->fetch_assoc()){
                            echo "
                              <option value='".$crow['item']."'>".$crow['item']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
			<div class="form-group">
                    <label for="dateneeded_edit" class="col-sm-3 control-label">Date Needed</label>

                    <div class="col-sm-9">
                      <div class="date">
                        <input type="date" class="form-control" id="dateneeded_edit" name="date_needed">
                      </div>
                    </div>
                </div>	
            		<div class="form-group">
                    <label for="datereturn_edit" class="col-sm-3 control-label">Date Return</label>

                    <div class="col-sm-9">
                      <div class="date">
                        <input type="date" class="form-control" id="datereturn_edit" name="date_return">
                      </div>
                    </div>
                </div>				
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Deleting...</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="borrow_delete.php">
                <input type="hidden" class="catid" name="id">
                <div class="text-center">
                    <p>DELETE LINE UP</p>
                    <h2 id="del_cat" class="bold"></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
              </form>
            </div>
        </div>
    </div>
</div>