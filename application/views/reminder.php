<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
	      <li>CMAS</li>
	      <li class="active">Reminder</li>
	    </ol>
	</div>
	<div class="col-md-6">
		<div class="panel panel-danger">
	      <div class="panel-heading">
	        <h3 class="panel-title">Next Week Renewal STNK or Tax</h3>
	      </div>
	      <table class="table table-bordered">
		  	<thead>
			  	<tr>
			  		<th style="width:120px;">Plate Number</th>
			  		<th>Car Detail</th>
			  		<th>Manufacture Year</th>
			  		<th>STNK Expiry</th>
			  		<th>Person in Charge</th>
		  		</tr>
		  	</thead>
		  	<tbody>
		  		<?php
		  			foreach($renewalSTNKList as $value)
		  			{
		  				$cardetail = $value['brandname'].' '.$value['typename'].' '.$value['transmitiontype'];
		  		?>
				<tr>
			  		<td><?= $value['platenumber']; ?></td>
			  		<td><?= $cardetail; ?></td>
			  		<td><?= $value['manufactureyear']; ?></td>
			  		<td><?= $value['stnkexpiry']; ?></td>
			  		<td><?= $value['username']; ?></td>
		  		</tr>
		  		<?php
		  			}
		  		?>
		  	</tbody>
		  </table>
	    </div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-danger">
	      <div class="panel-heading">
	        <h3 class="panel-title">Next Week Maintenance Schedule</h3>
	      </div>
	      <table class="table table-bordered">
		  	<thead>
		  		<th style="width:120px;">Plate Number</th>
		  		<th>Car Detail</th>
		  		<th>Manufacture Year</th>
		  		<th>Last Maintenance</th>
		  		<th>Person in Charge</th>
		  	</thead>
		  	<tbody>
		  		<?php
		  			foreach($reminderServiceList as $value)
		  			{
		  				$cardetail = $value['brandname'].' '.$value['typename'].' '.$value['transmitiontype'];
		  		?>
				<tr>
			  		<td><?= $value['platenumber']; ?></td>
			  		<td><?= $cardetail; ?></td>
			  		<td><?= $value['manufactureyear']; ?></td>
			  		<td><?= $value['lastservice']; ?></td>
			  		<td><?= $value['username']; ?></td>
		  		</tr>
		  		<?php
		  			}
		  		?>
		  	</tbody>
		  </table>
	    </div>
	</div>
</div>