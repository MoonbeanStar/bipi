<header class="main-header">
  <nav class="navbar navbar-static-top">
    <div class="container">
      <div class="navbar-header">
        <a href="#" class="navbar-brand"><b>ANS</b>  System</a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
          <i class="fa fa-bars"></i>
        </button>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
        <ul class="nav navbar-nav">
          <?php
            if(isset($_SESSION['supplier'])){
              echo "
                <li><a href='index.php'>HOME</a></li>
                <li><a href='sched_history.php'>HISTORY</a></li>
				        <li><a href='schedule.php'>RESERVED</a></li>
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
            if(isset($_SESSION['supplier'])){
              $photo = (!empty($supplier['photo'])) ? 'images/'.$supplier['photo'] : 'images/profile.jpg';
              echo "
                <li class='user user-menu'>
                  <a href='#'>
                    <img src='".$photo."' class='user-image' alt='User Image'>
                    <span class='hidden-xs'>".$supplier['firstname'].' '.$supplier['lastname']."</span>
                  </a>
                </li>
                <li><a href='logout.php'><i class='fa fa-sign-out'></i> LOGOUT</a></li>
              ";
            }
            else{
              echo "
			    <li><a href='#guard' data-toggle='modal'><i class='fa fa-sign-in'></i> Guard</a></li>
                <li><a href='#login' data-toggle='modal'><i class='fa fa-sign-in'></i> Supplier Login</a></li>
				<li><a href='#mis' data-toggle='modal'><i class='fa fa-sign-in'></i> Head Login</a></li>
               <!--<li><a href='admin/' data-toggle='modal'><i class='fa fa-sign-in'></i> ADMIN</a></li>-->
              
			  ";
            } 
          ?>
        </ul>x
      </div>
      <!-- /.navbar-custom-menu -->
    </div>
    <!-- /.container-fluid -->
  </nav>
</header>
<?php include 'includes/login_modal.php'; ?>