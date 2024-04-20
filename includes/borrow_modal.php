<?php
if(!isset($conn)){
  include 'includes/conn.php';
}
?>

<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content" style: "width: 80%; margin: 0 auto;" >
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Shipping Notice</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="borrow_add.php">
                    
                <h5><b>SCHEDULE:</b></h5>
                <div class="form-group">
                    <label for="supplier" class="col-sm-3 control-label">Supplier Name:</label>
                    <div class="col-sm-9"> 
                        <input type="text" class="form-control" id="supplier" name="supplier" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="datepicker_edit" class="col-sm-3 control-label">Delivery Date:</label>
                    <div class="col-sm-9">
                        <div class="date">
                            <input type="date" class="form-control" id="datepicker_edit" name="delDate" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="delTime" class="col-sm-3 control-label">Delivery Time:</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="delTime" name="delTime" required>
                                    <option value="" selected disabled>Please Select Delivery Time</option>
                                    <?php
                                        $delivery_times = array("6AM", "8AM", "10AM", "1PM", "3PM");
                                        // Assuming $selected_delivery_time is an array containing delivery times already selected
                                        foreach ($delivery_times as $time) {
                                            if (in_array($time, $selected_delivery_time)) {
                                                echo '<option value="' . $time . '" disabled>' . $time . '</option>';
                                            } else {
                                                echo '<option value="' . $time . '">' . $time . '</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                    </div>
            </div>
        

            <h5><b>INFORMATION</b></h5>    
                <div class="form-group">
                    <label for="itemCat" class="col-sm-3 control-label">Item Category:</label>
                    <div class="col-sm-9" style="margin-bottom: 20px">
                        <select class="form-control" name="itemCat" required>
                            <option value="" selected disabled>Please Select Item Here.</option>
                            <?php  
                                $items = "SELECT category.id, category.name FROM category INNER JOIN items ON category.id = items.category_id GROUP BY category.id, category.name ORDER BY category.name";
                                $b_qry = $conn->query($items);
                                $brows=array();
                                while($row = $b_qry->fetch_array()):
                                  $brows[] = $row;
                            ?>
                            <option value="<?php echo $row['id'] ?>"><?php echo ucwords($row['name'])?></option>
                            <?php endwhile;  ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="itemType" class="col-sm-3 control-label">Item Type:</label>
                    <div class="col-sm-9 mb-4">
                        <select class="form-control" name="itemType" required>
                            <option value="" selected disabled>Please Select Item Here.</option>
                            <?php  
                            ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                <label for="dr_photo" class="col-sm-3 control-label">Upload DR Photo:</label>
                <div class="col-sm-9">
                    <input type="file" class="form-control-file" id="dr_photo" name="dr_photo" accept="image/*" required>
                </div>
            </div>
     
            <h5><b>SUMMARY:</b></h5>  
            <div class="form-group">
                <label for="ttl_dr" class="col-sm-3 control-label">Total No. of DR:</label>
                <div class="col-sm-9" style="margin-bottom: 20px"> 
                    <select class="form-control" id="ttl_dr" name="ttl_dr" required>
                        <?php
                        // PHP code to generate dropdown options
                        $total_dr = 10; // Total number of DR, you can replace it with your actual value or fetch it from a database
                        for ($i = 1; $i <= $total_dr; $i++) {
                            echo "<option value='$i'>$i</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="totalDel" class="col-sm-3 control-label">Total No. of Delivery:</label>
                <div class="col-sm-9"> 
                    <div class="row">
                        <div class="col-sm-6"> <!-- Adjust the column size as needed -->
                            <select class="form-control" id="totalDel" name="totalDel" required>
                                <?php
                                // PHP code to generate dropdown options
                                $totalDel = 50; // Total number of DR, you can replace it with your actual value or fetch it from a database
                                for ($i = 1; $i <= $totalDel; $i++) {
                                    echo "<option value='$i'>$i</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-6"> <!-- Adjust the column size as needed -->
                            <select class="form-control" id="uom_dropdown" name="uom_dropdown" required>
                                <option value="boxes">boxes</option>
                                <option value="pails">pails</option>
                                <option value="drum">drum</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <span id="append-div"></span>
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                      <button class="btn btn-primary btn-xs btn-flat" id="append"><i class="fa fa-plus"></i>Add No.</button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="totalQty" class="col-sm-3 control-label">Total Quantity:</label>
                    <div class="col-sm-9"> 
                        <div class="row">
                            <div class="col-sm-6"> <!-- Adjust the column size as needed -->
                                <select class="form-control" id="totalQty" name="totalQty" required>
                                    <?php
                                    // PHP code to generate dropdown options
                                    $totalQty = 10; // Total number of DR, you can replace it with your actual value or fetch it from a database
                                    for ($i = 1; $i <= $totalQty; $i++) {
                                        echo "<option value='$i'>$i</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6"> <!-- Adjust the column size as needed -->
                                <select class="form-control" id="uomDropdown" name="uomDropdown" required>
                                    <option value="kg">kg</option>
                                    <option value="pcs">pcs</option>
                                    <option value="prs">prs</option>
                                    <option value="packs">packs</option>
                                    <!-- Add more options as needed -->
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            <span id="append-div-qty"></span>
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                      <button class="btn btn-primary btn-xs btn-flat" id="append_qty"><i class="fa fa-plus"></i>Add Quantity</button>
                    </div>
                </div>

                <h5><b>VEHICLE DETAILS<b></h5>
                <div class="form-group">
                    <label for="vehicleModel" class="col-sm-3 control-label">Vehicle Model:</label>
                    <div class="col-sm-9"> 
                        <input type="text" class="form-control" id="vehicleModel" name="vehicleModel">
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="plateNo" class="col-sm-3 control-label">Plate No.:</label>
                    <div class="col-sm-9"> 
                        <input type="text" class="form-control" id="plateNo" name="plateNo">
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="driverName" class="col-sm-3 control-label">Driver Name:</label>
                    <div class="col-sm-9"> 
                        <input type="text" class="form-control" id="driverName" name="driverName">
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="helperName" class="col-sm-3 control-label">Helper Name:</label>
                    <div class="col-sm-9"> 
                        <input type="text" class="form-control" id="helperName" name="helperName">
                    </div>
                </div>
                <br>
                <span id="append-div"></span>
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                    <button type="button" class="btn btn-primary btn-xs btn-flat" id="addVehicle"><i class="fa fa-plus"></i>Add Vehicle</button>
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
                    