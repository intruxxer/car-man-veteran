<script src="<?php echo base_url('assets/js/pagejs/maintenance.js') ?>"></script>
<?php
  $domain = base_url();
  $serviceid = isset($serviceID)?$serviceID:-1;
  $editServiceData = json_encode(isset($serviceHistoryData)?$serviceHistoryData:null);
  $totalRow = $totalData[0]['totalrow'];
?>
<script>
  var base_url = '<?= $domain; ?>';
  var serviceid = <?= $serviceid; ?>;
  var editcservicedata = <?= $editServiceData ?>;
</script>

<div class="row">
  <div class="col-md-12">
    <ol class="breadcrumb">
      <li>CMAS</li>
      <li>Car Management</li>
      <li class="active">Car Maintenance History</li>
    </ol>
    <ul class="nav nav-tabs" role="tablist" id="myTab">
      <li role="presentation" class="active" id="tabservicelist"><a href="#servicelist" aria-controls="servicelist" role="tab" data-toggle="tab">Maintenance History</a></li>
      <li role="presentation" id="tabaddedit"><a href="#addeditData" aria-controls="addeditData" role="tab" data-toggle="tab" id="lblAddEdit">Add New</a></li>
    </ul>

    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="servicelist">
      <br />
      <div id="message-body">
          <?php
              if(isset($message) && $message!="")
              {
                echo '<div class="alert alert-success">'.$message.'</div>';
              }
          ?>
        </div>

        <h5>Total Record <span class="label label-info"><?= $totalRow; ?></span></h5>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No.</th>
              <th>Maintenace ID</th>
              <th>Plate Number</th>
              <th>Car Detail</th>
              <th>Maintenance Date</th>
              <th>Next Maintenance KM</th>
              <th>Remarks</th>
              <th style="width:140px;">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $i = ($currentPage-1)*10;
              foreach($serviceHistoryList as $value)
              {
                $cardetail = $value['brandname'].' - '.$value['typename'].'<br />'.$value['transmitiontype'];
            ?>
              <tr>
                <td><?= $i+1 ?></td>
                <td><?= $value['serviceid'] ;?></td>
                <td><?= $value['platenumber'] ;?></td>
                <td><?= $cardetail ;?></td>
                <td><?= $value['servicedate'] ;?></td>
                <td><?= $value['nextservicekm'] ;?></td>
                <td><?= $value['remarks'] ;?></td>
                <td>
                  <a href="<?= $domain.'maintenance/edit/'.$value['serviceid']; ?>">
                    <button type="button" class="btn btn-warning btn-xs">
                      <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                      Edit
                    </button>
                  </a>
                  <a href="<?= $domain.'maintenance/delete/'.$value['serviceid']; ?>">
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
                <label for="ddlCarList">Car<text style="color:red">*</text></label>
                <select id="ddlCarList" class="form-control">
                    <option value="-1">--Choose Car--</option>
                    <?php
                      foreach ($carList as $value) 
                      {
                        $carname =  $value['platenumber'].' - '.$value['brandname'].' '.$value['typename'].' '.$value['transmitiontype'];
                    ?>
                      <option value="<?= $value['carid']; ?>"><?= $carname; ?></option>
                    <?php
                      }
                    ?>
                </select>
              </div>
              <div class="form-group">
                <label for="datepicServiceDate">Maintenance Date<text style="color:red">*</text></label>
                <div class='input-group date'>
                  <input type='text' class="form-control" id='datepicServiceDate' placeholder="Service Date"/>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
              </div>
              <div class="form-group">
                <label for="txtNextServiceKM">Next Maintenance KM<text style="color:red">*</text></label>
                <input type="text" class="form-control" id="txtNextServiceKM" placeholder="Next Service KM">
              </div>
              <div class="form-group">
                <label for="txtRemarks">Remarks</label>
                <textarea class="form-control" rows="5" id="txtRemarks"></textarea>
              </div>
              <?php
                if($serviceid != -1)
                {
              ?>
              <button type="button" class="btn btn-warning" id="btnCancelEdit">
                <span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>
                Cancel
              </button>
              <?php
                }
              ?>
              <button type="button" class="btn btn-primary" id="btnSubmitService">
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
            $hrefnext = $domain.'maintenance/page/'.($currentPage+1);
          }
          if($currentPage > 1)
          {
            $hrefprev = $domain.'maintenance/page/'.($currentPage-1);

            if($currentPage < $totalPage)
            {
              $hrefnext = $domain.'maintenance/page/'.($currentPage+1);
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
          
          <li><a href="<?= $domain.'maintenance/page/'.($i+1); ?>"><?= $pageText; ?></a></li>
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
