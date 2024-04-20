<?php 
date_default_timezone_set('Asia/Manila');
include 'includes/session.php'; ?>
<?php
	if(!isset($_SESSION['employee']) || trim($_SESSION['employee']) == ''){
		header('index.php');
	}

	$stuid = $employee['id'];
	$sql = "SELECT * FROM borrow LEFT JOIN items ON items.id=borrow.item_id WHERE employee_id = '$stuid' ORDER BY date_borrow DESC";
	$action = '';
	if(isset($_GET['action'])){
		$sql = "SELECT * FROM returns LEFT JOIN items ON items.id=returns.item_id WHERE employee_id = '$stuid' ORDER BY date_return DESC";
		$action = $_GET['action'];
	}

?>
<?php include 'includes/navbar.php'; ?>
<?php include 'includes/header.php'; ?>

<body class="hold-transition skin-blue layout-top-nav">
	
	  <div class="content-wrapper">


	      <!-- Main content -->


		<div class="row-fluid">
			<div class="col-md-12 main">
				<div class="col-sm-9 col-lg-10 col-md-10 col-lg-offset-2 col-md-offset-2 col-sm-offset-3">
				
				
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">Reservation</h1>
					</div>
				</div><!--/.row-->

				<div class="row">
					<div class="panel panel-default">
						<div class="panel-heading"><svg class="glyph stroked email"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-email"></use></svg> Make Reservation</div>
						<div class="panel-body">
							<form class="form-horizontal client_reservation" action="" >
								<fieldset>
									<div class="form-group">
										<label class="col-md-3 control-label" for="name">Items (maximum of 5 items)</label>
										<div class="col-md-9">
											<select class="form-control input-lg borrowitem" name="reserve_item[]" multiple="multiple" required="required" style="width: 100%">
												<option></option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label" for="email">Date </label>
										<div class="col-md-9">
											<input type="text" class="form-control datepicker" name="reserved_date" required="required">
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-md-3 control-label" for="message">Time</label>
										<div class="col-md-9">
											<input type="time" placeholder="" class="form-control" name="reserved_time" required="required">
											<input type="hidden" name="client_id" value="<?php echo $_SESSION['member_id']; ?>">
										</div>
									</div>
									<div class="form-group">
										<label  class="col-md-3 control-label">Select Room</label>
										<div class="col-md-9">
											<select class="form-control" name="reserve_room" required></select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Time Limit</label>
										<div class="col-md-9">
											<input name="time_limit" id="timeLimit" type="text" class="form-control" value="" />
										</div>
									</div>
									
									<!-- Form actions -->
									<div class="form-group">
										<div class="col-md-12 widget-right">
											<button type="submit" class="btn btn-primary btn-md pull-right">Make Reservation</button>
										</div>
									</div>
								</fieldset>
							</form>
						</div>
					</div>
				</div>
				

		
		</div>
	</div>
		
	     
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
<script type="text/javascript">
$(document).ready(function(){
	$("#timeLimit").datetimepicker({
		minTime: '<?php echo date("H:i"); ?>',
		maxTime: '18:00',
		minDate: 0,
		format:'Y-m-d h:i A',
		step: 15
	});
});
</script>
</body>
</html>