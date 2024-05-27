<?php
if(!isset($conn)){
  include 'includes/conn.php';
}
?>

<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" >
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Shipping Notice</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="schedule_add.php" enctype="multipart/form-data">
                    
                <h5><b>SCHEDULE</b></h5>
                <div class="form-group">
                    <label for="ans_no" class="col-sm-3 control-label">ANS Number</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="ans_no" name="ans_no" value="<?php echo generateANS(); ?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                  	<label for="supplier" class="col-sm-3 control-label">Supplier Name</label>

                  	<div class="col-sm-9">
                    	<!-- <input type="text" class="form-control" id="employee" name="employee" required> -->
                      <select class="form-control" name="supplier" id="supplier" required="">
                        <option value="" selected="" disabled=""> Please Select Supplier Here.</option>
                        <?php  
                            $sql = "SELECT * FROM supplier WHERE id = '".$_SESSION['supplier']."'";
							
                            $qry = $conn->query($sql);
                            while($row = $qry->fetch_array()):
                        ?>
                          <option value="<?php echo $row['supplier_id'] ?>"><?php echo ucwords($row['firstname'].' '.$row['lastname']) ?></option>
                        <?php endwhile;  ?>
                      </select>
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
        

            <h5><b>INFORMATION</b></h5>    
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Item Category:</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="name" name="name" required>
                            <option value="" selected disabled>Please Select Item Here.</option>
                            <?php
                            $sql = "select * from category";
                            $result=mysqli_query($conn,$sql);

                            while($data=mysqli_fetch_array($result))
                            {?>
                            <option value="<?php echo $data['id']?>"><?php echo $data['name'];?></option>
                            <?php
                            } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="itemType" class="col-sm-3 control-label">Item Type:</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="itemType" name="itemType" required>
                            <option value="" selected disabled>Please Select Item Here.</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                <label for="drPhoto" class="col-sm-3 control-label">Upload DR Photo:</label>
                <div class="col-sm-9">
                    <input type="file" id="drPhoto" name="drPhoto" accept=".jpg, .jpeg, .png, .gif" required>
                    <br>
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
                                for ($i = 0; $i <= $totalDel; $i++) {
                                    echo "<option value='$i'>$i</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-6"> <!-- Adjust the column size as needed -->
                            <select class="form-control" id="uom1Name" name="uom1Name" required>
                            <option value="" selected disabled>Please Select Here.</option>
                            <?php  
                                 $package = "SELECT id, uom1Name FROM package";
                                 $result = $conn->query($package);
             
                                 // Loop through fetched data and generate options
                                 if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row['id'] . "'>" . ucwords($row['uom1Name']) . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>No package type available</option>";
                                }
                            ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <span id="append"></span>
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                      <button class="btn btn-primary btn-xs btn-flat" id="append-div"><i class="fa fa-plus"></i>Add No.</button>
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
                                    for ($i = 0; $i <= $totalQty; $i++) {
                                        echo "<option value='$i'>$i</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6"> <!-- Adjust the column size as needed -->
                                <select class="form-control" id="uom2Name" name="uom2Name" required>
                                <option value="" selected disabled>Please Select Here.</option>
                                    <?php  
                                        $quantity = "SELECT id, qtyname FROM quantity";
                                        $result = $conn->query($quantity);
                    
                                        // Loop through fetched data and generate options
                                        if ($result->num_rows > 0) {
                                           while ($row = $result->fetch_assoc()) {
                                               echo "<option value='" . $row['id'] . "'>" . ucwords($row['qtyname']) . "</option>";
                                           }
                                       } else {
                                           echo "<option value=''>No quantity available</option>";
                                       }
                                     ?>
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
                 
                    <div class="form-group">
                        <label for="plateNo" class="col-sm-3 control-label">Plate No.:</label>
                        <div class="col-sm-9"> 
                            <input type="text" class="form-control" id="plateNo" name="plateNo">
                        </div>
                    </div>
              
                    <div class="form-group">
                        <label for="driverName" class="col-sm-3 control-label">Driver Name:</label>
                        <div class="col-sm-9"> 
                            <input type="text" class="form-control" id="driverName" name="driverName">
                        </div>
                    </div>
            
                    <div class="form-group">
                        <label for="helperName" class="col-sm-3 control-label">Helper Name:</label>
                        <div class="col-sm-9"> 
                            <input type="text" class="form-control" id="helperName" name="helperName">
                        </div>
                    </div>
                    <span id="append-div"></span>
                    <div class="form-group">
                        <div class="col-sm-9 col-sm-offset-3">
                        <button type="button" class="btn btn-primary btn-xs btn-flat" id="addVehicle"><i class="fa fa-plus"></i>Add Vehicle</button>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i>Close</button>
                    <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i>Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

        <!-- View -->
        <div class="modal fade" id="view">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><b>Schedule Details</b></h4>
                        </div>
                        <div class="modal-body">
                        <form class="form-horizontal" method="POST" action="schedule_view.php">
                            <input type="hidden" class="catid" name="id">

                        <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Edit -->
            <div class="modal fade" id="edit">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><b>Edit Reserved</b></h4>
                        </div>
                        <div class="modal-body">
                        <form class="form-horizontal" method="POST" action="schedule_edit.php">
                            <input type="hidden" class="catid" name="id">

                        <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                        <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Delete Modal -->
            <div class="modal fade" id="delete">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><b>Deleting...</b></h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" method="POST" action="schedule_delete.php">
                                <input type="hidden" class="catid" name="id">
                                <div class="text-center">
                                    <p>DELETE LINE UP</p>
                                    <h2 id="del_cat" class="bold"></h2>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                            <button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
                        </div>
                    </div>
                </div>
            </div>
                     
                    