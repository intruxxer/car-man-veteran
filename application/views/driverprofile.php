<div class="row">
<?php echo form_open('driver/update') ?>
  <div class="col-md-12">
    <table class="table table-striped">
              <thead>
                <tr>
                  <td>No.</td>
                  <td>Driver/Holder</td>
                  <td>Cellphone</td>
                  <td>Position</td>
                  <td>Person In Charge</td>
                  <td>Car In Charge</td>
                  <td></td>
                </tr>
              </thead>
              <tbody>
              <?php for ($i = 0; $i < count($driverholderprofile); ++$i) { ?>
                              <tr>

                                   <td><?php echo ($i+1); ?></td>
                                   <td>
                                      <input type="text" class="form-control" id="driverHolderName" name="driverHolderName" value="<?php echo $driverholderprofile[$i]->Username; ?>">
                                      </td>
                                   <td>
                                      <input type="text" class="form-control" id="driverHolderCellphone" name="driverHolderCellphone" value="<?php echo $driverholderprofile[$i]->Cellphone; ?>">
                                      </td>
                                  <td>
                                    <select class="form-control" id="driverHolderPosition" name="driverHolderPosition">
                                      <option value="Driver" <?php if($driverholderprofile[$i]->Position == "Driver") echo "selected" ?>>Driver</option>
                                      <option value="Pinca BRI" <?php if($driverholderprofile[$i]->Position == "Pinca BRI") echo "selected" ?>>Pinca BRI</option>
                                      <option value="MP" <?php if($driverholderprofile[$i]->Position == "MP") echo "selected" ?>>MP</option>
                                      <option value="MO" <?php if($driverholderprofile[$i]->Position == "MO") echo "selected" ?>>MO</option>
                                      <option value="AO" <?php if($driverholderprofile[$i]->Position == "AO") echo "selected" ?>>AO</option>
                                      <option value="FO" <?php if($driverholderprofile[$i]->Position == "FO") echo "selected" ?>>FO</option>
                                    </select></td>
                                  <td>
                                    <select class="form-control" id="driverHolderPersonInCharge" name="driverHolderPersonInCharge">
                                      <option value="Pinca BRI Veteran" <?php if($driverholderprofile[$i]->Personincharge == "Pinca BRI Veteran") echo "selected" ?>>Pinca BRI Veteran</option>
                                      <option value="Self" <?php if($driverholderprofile[$i]->Personincharge == "Self") echo "selected" ?>>Self</option>
                                    </select></td>
                                   <td>
                                      <select class="form-control" id="driverHolderCarInCharge" name="driverHolderCarInCharge">
                                        <option value="B 12789 PGA" <?php if($driverholderprofile[$i]->Carincharge == "B 12789 PGA") echo "selected" ?>>B 12789 PGA</option>
                                        <option value="B 12678 PGA" <?php if($driverholderprofile[$i]->Carincharge == "B 12678 PGA") echo "selected" ?>>B 12678 PGA</option>
                                        <option value="B 11890 PGA" <?php if($driverholderprofile[$i]->Carincharge == "B 11890 PGA") echo "selected" ?>>B 11890 PGA</option>
                                        <option value="B 19088 PGA" <?php if($driverholderprofile[$i]->Carincharge == "B 19088 PGA") echo "selected" ?>>B 19088 PGA</option>
                                      </select></td>
                                  <td>
                                      <input type="hidden" name="UserID" value="<?php echo $driverholderprofile[$i]->UserID; ?>" />
                                      <div class="checkbox">
                                        <label>
                                          <input type="checkbox" name="deleteDriverHolder"> Delete
                                        </label>
                                      </div>
                                      </td>
                              </tr>
              <?php } ?>
                              <tr>
                                <td></td><td></td><td></td><td></td><td></td><td></td>
                                <td><button type="submit" class="btn btn-primary">Update</button></td>
                              </tr>
              </tbody>
      </table>            
  </div>
</form>  
</div>

