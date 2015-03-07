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
                <option value="<?php if(true) echo "1" ?>" >Driver A</option>
                <option value="<?php if(true) echo "2" ?>" >Driver B</option>
                <option value="<?php if(true) echo "3" ?>" >Driver C</option>
                <option value="<?php if(true) echo "4" ?>" >Driver D</option>
                <option value="<?php if(true) echo "99" ?>" >Self Driver</option>
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="">Vehicle</label>
          <select class="form-control" id="" name="CarID">
                <option value="<?php if(true) echo "101" ?>" >Car A Toyota Innova</option>
                <option value="<?php if(true) echo "201" ?>" >Motorbike A Honda Revo</option>
                <option value="<?php if(true) echo "102" ?>" >Car B Hino E-Buzz</option>
                <option value="<?php if(true) echo "103" ?>" >Car C Toyota Altis</option>
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
