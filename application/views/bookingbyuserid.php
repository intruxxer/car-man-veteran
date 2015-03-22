<div class="row">

  <div class="col-md-12">
    <table class="table table-bordered">
      <tr>
        <thead>
          <td>No.</td>
          <td>Applicant</td>
          <td>Booking Start</td>
          <td>Booking End</td>
          <td>Booking Hour</td>
          <td>Destination</td>
          <td>Purpose</td>
          <td>Vehicle</td>
          <td>Driver</td>
          <td>Status</td>
        </thead>
      </tr>
      <tr>
        <?php  if( $bookinglist != NULL)    {    
                  for ($i = 0; $i < count($bookinglist); ++$i) { ?>
                              <tr>
                                   <td><a href="<?php echo base_url("booking/id/".$bookinglist[$i]->BookingID); ?>"><?php echo $i + 1 ?></a></td>
                                   <td><a href="<?php echo base_url("booking/userid/".$bookinglist[$i]->UserBooking); ?>">
                                      <?php 
                                        //1
                                        echo $namelist[0]->Username; 

                                      ?>
                                      </a></td>
                                   <td><?php $str = $bookinglist[$i]->BookingStart; echo date('\<\b\> l jS F Y \<\b\>', strtotime($str)); ?></td>
                                   <td><?php $str = $bookinglist[$i]->BookingEnd; echo date('\<\b\> l jS F Y \<\b\>', strtotime($str));  ?></td>
                                   <td><?php 
                                        $strS = $bookinglist[$i]->BookingStart; 
                                        echo date('\<\b\> g:ia \<\b\>', strtotime($str)).'-';
                                        $strE = $bookinglist[$i]->BookingEnd; 
                                        echo date('\<\b\> g:ia \<\b\>', strtotime($str));    
                                        ?></td>
                                   <td>
                                    <!--<span class="label label-danger">-->
                                      <?php echo $bookinglist[$i]->Destination; ?>
                                    <!--</span>-->
                                   </td>
                                   <td><?php echo $bookinglist[$i]->Remarks; ?></td>
                                   <td><?php 
                                             //2
                                             $q = $this->bookingmodel->getvehicle_byid($bookinglist[$i]->CarID);
                                             echo $q[0]->PlateNumber; 

                                        ?></a></td>
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
              <?php }
              } else{
                  echo '<tr>
                          <td colspan="10"><p class="text-center">There is no result available.</p></td>
                        </tr>';
              } ?>
      </tr>
    </table>
  </div>

</div>

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
