<div class="row">
 <?php  $attributes = array('class' => '');
  echo form_open('booking/bydate', $attributes);
  ?>
    <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="">Start Booking</label>
        <div class='input-group date'>
          <input type='text' class="form-control" id='datetimepicker1' name="searchBookingStart" />
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="">End Booking</label>
        <div class='input-group date'>
          <input type='text' class="form-control" id='datetimepicker2' name="searchBookingEnd" />
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
      </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
          <label for="">Find Booking</label><br/>
          <button type="submit" class="btn btn-primary" name="submitBookingSearch" value="true">Search for Booking(s)</button>
        </div>
    </div>
    <div class="col-md-1"></div>
    </div>

  </form>
</div>

<div class="row">&nbsp;</div>

<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-7">
      <div><?php echo $resultmessage; 
                 //echo display_flash('search_booking'); ?>
                  </div></div>
  <div class="col-md-1"></div>
</div>

<div class="row">&nbsp;</div>

<!-- search result -->
<div class="row">

  <div class="col-md-12">
      <table class="table table-bordered">
      <?php //echo count($bookinglist);
            if(count($bookinglist) != 0)  { ?>
        <tr>
        <thead>
          <td>No.</td>
          <td>Applicant</td>
          <td>Vehicle</td>
          <td>Booking Start</td>
          <td>Booking End</td>
          <td>Destination</td>
          <td>Purpose</td>
          <td>Driver</td>
          <td>Status</td>
        </thead>
        </tr>
        <?php } ?>
        <tbody>
        <?php for ($i = 0; $i < count($bookinglist); ++$i) { ?>
                              <tr>
                                   <td><a href="<?php echo base_url("booking/id/".$bookinglist[$i]->BookingID); ?>"><?php echo ($i+1); ?></a></td>
                                   <td><a href="<?php echo base_url("booking/userid/".$bookinglist[$i]->UserBooking); ?>"><?php echo $bookinglist[$i]->Username; ?></a></td>
                                   <td><?php echo $bookinglist[$i]->PlateNumber; ?></a></td>
                                   <td><?php $str = $bookinglist[$i]->BookingStart; echo date('g:ia \<\b\> l jS F Y \<\b\>', strtotime($str)); ?></td>
                                   <td><?php $str = $bookinglist[$i]->BookingEnd; echo date('g:ia \<\b\> l jS F Y \<\b\>', strtotime($str));  ?></td>
                                   <td>
                                    <!--<span class="label label-danger">-->
                                      <?php echo $bookinglist[$i]->Destination; ?>
                                    <!--</span>-->
                                   </td>
                                   <td><?php echo $bookinglist[$i]->Remarks; ?></td>
                                
                                   <td><?php if($bookinglist[$i]->Driver == NULL)
                                            {
                                               echo '<p class="text-center">-</p>';
                                            }
                                            else {$result = $this->bookingmodel
                                            ->getdrivername_byid($bookinglist[$i]->Driver);
                                               echo $result[0]->Username;
                                            }     
                                        ?></td>
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
      </table>
  </div>

</div>
<!-- end search result -->

<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4 col-md-offset-1">
    <nav>
      <ul class="pagination">
        <?php echo $links; ?>
      </ul>
    </nav>
  </div>
  <div class="col-md-4"></div>
</div>

<script type="text/javascript">
  $(function(){
    $('#datetimepicker1').datetimepicker({
      format: 'YYYY-MM-DD',
      sideBySide: true
    });
    $('#datetimepicker2').datetimepicker({
      format: 'YYYY-MM-DD',
      sideBySide: true
    });
  });
</script>