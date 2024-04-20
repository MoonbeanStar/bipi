<header class="main-header">
  <nav class="navbar navbar-static-top">
    <div class="container">
      <div class="navbar-header">
        <a href="#" class="navbar-brand"><b>MIS</b>BorrowingSystem</a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
          <i class="fa fa-bars"></i>
        </button>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
        <ul class="nav navbar-nav">
          <?php
            if(isset($_SESSION['employee'])){
              echo "
                <li><a href='outside.php'>HOME</a></li>
                <li><a href='outside.php'>TRANSACTION</a></li>
				<li><a href='verify.php'>VERIFY</a></li>
				
              ";
            } 
          ?>
        </ul>
      </div>
      <!-- /.navbar-collapse -->
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <?php
            if(isset($_SESSION['employee'])){
              $photo = (!empty($employee['photo'])) ? 'images/'.$employee['photo'] : 'images/profile.jpg';
              echo "
                <li class='user user-menu'>
                  <a href='#'>
                    <img src='".$photo."'  width='50px' height='50px' class= 'img-circle' alt='Passport'>
                    
                  </a>
                </li>
                  <li><a href='logout.php'><h4><font color='yellow'><span class='hidden-xs'>".$employee['firstname'].' '.$employee['lastname']."</span></font></h4>    <i class='fa fa-sign-out'></i> LOGOUT</a></li>
				
              ";
            }
            else{
              echo "
			    <li><a href='#guard' data-toggle='modal'><i class='fa fa-sign-in'></i> Guard</a></li>
                <li><a href='#login' data-toggle='modal'><i class='fa fa-sign-in'></i> User Login</a></li>
                <li><a href='admin/' data-toggle='modal'><i class='fa fa-sign-in'></i> ADMIN</a></li>
              
			  ";
            } 
          ?>
        </ul>
      </div>
      <!-- /.navbar-custom-menu -->
    </div>
    <!-- /.container-fluid -->
  </nav>
</header>
<?php include 'includes/login_modal.php'; ?>