<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
    <ul id="myTab" class="nav nav-tabs" role="tablist">
      <li class="" role="presentation"><a href="#profile" id="profile-tab" role="tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Driver Profile</a></li>
      <li class="" role="presentation"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="false">Add Driver/Holder</a></li>
      <!--<li class="dropdown" role="presentation">
        <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown"  aria-expanded="false" aria-controls="myTabDrop1-contents">Dropdown <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">
          <li><a aria-expanded="true" href="#dropdown1" tabindex="-1" role="tab" id="dropdown1-tab" data-toggle="tab" aria-controls="dropdown1">Content 1</a></li>
          <li><a href="#dropdown2" tabindex="-1" role="tab" id="dropdown2-tab" data-toggle="tab" aria-controls="dropdown2">Content 2</a></li>
        </ul>
      </li>-->
    </ul>

    <div id="myTabContent" class="tab-content">

      <!-- Tab-Content #1 -->
      <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
        <div class="row">&nbsp;</div>
        <div class="row">

          <div class="col-md-12">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <td>No.</td>
                  <td>Driver/Holder</td>
                  <td>Cellphone</td>
                  <td>Person In Charge</td>
                  <td>Car In Charge</td>
                </tr>
              </thead>
              <tbody>
              <?php for ($i = 0; $i < count($driverholderlist); ++$i) { ?>
                              <tr>
                                   <td><?php echo ($i+1); ?></td>
                                   <td><a href="<?php echo base_url("driver/profile/".$driverholderlist[$i]->UserID); ?>"><?php echo $driverholderlist[$i]->Username; ?></a></td>
                                   <td><?php echo $driverholderlist[$i]->Cellphone; ?></td>
                                   <td>
                                    <span class="label label-danger">
                                      <?php echo $driverholderlist[$i]->Personincharge; ?>
                                    </span>
                                   </td>
                                   <td><?php echo $driverholderlist[$i]->Carincharge; ?></td>
                              </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>

        </div>

        <div class="row">
          <div class="col-md-4"></div>
          <div class="col-md-4 col-md-offset-1">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
      </div>
      <!-- End-Tab-Content #1 -->

      <!-- Tab-Content #2 -->
      <div role="tabpanel" class="tab-pane fade" id="home" aria-labelledby="home-tab">
          <div class="row">&nbsp;</div>
          <div class="row">
              <?php echo form_open('driver/create') ?>
                  <div class="row">
                      <div class="col-md-1"></div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="driverHolderName">Name</label>
                          <input type="text" class="form-control" id="driverHolderName" name="driverHolderName" placeholder="Driver/Holder Name">
                        </div>
                      </div>  

                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="driverHolderCellphone">Cellphone</label>
                          <input type="text" class="form-control" id="driverHolderCellphone" name="driverHolderCellphone" placeholder="Driver/Holder HP">
                        </div>
                      </div>

                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="driverHolderPosition">Position</label>
                          <select class="form-control" id="driverHolderPosition" name="driverHolderPosition">
                            <option value="Driver">Driver</option>
                            <option value="Pinca BRI">Pinca BRI</option>
                            <option value="MP">MP</option>
                            <option value="MO">MO</option>
                            <option value="AO">AO</option>
                            <option value="FO">FO</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="driverHolderPersonInCharge">Person in Charge</label>
                          <select class="form-control" id="driverHolderPersonInCharge" name="driverHolderPersonInCharge">
                            <option value="Pinca BRI Veteran">Pinca BRI Veteran</option>
                            <option value="Self">Self</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="driverHolderCarInCharge">Car in Charge</label>
                          <select class="form-control" id="driverHolderCarInCharge" name="driverHolderCarInCharge">
                            <option value="B 12789 PGA">B 12789 PGA</option>
                            <option value="B 12678 PGA">B 12678 PGA</option>
                            <option value="B 11890 PGA">B 11890 PGA</option>
                            <option value="B 19088 PGA">B 19088 PGA</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-1"></div>

                  </div>
                  <div class="row">&nbsp;</div>
                  <div class="row">
                      <div class="col-md-9"></div>

                      <div class="col-md-2">
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary">Submit to CMAS System</button>
                        </div>
                      </div>

                      <div class="col-md-1"></div>

                  </div>
                  
              </form>
          </div>
      </div>
      <!-- End-Tab-Content #2 -->

      <!-- Tab-Content Dropdown #1 & #2 -->
      <div role="tabpanel" class="tab-pane fade active in" id="dropdown1" aria-labelledby="dropdown1-tab">
        
      </div>

      <div role="tabpanel" class="tab-pane fade" id="dropdown2" aria-labelledby="dropdown2-tab">
        
      </div>

    </div>
</div>

<div class="row">
  <div class="col-md-3"></div>
  <div class="col-md-6"><?php echo display_flash('new_driver'); //$this->session->flashdata('new_driver'); ?></div>
  <div class="col-md-3"></div>
</div>

<div class="row">&nbsp;</div>

<div class="row">
  <div class="col-md-3"></div>
  <div class="col-md-6">You can either see drivers' profiles or add more drivers/holders by <b>clicking the tab</b>. 
    If you are unsure what to do, you can look something up via search form below.
  </div>
  <div class="col-md-3"></div>
</div>

<div class="row">&nbsp;</div>

<div class="row">

  <div class="col-md-3"></div>
  <div class="col-md-6">
    <div class="input-group">
      <input type="text" class="form-control" placeholder="What do you need?">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button">Search</button>
      </span>
    </div><!-- /input-group -->
  </div>
  <div class="col-md-3"></div>

</div>

<div class="row">&nbsp;</div>