<!-- Activate -->
<div class="modal fade" id="activate">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Activate...</b></h4>
            </div>
			
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="verify_activate.php">
                <input type="hidden" class="canid" name="id">
                <div class="text-center">
                    <p>ACTIVATE THIS LINE UP</p>
                    <h2 id="act_cat" class="bold"></h2>
                </div>
            </div>
          <div class="form-group">
                    <label for="remarks" class="col-sm-2 control-label">Purpose</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" name="remarks" id="remarks" readonly></textarea>
                    </div>
                </div>
				
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-info btn-flat" name="activate"><i class="fa fa-desktop"></i> OK</button>
              </form>
            </div>
			
        </div>
    </div>
</div>

<!-- Cancel -->
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
                    <label for="statap" class="col-sm-3 control-label">Remarks</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" name="statap" id="statap" required></textarea>
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
	




