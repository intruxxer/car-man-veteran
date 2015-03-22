<div class="row">
 <?php  $attributes = array('class' => '');
  echo form_open('booking/request', $attributes);
  ?>
    <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-5">
      <div class="form-group">
        <label for="">Start Booking</label>
        <div class='input-group date'>
          <input type='text' class="form-control" id='datetimepicker1' name="BookingStart" />
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
      </div>
    </div>
    <div class="col-md-5">
      <div class="form-group">
        <label for="">End Booking</label>
        <div class='input-group date'>
          <input type='text' class="form-control" id='datetimepicker2' name="BookingEnd" />
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
      </div>
    </div>
    <div class="col-md-1"></div>
    </div>

    <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-5">
      <div class="form-group">
        <label for="">Purpose</label>
        <div class='input-group date' id=''>
          <input type='text' class="form-control" name="Remarks" />
            <span class="input-group-addon"><span class="glyphicon glyphicon-question-sign"></span>
            </span>
        </div>
      </div>
    </div>
    <div class="col-md-5">
      <div class="form-group">
        <label for="">Destination</label>
        <div class='input-group date' id=''>
          <input type='text' class="form-control" name="Destination" />
            <span class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span>
            </span>
        </div>
      </div>
    </div>
    <div class="col-md-1"></div>
    </div>

    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-2"></div>
      <div class="col-md-2">
        <div class="form-group">
          <label for="">Driver</label>
          <select class="form-control" id="" name="Driver">
          <?php for($i=0; $i < count($driverlist); $i++) { ?>
                <?php echo '<option value="'.$driverlist[$i]->UserID.'" >'.$driverlist[$i]->Username.'</option>'; ?>
          <?php }  ?>
                <?php echo '<option value="99" >Self Driving</option>'; ?>
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="">Vehicle</label>
          <select class="form-control" id="" name="CarID">
          <?php for($i=0; $i < count($carlist); $i++) { ?>
                <?php echo '<option value="'.$carlist[$i]->CarID.'" >'.$carlist[$i]->BrandName.' '.$carlist[$i]->TypeName.' (<b>'.$carlist[$i]->PlateNumber.'</b>)</option>'; ?>
          <?php }  ?>
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="">Submit Request</label><br/>
          <button type="submit" class="btn btn-primary" name="submitBooking" value="true">Book A Vehicle via CMAS</button>
        </div>
      </div>
      <div class="col-md-1"></div>
    </div>

  </form>
</div>

<div class="row">
  <div class="col-md-3"></div>
  <div class="col-md-7"><?php echo display_flash('new_booking'); ?></div>
  <div class="col-md-2"></div>
</div>

<script type="text/javascript">
  $(function(){
    $('#datetimepicker1').datetimepicker({
      format: 'YYYY-MM-DD HH:mm:ss',
      sideBySide: true
    });
    $('#datetimepicker2').datetimepicker({
      format: 'YYYY-MM-DD HH:mm:ss',
      sideBySide: true
    });
  });
</script>
