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
      <a class="navbar-brand" href="#">CMAS</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="<?php echo base_url('booking') ?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Bookings<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo base_url('booking') ?>">All Request</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url('booking') ?>">By Pending Approval</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url('booking') ?>">By Today</a></li>
            <li><a href="<?php echo base_url('booking') ?>">By This Week</a></li>
            <li><a href="<?php echo base_url('booking') ?>">By This Month</a></li>
            <li><a href="<?php echo base_url('booking') ?>">By Specific Period</a></li>
          </ul>
        </li>

        <li><a href="<?php echo base_url('driver') ?>">Drivers/Holders</a></li>
        <li><a href="<?php echo base_url('schedule') ?>">Maintenance Schedule</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="#">Alert <span class="badge">4</span></a></li>
        <li class="dropdown">
          <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Setting <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo base_url('booking') ?>">Profile</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url('booking') ?>">Sign In/Sign Out</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>