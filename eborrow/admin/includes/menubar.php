<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo (!empty($user['photo'])) ? '../images/'.$user['photo'] : '../images/profile.jpg'; ?>" class="img-square" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $user['firstname'].' '.$user['lastname']; ?></p>
        <a><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
	
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">REPORTS</li>
      <li class=""><a href="home.php"><span>Dashboard</span></a></li>
      <li class="header">MANAGE</li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-refresh"></i>
          <span>Item Transaction</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="borrow.php"> Borrow Item</a></li>
          <li><a href="return.php"> Return Item</a></li>
		  <li><a href="verify.php"> Reserved Item</a></li>
		  <li><a href="location.php"> Location Item</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-desktop"></i>
          <span>Items</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="item.php">List</a></li>
		  <li><a href="itemav.php"> Available</a></li>
          <li><a href="category.php"> Category</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-users"></i>
          <span>Employees</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="employee.php"> Employee List</a></li>
          <li><a href="department.php"> Department</a></li>
        </ul>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>