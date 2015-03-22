$(window).on('load',function() 
{
	// event datepicker

    $('#datepicSTNKExpiry').datetimepicker({
		format: 'YYYY-MM-DD',
		sideBySide: true
    });

    $('#yearPicManufactureYear').datetimepicker({
		format: 'YYYY',
		sideBySide: true,
    });

	if(carid != -1)
    {
    	$("#tabcarprofile").removeClass("active");
    	$("#tabaddedit").addClass("active");

    	$("#carprofile").removeClass("tab-pane active");
    	$("#addeditData").removeClass("tab-pane");

		$("#carprofile").addClass("tab-pane");
    	$("#addeditData").addClass("tab-pane active");

    	$("#txtBrandName").val(editcardata[0].brandname);
    	$("#txtTypename").val(editcardata[0].typename);
    	$("#ddlTransmitionType").val(editcardata[0].transmitiontype);
    	$("#txtPlateNumber").val(editcardata[0].platenumber);
    	$("#datepicSTNKExpiry").val(editcardata[0].stnkexpiry);
    	$("#txtMachineNumber").val(editcardata[0].machinenumber);
    	$("#txtCasisNumber").val(editcardata[0].casisnumber);
    	$("#yearPicManufactureYear").val(editcardata[0].manufactureyear);
    	$("#ddlPersoninCharge").val(editcardata[0].userid == null? 0:editcardata[0].userid);

    	$("#lblAddEdit").text("Edit Car Data")
    }

    $("#btnCancelEdit").click(function()
    {
    	window.location.replace(base_url + 'caradmin');
    });

    $("#btnSubmitCar").click(function()
    {
    	var brandname = $("#txtBrandName").val();
    	var typename = $("#txtTypename").val();
    	var transmitiontype = $("#ddlTransmitionType").val();
    	var platenumber = $("#txtPlateNumber").val();
    	var stnkexpiry = $("#datepicSTNKExpiry").val();
    	var machinenumber = $("#txtMachineNumber").val();
    	var casisnumber = $("#txtCasisNumber").val();
    	var manufactureyear = $("#yearPicManufactureYear").val();
    	var personincharge = $("#ddlPersoninCharge").val();

    	var flagvalidation = 0;

    	$("#alert-body").empty();

    	if(brandname == "" || brandname == null)
    	{
    		$("#alert-body").append('<div class="alert alert-danger" role="alert"> '+
				'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> '+
				'<span class="sr-only">Error:</span> '+
				'Brand name must be filled'+
				'</div>');

    		flagvalidation++;
    	}

    	if(typename == "" || typename == null)
    	{
    		$("#alert-body").append('<div class="alert alert-danger" role="alert"> '+
				'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> '+
				'<span class="sr-only">Error:</span> '+
				'Type name must be filled'+
				'</div>');

    		flagvalidation++;
    	}

    	if(transmitiontype == -1)
    	{
    		$("#alert-body").append('<div class="alert alert-danger" role="alert"> '+
				'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> '+
				'<span class="sr-only">Error:</span> '+
				'Transmition type must be chosen'+
				'</div>');

    		flagvalidation++;
    	}

    	if(platenumber == "" || platenumber == null)
    	{
    		$("#alert-body").append('<div class="alert alert-danger" role="alert"> '+
				'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> '+
				'<span class="sr-only">Error:</span> '+
				'Plate number must be filled'+
				'</div>');

    		flagvalidation++;
    	}

    	if(stnkexpiry == "" || stnkexpiry == null)
    	{
    		$("#alert-body").append('<div class="alert alert-danger" role="alert"> '+
				'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> '+
				'<span class="sr-only">Error:</span> '+
				'STNK Expiry must be filled'+
				'</div>');

    		flagvalidation++;
    	}

    	if(machinenumber == "" || machinenumber == null)
    	{
    		$("#alert-body").append('<div class="alert alert-danger" role="alert"> '+
				'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> '+
				'<span class="sr-only">Error:</span> '+
				'Machine number must be filled'+
				'</div>');

    		flagvalidation++;
    	}

    	if(casisnumber == "" || casisnumber == null)
    	{
    		$("#alert-body").append('<div class="alert alert-danger" role="alert"> '+
				'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> '+
				'<span class="sr-only">Error:</span> '+
				'Casis number must be filled'+
				'</div>');

    		flagvalidation++;
    	}

    	if(manufactureyear == "" || manufactureyear == null)
    	{
    		$("#alert-body").append('<div class="alert alert-danger" role="alert"> '+
				'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> '+
				'<span class="sr-only">Error:</span> '+
				'Manufacture year must be filled'+
				'</div>');

    		flagvalidation++;
    	}
    	else
    	{
    		if(isNaN(manufactureyear) == true)
	    	{
	    		$("#alert-body").append('<div class="alert alert-danger" role="alert"> '+
					'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> '+
					'<span class="sr-only">Error:</span> '+
					'Manufacture year km must be numeric'+
					'</div>');

	    		flagvalidation++;
	    	}
    	}

    	if(personincharge == -1)
    	{
    		$("#alert-body").append('<div class="alert alert-danger" role="alert"> '+
				'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> '+
				'<span class="sr-only">Error:</span> '+
				'Person in charge must be chosen'+
				'</div>');

    		flagvalidation++;
    	}

    	if(flagvalidation == 0)
    	{
    		if(carid == -1)
    		{
	    		$.ajax(
				{
					type:'POST',
					async:false,
					url: base_url + 'caradmin/createCar',
					data:
					{
						brandname : brandname,
						typename : typename,
						transmitiontype : transmitiontype,
						platenumber : platenumber,
						stnkexpiry : stnkexpiry,
						machinenumber : machinenumber,
						casisnumber : casisnumber,
						manufactureyear : manufactureyear,
						personincharge : personincharge
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
					url: base_url + 'caradmin/updateCar',
					data:
					{
						carid : carid,
						brandname : brandname,
						typename : typename,
						transmitiontype : transmitiontype,
						platenumber : platenumber,
						stnkexpiry : stnkexpiry,
						machinenumber : machinenumber,
						casisnumber : casisnumber,
						manufactureyear : manufactureyear,
						personincharge : personincharge
					},
					success: function(data)
					{
						window.location.replace(base_url + 'caradmin');
					}
				});
	    	}
    	}
    });
});