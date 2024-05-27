<?php include 'includes/session.php'; ?>
<?php
	$where = '';
	if(isset($_GET['category'])){
		$catid = $_GET['category'];
		$where = 'WHERE category_id = '.$catid;
	}
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-20 col-sm-offset-0">
	        		<?php
	        			if(isset($_SESSION['error'])){
	        				echo "
	        					<div class='alert alert-danger'>
	        						".$_SESSION['error']."
	        					</div>
	        				";
	        				unset($_SESSION['error']);
	        			}
	        		?>
	        		<div class="box">
	        			<div class="box-header with-border">
	        				<div class="input-group">
				                <input type="text" class="form-control input-lg" id="searchBox" placeholder="Search for ITEM, Dept Name or Borrower">
				                <span class="input-group-btn">
				                    <button type="button" class="btn btn-primary btn-flat btn-lg"><i class="fa fa-search"></i> </button>
				                </span>
				            </div>
	        			</div>
	        			<div class="box-body">
	        				<div class="input-group col-sm-5">
				                <span class="input-group-addon">Category:</span>
				                <select class="form-control" id="catlist">
				                	<option value=0>ALL</option>
				                	<?php
				                		$sql = "SELECT * FROM category";
				                		$query = $conn->query($sql);
				                		while($catrow = $query->fetch_assoc()){
				                			$selected = ($catid == $catrow['id']) ? " selected" : "";
				                			echo "
				                				<option value='".$catrow['id']."' ".$selected.">".$catrow['name']."</option>
				                			";
				                		}
				                	?>
				                </select>
				             </div>
	        				
	        			</div>
	        		</div>
	        	</div>
	        </div>
	      </section>
	     
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
	$('#catlist').on('change', function(){
		if($(this).val() == 0){
			window.location = 'index.php';
		}
		else{
			window.location = 'index.php?category='+$(this).val();
		}
		
	});
});
</script>
</body>
</html>