
<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Verify</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="verify_edit.php">
                <input type="hidden" class="catid" name="id">
                <div class="form-group">
                    <label for="edit_name" class="col-sm-3 control-label"></label>

                    <div class="col-sm-9">
                      <input type="hidden" class="form-control" id="edit_name" name="employee_id" >
                    </div>
                </div>

				

	                <div class="form-group">
                    <label for="itemcode" class="col-sm-3 control-label">Item Code</label>

                    <div class="col-sm-9">
                      <select class="form-control" name="itemcode" id="item"required>
                       <option value="" selected id="itemcode"></option>
                        <?php
										   $sql1 = "SELECT * FROM tbl_inventory";
$result1=mysqli_query($conn2, $sql1);
while($row=mysqli_fetch_array($result1, MYSQLI_ASSOC))
{
     $itemben = $row['item'];
	 $itemben = $row['itemcode'];
	 
}
                         // $sql = "SELECT * FROM items where status = 0 order by depname asc";
						  $sql ="SELECT bipi_inventory.tbl_inventory.itemcode
FROM borrow LEFT JOIN bipi_inventory.tbl_inventory ON borrow.item_id = bipi_inventory.tbl_inventory.item
WHERE bipi_inventory.tbl_inventory.status='AVAILABLE' AND borrow.id='$vid'";
                          $query = $conn->query($sql);
                          while($wrow = $query->fetch_assoc()){
							  $ben  = $wrow['itemcode'];
					$ben2 = explode("-", $ben);
                            echo "
                              <option value='".$wrow['itemcode']."'>".$ben2[3]."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
									
                </div>
				<div class="form-group">
                    <label for="datepicker_edit" class="col-sm-3 control-label">Due Date</label>

                    <div class="col-sm-9">
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_edit" name="duedate"required>
                      </div>
                    </div>
                </div>
				                <div class="form-group">
                    <label for="loc" class="col-sm-3 control-label">Location</label>

                    <div class="col-sm-9">
                      <select class="form-control" name="loc" id="location"required>
                       <option value="" selected id="loc"></option>
                        <?php
                         // $sql = "SELECT * FROM items where status = 0 order by depname asc";
						  $sql ="SELECT * FROM location";
                          $query = $conn->query($sql);
                          while($wrow = $query->fetch_assoc()){
                            echo "
                              <option value='".$wrow['id']."'>".$wrow['loc']."</option>
                            ";
                          }
                        ?>
                      </select>
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

<div class="modal fade" id="down">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Down...</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="verify_down.php">
                <input type="hidden" class="dowid" name="id">
                <div class="text-center">
                    <p>DOWN THIS LINE UP</p>
                    <h2 id="act_dow" class="bold"></h2>
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

     