<?php
  $domain = base_url();
?>

<div class="row" style="margin-top:5%">
	<div class="col-md-4"></div>
	<div class="col-md-4" align="center"><img src="<?= $domain.'assets/img/bri-logo.png';?>"></div>
	<div class="col-md-4"></div>
</div>
	
<div class="row">	
	<br />
	<div class="col-md-4"></div>
	<div class="col-md-4" align="center">
		<div class="panel panel-default">
		    <div class="panel-heading">
		    	<h5><strong>BRI VETERAN</strong><br/>Office Car Management Application System</h5>
		    </div>
       		<div class="panel-body">
       			<div id="alert-body">
				<?php
	              if(isset($login_message) && $login_message!="")
	              	{
	                	echo '<div class="alert alert-danger" role="alert">'.
	                		'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> '.
							'<span class="sr-only">Error:</span> '.
	                		$login_message.
	                		'</div>';
              		}
	          	?>
	       		</div>
	        	<form method="post" action="login/doLogin">
				  <div class="form-group">
				    <input type="email" class="form-control" style="text-align:center;" id="txtEmailAddress" name="username" placeholder="Email">
				  </div>
				  <div class="form-group">
				    <input type="password" class="form-control" style="text-align:center;" id="txtPassword" name="password" placeholder="Password">
				  </div>
				  <button type="submit" class="btn btn-primary">LOGIN</button>
				</form>
		    </div>
			
		</div>
	    </div>
		
	<div class="col-md-4"></div>
</div>
<br />
<br />