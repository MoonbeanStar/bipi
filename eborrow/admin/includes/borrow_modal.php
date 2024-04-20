<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add New Category</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="category_add.php">
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Name</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="name" name="name" required>
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
<div class="modal fade" id="editborrow">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Returned this Item.</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="borrow_edit.php">
                <input type="hidden" class="catid" name="id">
                <div class="form-group">
                    <label for="edit_name" class="col-sm-3 control-label"></label>

                    <div class="col-sm-9">
                      <input type="hidden" class="form-control" id="edit_name" name="employee_id" >
                    </div>
                </div>


				
		
					
						         <div class="form-group">
                    <label for="itemcoder" class="col-sm-3 control-label">Item Code</label>

                    <div class="col-sm-9">
                      <div class="date">
                        <input type="text" class="form-control" id="itemcoder" name="item"readonly>
                      </div>
                    </div>
                </div>
					
					
									
         
				
				         <div class="form-group">
                    <label for="datepicker_edit" class="col-sm-3 control-label">Due Date</label>

                    <div class="col-sm-9">
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_edit" name="duedate"readonly>
                      </div>
                    </div>
                </div>

					         <div class="form-group">
                    <label class="col-sm-3 control-label">Returned Remarks</label>

                    <div class="col-sm-9">
                      <div class="date">
                        <input type="text" class="form-control" id="returnremarks" name="rremarks"required>
                      </div>
                    </div>
                </div>
				
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> OK</button>
              </form>
            </div>
        </div>
    </div>
</div>


     