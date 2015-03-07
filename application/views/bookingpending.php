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
          <td>Decision</td>
          <td>Status</td>
        </thead>
      </tr>
      <tr>
        <tbody>
          <?php for ($i = 0; $i < count($bookinglist); ++$i) { ?>
              <?php  $attributes = array('class' => ''); $hidden = array(
                'BookingID' => $bookinglist[$i]->BookingID,
                'CarID'=>$bookinglist[$i]->CarID,
                'UserBooking'=>$bookinglist[$i]->UserBooking,
                'Driver'=>$bookinglist[$i]->Driver,
                'BookingStart'=>$bookinglist[$i]->BookingStart,
                'BookingEnd'=>$bookinglist[$i]->BookingEnd,
                'Destination'=>$bookinglist[$i]->Destination,
                'Remarks'=>$bookinglist[$i]->Remarks,
                'CreatedTime'=>$bookinglist[$i]->CreatedTime,
                'CreatedUsername'=>$bookinglist[$i]->CreatedUsername,
                'CheckedBy'=>1,
                'RowStatus'=>'A'
                );
                echo form_open('booking/pending', $attributes, $hidden);
              ?>
                              <tr>
                                   <td><a href="<?php echo base_url("booking/id/".$bookinglist[$i]->BookingID); ?>"><?php echo ($i+1); ?></a></td>
                                   <td><a href="<?php echo base_url("booking/userid/".$bookinglist[$i]->UserBooking); ?>"><?php echo $bookinglist[$i]->Username; ?></a></td>
                                   <td><?php $str = $bookinglist[$i]->BookingStart; echo date('g:ia \<\b\> l jS F Y \<\b\>', strtotime($str)); ?></td>
                                   <td><?php $str = $bookinglist[$i]->BookingEnd; echo date('g:ia \<\b\> l jS F Y \<\b\>', strtotime($str));  ?></td>
                                   <td>
                                    <!--<span class="label label-danger">-->
                                      <?php echo $bookinglist[$i]->Destination; ?>
                                    <!--</span>-->
                                   </td>
                                   <td><?php echo $bookinglist[$i]->Remarks; ?></td>
                                   <td><?php echo $bookinglist[$i]->CarID; ?></td>
                                   <td>
                                      <select class="form-control" id="" name="BookingStatus">
                                            <option value="<?php if(true) echo "1" ?>" >Approve</option>
                                            <option value="<?php if(true) echo "2" ?>" >Decline</option>
                                            <option value="<?php if(true) echo "3" ?>" >Override & Cancel</option>
                                            <option value="<?php if(true) echo "4" ?>" >Pending</option>
                                      </select></td>
                                   <td><button type="submit" class="btn btn-primary" name="submitBookingApproval" value="true">Update</button></td>
                              </tr>
              </form>
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

<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4">
      <?php echo display_flash('req_approval'); //$this->session->flashdata('new_driver'); ?>
  </div>
  <div class="col-md-4"></div>
</div>
