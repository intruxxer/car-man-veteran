<div class="row">

  <div class="col-md-12">
    <table class="table table-bordered">
      <tr>
        <thead>
          <td>No.</td>
          <td>Applicant</td>
          <td>Booking Start</td>
          <td>Booking End</td>
          <td>Destination</td>
          <td>Purpose</td>
          <td>Vehicle</td>
          <td>Driver</td>
          <td>Status</td>
        </thead>
      </tr>
      <tr>
        <tbody>
          <?php for ($i = 0; $i < count($bookinglist); ++$i) { ?>
                              <tr>
                                   <td><a href="<?php echo base_url("booking/id/".$bookinglist[$i]->BookingID); ?>"><?php echo ($i+1); ?></a></td>
                                   <td><a href="<?php echo base_url("booking/userid/".$bookinglist[$i]->UserBooking); ?>"><?php echo $namelist[0]->Username; ?></a></td>
                                   <td><?php $str = $bookinglist[$i]->BookingStart; echo date('g:ia \<\b\> l jS F Y \<\b\>', strtotime($str)); ?></td>
                                   <td><?php $str = $bookinglist[$i]->BookingEnd; echo date('g:ia \<\b\> l jS F Y \<\b\>', strtotime($str));  ?></td>
                                   <td>
                                    <!--<span class="label label-danger">-->
                                      <?php echo $bookinglist[$i]->Destination; ?>
                                    <!--</span>-->
                                   </td>
                                   <td><?php echo $bookinglist[$i]->Remarks; ?></td>
                                   <td><?php echo $bookinglist[$i]->CarID; ?></td>
                                   <td><?php echo $bookinglist[$i]->Driver; ?></td>
                                   <td><?php 
                                             switch ($bookinglist[$i]->BookingStatus) {
                                              case 1:
                                                  echo '<span class="label label-success">Approved</span>';
                                                  break;
                                              case 2:
                                                  echo '<span class="label label-danger">Declined</span>';
                                                  break;
                                              case 3:
                                                  echo '<span class="label label-primary">Overriden/Canceled</span>';
                                                  break;
                                              case 4:
                                                  echo '<span class="label label-warning">Pending</span>';
                                                  break;
                                              } 
                                        ?></td>
                              </tr>
          <?php } ?>
        </tbody>
      </tr>
    </table>
  </div>

</div>

<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4 col-md-offset-1">
    <nav>
      <ul class="pagination">
        <li>
          <a href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
        <li><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li>
          <a href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      </ul>
    </nav>
  </div>
  <div class="col-md-4"></div>
</div>
