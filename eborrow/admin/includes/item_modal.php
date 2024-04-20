<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add New Item</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="item_add.php">
          		  <div class="form-group">
                  	<label for="item" class="col-sm-3 control-label">Item Code</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="item" name="item" required>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="depname" class="col-sm-3 control-label">Dept Name</label>

                    <div class="col-sm-9">
                    <select class="form-control" name="depname" id="depname">
					<option value="" selected>- Select -</option>
				          <?php
                          $sql = "SELECT * FROM department";
                          $query = $conn->query($sql);
                          while($crow = $query->fetch_assoc()){
                            echo "
                              <option value='".$crow['code']."'>".$crow['code']."</option>
                            ";
                          }
                        ?>
                      </select>
				   </div>
                </div>
                <div class="form-group">
                    <label for="category" class="col-sm-3 control-label">Category</label>

                    <div class="col-sm-9">
                      <select class="form-control" name="category" id="category" required>
                        <option value="" selected>- Select -</option>
                        <?php
                          $sql = "SELECT * FROM category";
                          $query = $conn->query($sql);
                          while($crow = $query->fetch_assoc()){
                            echo "
                              <option value='".$crow['id']."'>".$crow['name']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="supplier" class="col-sm-3 control-label">Supplier</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="supplier" name="supplier">
                    </div>
                </div>
                <div class="form-group">
                    <label for="personne" class="col-sm-3 control-label">Personnel</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="personnel" name="personnel">
                    </div>
                </div>
                <div class="form-group">
                    <label for="datepicker_add" class="col-sm-3 control-label">Date Issued</label>

                    <div class="col-sm-9">
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_add" name="date_issued">
                      </div>
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
            	<h4 class="modal-title"><b>Edit Item</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="item_edit.php">
            		<input type="hidden" class="itemid" name="id">
                <div class="form-group">
                    <label for="edit_item" class="col-sm-3 control-label">Item Code</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_item" name="item">
                    </div>
                </div>
                       <div class="form-group">
                    <label for="depname" class="col-sm-3 control-label">Dept Name</label>

                    <div class="col-sm-9">
                    <select class="form-control" name="depname" id="depname">
                    <option value="" selected id="edit_depname"></option>
				          <?php
                          $sql = "SELECT * FROM department";
                          $query = $conn->query($sql);
                          while($crow = $query->fetch_assoc()){
                            echo "
                              <option value='".$crow['code']."'>".$crow['code']."</option>
                            ";
                          }
                        ?>
                      </select>
				   </div>
                </div>
				
				
				
                <div class="form-group">
                    <label for="category" class="col-sm-3 control-label">Category</label>

                    <div class="col-sm-9">
                      <select class="form-control" name="category" id="category">
                        <option value="" selected id="catselect"></option>
                        <?php
                          $sql = "SELECT * FROM category";
                          $query = $conn->query($sql);
                          while($crow = $query->fetch_assoc()){
                            echo "
                              <option value='".$crow['id']."'>".$crow['name']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_supplier" class="col-sm-3 control-label">Supplier</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_supplier" name="supplier">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_personnel" class="col-sm-3 control-label">Personnel</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_personnel" name="personnel">
                    </div>
                </div>
                <div class="form-group">
                    <label for="datepicker_edit" class="col-sm-3 control-label">Date Issued</label>

                    <div class="col-sm-9">
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_edit" name="date_issued">
                      </div>
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
            	<form class="form-horizontal" method="POST" action="item_delete.php">
            		<input type="hidden" class="itemid" name="id">
            		<div class="text-center">
	                	<p>DELETE ITEM</p>
	                	<h2 id="del_item" class="bold"></h2>
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


     