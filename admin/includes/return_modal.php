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
            	<h4 class="modal-title"><b>Return Items</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="return_add.php">
          		  <div class="form-group">
                  	<label for="employee" class="col-sm-3 control-label">Employee ID</label>

                  	<div class="col-sm-9">
                    	<!-- <input type="text" class="form-control" id="employee" name="employee" required> -->
                       <select class="form-control" name="employee" id="employee" required="">
                        <option value="" selected="" disabled=""> Please Select Employee Here.</option>
                        <?php  
                            $sql = "SELECT * FROM employees order by concat(firstname,' ',lastname) asc ";
                            $qry = $conn->query($sql);
                            while($row = $qry->fetch_array()):
                        ?>
                          <option value="<?php echo $row['employee_id'] ?>"><?php echo ucwords($row['firstname'].' '.$row['lastname']) . ' ['.$row['employee_id'].']' ?></option>
                        <?php endwhile;  ?>
                      </select>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="item" class="col-sm-3 control-label">Item</label>

                    <div class="col-sm-9">
                      <!-- <input type="text" class="form-control" id="item" name="item[]" required> -->
                      <select class="form-control" name="item[]" >
                        <option value="" selected="" disabled=""> Please Select Item Here.</option>
                        <?php  
                            $items = "SELECT * FROM items where status = 1 order by depname asc ";
                            $b_qry = $conn->query($items);
                            $brows=array();
                            while($row = $b_qry->fetch_array()):
                               $brows[] = $row;
                        ?>
                          <option value="<?php echo $row['item'] ?>"><?php echo ucwords($row['depname']) . ' ['.$row['item'].']' ?></option>
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
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
            	</form>
          	</div>
        </div>
    </div>
</div>