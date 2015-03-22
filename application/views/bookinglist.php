<div class="row">

  <div class="col-md-12">
    <table class="table table-bordered">
        <thead>
          <tr>
              <td>No.</td>
              <td>Vehicle</td>
              <td>Applicant</td>
              <td>Day Start</td>
              <td>Day End</td>
              <td>Hour Start - End</td>
              <td>Destination</td>
              <td>Purpose</td>
              <td>Driver</td>
              <td>Status</td>
        </tr>
        </thead>
      <tr>
        <tbody>
          <?php for ($i = 0; $i < count($bookinglist); ++$i) { 
                    if( true/*$bookinglist[$i]->BookingID != NULL*/)    {    ?>
                              <tr>
                                   <td><a href="<?php echo base_url("booking/id/".$bookinglist[$i]->BookingID); ?>"><?php echo $i+1; ?></a></td>
                                   <td><a><?php echo $bookinglist[$i]->PlateNumber; ?></a></td>
                                   <td><a href="<?php echo base_url("booking/userid/".$bookinglist[$i]->UserBooking); ?>"><?php if ($bookinglist[$i]->Username==NULL) echo '<p class="text-center">-</p>'; else {echo $bookinglist[$i]->Username;} ?></a></td>
                                   <td><?php if ($bookinglist[$i]->BookingStart == NULL)
                                             {
                                                echo '<p class="text-center">-</p>';
                                             } 
                                             else 
                                             {
                                                $str = $bookinglist[$i]->BookingStart; 
                                                echo date('\<\b\> l jS F Y \<\b\>', strtotime($str));
                                             } ?></td>
                                   <td><?php if ($bookinglist[$i]->BookingEnd == NULL)  
                                             {
                                                echo '<p class="text-center">-</p>';
                                             } 
                                             else 
                                             {
                                                $str = $bookinglist[$i]->BookingEnd; 
                                                echo date('\<\b\> l jS F Y \<\b\>', strtotime($str));
                                             }  ?></td>
                                   <td><?php if($bookinglist[$i]->BookingStart == NULL && $bookinglist[$i]->BookingEnd == NULL)
                                             {
                                                echo '<p class="text-center">-</p>';
                                             }
                                             else{
                                                $strS = $bookinglist[$i]->BookingStart; 
                                                echo date('\<\b\> g:ia \<\b\>', strtotime($strS)).'-';
                                                $strE = $bookinglist[$i]->BookingEnd; 
                                                echo date('\<\b\> g:ia \<\b\>', strtotime($strE));    
                                            } ?></td>
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
          <?php } //else{
                  //echo '<tr>
                  //  <td colspan="9"><p class="text-center">There is no result available.</p></td>

                  //</tr>';
          //}
                  } ?>
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
        <?php echo $links; ?>
      </ul>
    </nav>
  </div>
  <div class="col-md-4"></div>
</div>
