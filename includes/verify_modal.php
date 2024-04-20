
<!-- Edit -->
<div class="modal fade" id="editg">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>For Guard Approval....</b></h4>
            </div>
			       <div class="text-center">
                    <p>APPROVED THIS LINE UP</p>
                    <font size=50><h1 id="act_cat" class="bold"></h1></font>
                </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="verify_editg.php">
                <input type="hidden" class="catid" name="id">
                <div class="form-group">
                    <label for="edit_name" class="col-sm-3 control-label"></label>

                    <div class="col-sm-9">
                      <input type="hidden" class="form-control" id="edit_name" name="employee_id" >
                    </div>
                </div>
				
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Approved</button>
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
              <h4 class="modal-title"><b>For MIS Approval....</b></h4>
            </div>
			       <div class="text-center">
                    <p>APPROVED THIS LINE UP</p>
                    <h2 id="act_mis" class="bold"></h2>
                </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="verify_edit.php">
                <input type="hidden" class="misid" name="id">
                <div class="form-group">
                    <label for="editm_name" class="col-sm-3 control-label"></label>

                    <div class="col-sm-9">
                      <input type="hidden" class="form-control" id="editm_name" name="employee_id" >
                    </div>
                </div>


				<div class="form-group">
                    <label for="datepicker_edit" class="col-sm-3 control-label">Due Date</label>

                    <div class="col-sm-9">
                      <div class="date">
                        <input type="date" class="form-control" id="datepicker_edit" name="duedate"required>
                      </div>
                    </div>
                </div>

				
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Approved</button>
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
              <form class="form-horizontal" method="POST" action="verify_delete.php">
                <input type="hidden" class="catid" name="id">
                <div class="text-center">
                    <p>DELETE THIS ITEM</p>
                    <h2 id="del_cat" class="bold"></h2>
                </div>
            </div>
			
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> OK</button>
              </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="cancel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Cancel...</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="verify_cancel.php">
                <input type="hidden" class="canid" name="id">
                <div class="text-center">
                    <p>CANCEL THIS LINE UP</p>
                    <h2 id="act_can" class="bold"></h2>
                </div>
     			 			<div class="form-group">
                    <label for="cancelremarks" class="col-sm-3 control-label">Remarks</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" name="cancelremarks" id="cancel_remarks" required></textarea>
                    </div>
                </div>

				</div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-info btn-flat" name="cancel"><i class="fa fa-desktop"></i> OK</button>
              </form>
            </div>
        </div>
    </div>
	</div>
	

<div class="modal fade" id="cancelm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Cancel...</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="verify_cancelm.php">
                <input type="hidden" class="cancelid" name="id">
                <div class="text-center">
                    <p>CANCEL THIS LINE UP</p>
                    <h2 id="act_canm" class="bold"></h2>
                </div>
     

				</div>
				 			<div class="form-group">
                    <label for="cancelremarks" class="col-sm-3 control-label">Remarks</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" name="cancelremarks" id="cancel_remarks" required></textarea>
                    </div>
                </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-info btn-flat" name="cancelm"><i class="fa fa-desktop"></i> OK</button>
              </form>
            </div>
        </div>
    </div>
	</div>
     