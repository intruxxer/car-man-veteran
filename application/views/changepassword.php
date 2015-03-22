<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
	      <li>CMAS</li>
	      <li class="active">Change Password</li>
	    </ol>
	</div>	
	<br />
	<div class="col-md-4"></div>
	<div class="col-md-4" align="center">
		<div id="alert-body">
		<?php
	      	if(isset($changepassword_message) && $changepassword_message!="")
	      	{	
	      		$type ="danger";
	      		if($changepassword_message == 'Change password successfully updated')
	      		{
	      			$type ="success";
	      		}

	        	echo '<div class="alert alert-'.$type.'" role="alert">'.
	        		'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> '.
					'<span class="sr-only">Error:</span> '.
	        		$changepassword_message.
	        		'</div>';
	  		}
	  	?>
		</div>
		<form method="post" action="changepassword/doChangePassword">
		  <div class="form-group">
		    <input type="password" class="form-control" style="text-align:center;" id="txtOldPassword" name="oldpassword" placeholder="Old Password">
		  </div>
		  <div class="form-group">
		    <input type="password" class="form-control" style="text-align:center;" id="txtNewPassword" name="newpassword" placeholder="New Password">
		  </div>
		  <div class="form-group">
		    <input type="password" class="form-control" style="text-align:center;" id="txtConfirmPassword" name="confirmpassword" placeholder="Confirm New Password">
		  </div>
		  <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Change Password</button>
		</form>
	</div>
		
	<div class="col-md-4"></div>
</div>
<br />
<br />