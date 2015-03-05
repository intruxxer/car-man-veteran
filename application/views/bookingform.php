<div class="row">
 <?php  $attributes = array('class' => '');
  echo form_open('booking/request', $attributes);
  ?>

  <div class="form-group">
    <label for="">Email address</label>
    <input type="text" class="form-control" id="" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="">Password</label>
    <input type="password" class="form-control" id="" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="">File input</label>
    <input type="file" id="">
    <p class="help-block">Example block-level help text here.</p>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox"> Check me out
    </label>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>

  </form>
</div>

<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4"></div>
  <div class="col-md-4"></div>
</div>
