<script src="<?php echo base_url('assets/js/pagejs/caradmin.js') ?>"></script>
<?php
  $domain = base_url();
  $carid = isset($carID)?$carID:-1;
  $totalRow = $totalData[0]['totalrow'];
  $editCarData = json_encode(isset($carData)?$carData:null);
?>
<script>
  var base_url = '<?= $domain; ?>';
  var carid = <?= $carid; ?>;
  var editcardata = <?= $editCarData ?>;
</script>

<div class="row">
  <div class="col-md-12">
    <ol class="breadcrumb">
      <li>CMAS</li>
      <li>Car Management</li>
      <li class="active">Car Admin</li>
    </ol>
    <ul class="nav nav-tabs" role="tablist" id="myTab">
      <li role="presentation" class="active" id="tabcarprofile"><a href="#carprofile" aria-controls="carprofile" role="tab" data-toggle="tab">Car Profile</a></li>
      <li role="presentation" id="tabaddedit"><a href="#addeditData" aria-controls="addeditData" role="tab" data-toggle="tab" id="lblAddEdit">Add New</a></li>
    </ul>

    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="carprofile">
      <br />
      <div id="message-body">
          <?php
              if(isset($caradmin_message) && $caradmin_message!="")
              {
                echo '<div class="alert alert-success">'.$caradmin_message.'</div>';
              }
          ?>
        </div>

        <h5>Total Record <span class="label label-info"><?= $totalRow; ?></span></h5>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No.</th>
              <th>Plate Number</th>
              <th>Car Detail</th>
              <th>Manufacture Year</th>
              <th>STNK Expiry Date</th>
              <th>Person in Charge</th>
              <th style="width:140px;">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $i = ($currentPage-1)*10;
              foreach($carList as $value)
              {
                $cardetail = $value['brandname'].' - '.$value['typename'].'<br />'.$value['transmitiontype'];
            ?>
            <tr>
                <td><?= $i+1 ?></td>
                <td><?= $value['platenumber'] ;?></td>
                <td><?= $cardetail ;?></td>
                <td><?= $value['manufactureyear'] ;?></td>
                <td><?= $value['stnkexpiry'] ;?></td>
                <td><?= $value['username'].' - '.$value['position'] ;?></td>
                <td>
                  <a href="<?= $domain.'caradmin/edit/'.$value['carid']; ?>">
                    <button type="button" class="btn btn-warning btn-xs">
                      <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                      Edit
                    </button>
                  </a>
                  <a href="<?= $domain.'caradmin/delete/'.$value['carid']; ?>">
                    <button type="button" class="btn btn-danger btn-xs">
                      <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                      Delete
                    </button>
                  </a>
                </td>
              </tr>
            <?php
                $i++;
              }
            ?>
          <tbody>
        </table>
      </div>
      <div role="tabpanel" class="tab-pane" id="addeditData">
        <br />
        <br />
        <div id="alert-body">
        </div>
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <form>
                <div class="form-group">
                <label for="txtBrandName">Brand Name<text style="color:red">*</text></label>
                <input type="text" class="form-control" id="txtBrandName" placeholder="Brand Name">
              </div>
              <div class="form-group">
                <label for="txtNextServiceKM">Type Name<text style="color:red">*</text></label>
                <input type="text" class="form-control" id="txtTypename" placeholder="Type Name">
              </div>
              <div class="form-group">
                <label for="ddlTransmitionType">Transmition Type<text style="color:red">*</text></label>
                <select id="ddlTransmitionType" class="form-control">
                  <option value="-1">--Please Choose Transmition Type--</option>
                  <option value="A/T">A/T</option>
                  <option value="M/T">M/T</option>
                </select>
              </div>
              <div class="form-group">
                <label for="txtPlateNumber">Plate Number<text style="color:red">*</text></label>
                <input type="text" class="form-control" id="txtPlateNumber" placeholder="Plate Number">
              </div>
              <div class="form-group">
                <label for="datepicSTNKExpiry">STNK Expiry<text style="color:red">*</text></label>
                <div class='input-group date'>
                  <input type='text' class="form-control" id='datepicSTNKExpiry' placeholder="STNK Expiry"/>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
              </div>
              <div class="form-group">
                <label for="txtMachineNumber">Machine Number<text style="color:red">*</text></label>
                <input type="text" class="form-control" id="txtMachineNumber" placeholder="Machine Number">
              </div>
              <div class="form-group">
                <label for="txtCasisNumber">Casis Number<text style="color:red">*</text></label>
                <input type="text" class="form-control" id="txtCasisNumber" placeholder="Casis Number">
              </div>
              <div class="form-group">
                <label for="yearPicManufactureYear">Manufacture Year<text style="color:red">*</text></label>
                <div class='input-group date'>
                  <input type='text' class="form-control" id='yearPicManufactureYear' placeholder="Manufacture Year"/>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
              </div>
              <div class="form-group">
                <label for="ddlPersoninCharge">Person in Charge<text style="color:red">*</text></label>
                <select id="ddlPersoninCharge" class="form-control">
                  <option value="-1">--Select Person in Charge--</option>
                  <option value="0">None</option>
                  <?php
                    foreach($userList as $value) 
                    {
                  ?>
                    <option value=<?= $value['userid']; ?>><?= $value['username'].' - '.$value['position']; ?></option>
                  <?php
                    }
                  ?>
                </select>
              </div>
              <?php
                if($carid != -1)
                {
              ?>
              <button type="button" class="btn btn-warning" id="btnCancelEdit">
                <span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>
                Cancel
              </button>
              <?php
                }
              ?>
              <button type="button" class="btn btn-primary" id="btnSubmitCar">
                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                Submit
              </button>
            </form>
            </div>
          <div class="col-md-2"></div>
        </div>
      </div>
    </div>    
  </div>

</div>

<div class="row">
  <div class="col-md-4"></div>
  <div align="center" class="col-md-4">
    <nav>
      <?php
        if($totalRow > 0)
        {
      ?>
      <ul class="pagination">
        <li>
        <?php
          $totalPage = ceil($totalRow/10);

          $hrefprev = "";
          $hrefnext = "";

          if($currentPage == 1)
          {
            $hrefnext = $domain.'caradmin/page/'.($currentPage+1);
          }
          if($currentPage > 1)
          {
            $hrefprev = $domain.'caradmin/page/'.($currentPage-1);

            if($currentPage < $totalPage)
            {
              $hrefnext = $domain.'caradmin/page/'.($currentPage+1);
            }
          }
        ?>
          <a href="<?= $hrefprev; ?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>

        <?php
          for($i=0;$i<$totalPage;$i++)
          {
            $pageText = "";
            if(($i+1) == $currentPage)
            {
              $pageText = '<strong>'.($i+1).'</strong>';
            }
            else
            {
              $pageText = ($i+1);
            }
        ?>
          
          <li><a href="<?= $domain.'caradmin/page/'.($i+1); ?>"><?= $pageText; ?></a></li>
        <?php
          }
        ?>

        <li>
          <a href="<?= $hrefnext; ?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      </ul>
      <?php
        }
      ?>
    </nav>
  </div>
  <div class="col-md-4"></div>
</div>
