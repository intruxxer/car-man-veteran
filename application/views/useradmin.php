<script src="<?php echo base_url('assets/js/pagejs/useradmin.js') ?>"></script>
<?php
  $domain = base_url();
  $userid = isset($userID)?$userID:-1;
  $totalRow = $totalData[0]['totalrow'];
  $editUserData = json_encode(isset($userData)?$userData:null);
?>
<script>
  var base_url = '<?= $domain; ?>';
  var userid = <?= $userid; ?>;
  var edituserdata = <?= $editUserData ?>;
</script>

<div class="row">
  <div class="col-md-12">
    <ol class="breadcrumb">
      <li>CMAS</li>
      <li class="active">User Admin</li>
    </ol>
    <ul class="nav nav-tabs" role="tablist" id="myTab">
      <li role="presentation" class="active" id="tabuserprofile"><a href="#userprofile" aria-controls="userprofile" role="tab" data-toggle="tab">User Profile</a></li>
      <li role="presentation" id="tabaddedit"><a href="#addeditData" aria-controls="addeditData" role="tab" data-toggle="tab" id="lblAddEdit">Add New</a></li>
      <li role="presentation" id="tabresetpassword"><a href="#resetpassword" aria-controls="resetpassword" role="tab" data-toggle="tab">Reset Password</a></li>
    </ul>

    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="userprofile">
      <br />
      <div id="message-body">
          <?php
              if(isset($useradmin_message) && $useradmin_message!="")
              {
                echo '<div class="alert alert-success">'.$useradmin_message.'</div>';
              }
          ?>
        </div>

        <h5>Total Record <span class="label label-info"><?= $totalRow; ?></span></h5>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No.</th>
              <th>User ID</th>
              <th>User Name</th>
              <th>Cell Phone</th>
              <th>Email</th>
              <th>Position</th>
              <th>Role</th>
              <th>Person in Charge</th>
              <th>Car in Charge</th>
              <th style="width:140px;">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $i = ($currentPage-1)*10;

              foreach($userListData as $value)
              {
            ?>
            <tr>
                <td><?= $i+1 ?></td>
                <td><?= $value['userid'] ;?></td>
                <td><?= $value['username'] ;?></td>
                <td><?= $value['cellphone'] ;?></td>
                <td><?= $value['email'] ;?></td>
                <td><?= $value['position'] ;?></td>
                <td><?= $value['role'] ;?></td>
                <td><?= $value['personincharge'] ;?></td>
                <td><?= $value['carincharge'] ;?></td>
                <td>
                  <a href="<?= $domain.'useradmin/edit/'.$value['userid']; ?>">
                    <button type="button" class="btn btn-warning btn-xs">
                      <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                      Edit
                    </button>
                  </a>
                  <a href="<?= $domain.'useradmin/delete/'.$value['userid']; ?>">
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
                <label for="txtUsername">User Name<text style="color:red">*</text></label>
                <input type="text" class="form-control" id="txtUsername" placeholder="User Name">
                <input type="hidden" id="hidEncrypt">
              </div>
              <div class="form-group">
                <label for="txtCellPhone">Cell Phone</label>
                <input type="text" class="form-control" id="txtCellPhone" placeholder="Cell Phone">
                <p class="help-block">Example : 0812500600</p>
              </div>
              <div class="form-group">
                <label for="txtEnail">Email<text style="color:red">*</text></label>
                <input type="text" class="form-control" id="txtEnail" placeholder="Email">
              </div>
              <div class="form-group">
                <label for="ddlPosition">Position<text style="color:red">*</text></label>
                <select id="ddlPosition" class="form-control">
                  <option value="-1">--Please Choose Position--</option>
                  <option value="AO">AO</option>
                  <option value="Back Office">Back Office</option>
                  <option value="Driver">Driver</option>
                  <option value="FO">FO</option>
                  <option value="MP">MP</option>
                  <option value="MO">MO</option> 
                  <option value="Pinca">Pinca</option>
                  <option value="RO">RO</option>
                  <option value="Rutang">Rutang</option>
                  <option value="SDM">SDM</option>
                </select>
              </div>
              <div class="form-group">
                <label for="ddlRole">Role<text style="color:red">*</text></label>
                <select id="ddlRole" class="form-control">
                  <option value="-1">--Please Choose Role--</option>
                  <option value="Admin">Admin</option>
                  <option value="User">User</option>
                  <option value="Driver">Driver</option>
                </select>
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
                if($userid != -1)
                {
              ?>
              <button type="button" class="btn btn-warning" id="btnCancelEdit">
                <span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>
                Cancel
              </button>
              <?php
                }
              ?>
              <button type="button" class="btn btn-primary" id="btnSubmitUser">
                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                Submit
              </button>
            </form>
            </div>
          <div class="col-md-2"></div>
        </div>
      </div>
      <div role="tabpanel" class="tab-pane" id="resetpassword">
        <br />
        <br />
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8">
              <form>
                <div class="form-group">
                  <label for="ddlUserReset">User Name</label>
                  <select id="ddlUserReset" class="form-control">
                    <option value="-1">--Select User--</option>
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
                <button type="button" class="btn btn-warning" id="btnResetPassword">
                  <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                  Reset Password
                </button>
                <p class="help-block">Password will be reset into `veteran`</p>
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
            $hrefnext = $domain.'useradmin/page/'.($currentPage+1);
          }
          if($currentPage > 1)
          {
            $hrefprev = $domain.'useradmin/page/'.($currentPage-1);

            if($currentPage < $totalPage)
            {
              $hrefnext = $domain.'useradmin/page/'.($currentPage+1);
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
          
          <li><a href="<?= $domain.'useradmin/page/'.($i+1); ?>"><?= $pageText; ?></a></li>
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
