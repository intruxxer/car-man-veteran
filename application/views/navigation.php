<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      <a class="navbar-brand" href="<?php echo base_url() ?>"><span class="glyphicon glyphicon-home"></span>&nbsp;CMAS</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <?php
          if($role == 'Admin')
          {
        ?>
        <!-- IF ADMINISTRATOR-->
        <li class="dropdown">
          <a href="<?php echo base_url('booking') ?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Bookings<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo base_url('booking/request') ?>">Book A Vehicle</a></li>
            <li><a href="<?php echo base_url('booking') ?>">All Booking Request</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url('booking/pending') ?>">By Pending Approval</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url('booking/bytoday') ?>">By Today</a></li>
            <li><a href="<?php echo base_url('booking/bythisweek') ?>">By This Week</a></li>
            <li><a href="<?php echo base_url('booking/bythismonth') ?>">By This Month</a></li>
            <li><a href="<?php echo base_url('booking/searchbydate') ?>">By Specific Period</a></li>
          </ul>
        </li>
        <!-- ENDIIF ADMINISTRATOR-->
        <?php } ?>

        <!-- IF NORMAL USER-->
        <?php
          if($role != 'Admin')
          {
        ?>
        <li class="dropdown">
          <a href="<?php echo base_url('booking') ?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Bookings<span class="caret"></span></a>
          <!-- IF NORMAL USER-->
           <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo base_url('booking/request') ?>">Book A Vehicle</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url('booking') ?>">All Booking Request</a></li>
            <li><a href="<?php echo base_url('booking/userid/'.$this->session->userdata('userid')) ?>">My Booking Request</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url('booking/bytoday') ?>">By Today</a></li>
            <li><a href="<?php echo base_url('booking/bythisweek') ?>">By This Week</a></li>
            <li><a href="<?php echo base_url('booking/bythismonth') ?>">By This Month</a></li>
            <li><a href="<?php echo base_url('booking/searchbydate') ?>">By Specific Period</a></li>
          </ul>
        </li>
        <?php } ?>
        <!-- ENDIF NORMAL USER-->
        <?php
          if($role == 'Admin')
          {
        ?>
        <li class="dropdown">
          <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Car Management<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo base_url('caradmin') ?>">Car Admin</a></li>
            <li><a href="<?php echo base_url('maintenance') ?>">Car Maintenance History</a></li>
          </ul>
        </li>
        <li><a href="<?php echo base_url('useradmin') ?>">User Admin</a></li>
        <?php
          }
        ?>
        
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <?php
          if($role == 'Admin')
          {
        ?>
        <li><a href="<?php echo base_url('reminder') ?>">Reminder <span class="glyphicon glyphicon-info-sign"></span></a></li>
        <?php
          }
        ?>
        <li class="dropdown">
          <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-user"> <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo base_url('changepassword') ?>">Change Password</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url('login/dologout') ?>">Sign Out</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>