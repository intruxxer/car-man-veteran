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