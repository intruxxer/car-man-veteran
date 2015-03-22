$(window).on('load',function() 
{
    $('#datepicServiceDate').datetimepicker({
		format: 'YYYY-MM-DD',
		sideBySide: true
    });

    if(serviceid != -1)
    {
    	$("#tabservicelist").removeClass("active");
    	$("#tabaddedit").addClass("active");

    	$("#servicelist").removeClass("tab-pane active");
    	$("#addeditData").removeClass("tab-pane");

		$("#servicelist").addClass("tab-pane");
    	$("#addeditData").addClass("tab-pane active");

    	$("#ddlCarList").val(editcservicedata[0].carid);
    	$("#datepicServiceDate").val(editcservicedata[0].servicedate);
    	$("#txtNextServiceKM").val(editcservicedata[0].nextservicekm);
    	$("#txtRemarks").val(editcservicedata[0].remarks);

    	$("#lblAddEdit").text("Edit Maintenance Item")
    }
    $("#btnCancelEdit").click(function()
    {
    	window.location.replace(base_url + 'maintenance');
    });

    $("#btnSubmitService").click(function()
    {
    	var carid = $("#ddlCarList").val();
    	var servicedate = $("#datepicServiceDate").val();
    	var nextservicekm = $("#txtNextServiceKM").val();
    	var remarks = $("#txtRemarks").val();

    	var flagvalidation = 0;

    	$("#alert-body").empty();

    	if(carid == -1)
    	{
    		$("#alert-body").append('<div class="alert alert-danger" role="alert"> '+
				'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> '+
				'<span class="sr-only">Error:</span> '+
				'Car must be chosen'+
				'</div>');

    		flagvalidation++;
    	}

    	if(servicedate == "" || servicedate == null)
    	{
    		$("#alert-body").append('<div class="alert alert-danger" role="alert"> '+
				'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> '+
				'<span class="sr-only">Error:</span> '+
				'Service date must be filled'+
				'</div>');

    		flagvalidation++;
    	}

    	if(nextservicekm == "" || nextservicekm == null)
    	{
    		$("#alert-body").append('<div class="alert alert-danger" role="alert"> '+
				'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> '+
				'<span class="sr-only">Error:</span> '+
				'Next service must be filled'+
				'</div>');

    		flagvalidation++;
    	}
    	else
    	{
    		if(isNaN(nextservicekm) == true)
	    	{
	    		$("#alert-body").append('<div class="alert alert-danger" role="alert"> '+
					'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> '+
					'<span class="sr-only">Error:</span> '+
					'Next service km must be numeric'+
					'</div>');

	    		flagvalidation++;
	    	}
    	}

    	if(flagvalidation == 0)
    	{
    		if(serviceid == -1)
    		{
	    		$.ajax(
				{
					type:'POST',
					async:false,
					url: base_url + 'maintenance/createServiceHistory',
					data:
					{
						carid : carid,
				    	servicedate : servicedate,
				    	nextservicekm : nextservicekm,
				    	remarks : remarks
					},
					success: function(data)
					{
						document.location.reload(true);
					}
				});
	    	}
	    	else
	    	{
	    		$.ajax(
				{
					type:'POST',
					async:false,
					url: base_url + 'maintenance/updateServiceHistory',
					data:
					{
						serviceid : serviceid,
						carid : carid,
				    	servicedate : servicedate,
				    	nextservicekm : nextservicekm,
				    	remarks : remarks
					},
					success: function(data)
					{
						window.location.replace(base_url + 'maintenance');
					}
				});
	    	}
    	}
    });
});