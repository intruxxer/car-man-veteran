$(window).on('load',function() 
{
	if(userid != -1)
    {
    	$("#tabuserprofile").removeClass("active");
    	$("#tabaddedit").addClass("active");

    	$("#userprofile").removeClass("tab-pane active");
    	$("#addeditData").removeClass("tab-pane");

		$("#userprofile").addClass("tab-pane");
    	$("#addeditData").addClass("tab-pane active");

    	$("#txtUsername").val(edituserdata[0].username);
    	$("#hidEncrypt").val(edituserdata[0].userpassword)
    	$("#txtCellPhone").val(edituserdata[0].cellphone);
    	$("#txtEnail").val(edituserdata[0].email);
    	$("#ddlPosition").val(edituserdata[0].position);
    	$("#ddlRole").val(edituserdata[0].role);
    	$("#ddlPersoninCharge").val(edituserdata[0].personincharge == null? 0:edituserdata[0].personincharge);

    	$("#lblAddEdit").text("Edit User Data")
    }

    $("#btnCancelEdit").click(function()
    {
    	window.location.replace(base_url + 'useradmin');
    });

    $("#btnResetPassword").click(function()
    {
    	var resetuserid = $("#ddlUserReset").val();

    	if(resetuserid == -1)
    	{
    		$("#alert-body").append('<div class="alert alert-danger" role="alert"> '+
				'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> '+
				'<span class="sr-only">Error:</span> '+
				'User name must be chosen'+
				'</div>');
    	}
    	else
    	{
    		$.ajax(
			{
				type:'POST',
				async:false,
				url: base_url + 'useradmin/resetpassword',
				data:
				{
					resetuserid : resetuserid
				},
				success: function(data)
				{
					//document.location.reload(true);
				}
			});
    	}
    });

    $("#btnSubmitUser").click(function()
    {
    	var username = $("#txtUsername").val();
    	var hashkey = $("#hidEncrypt").val();
    	var cellphone = $("#txtCellPhone").val();
    	var email = $("#txtEnail").val();
    	var position = $("#ddlPosition").val();
    	var role = $("#ddlRole").val();
    	var personincharge = $("#ddlPersoninCharge").val();

    	var flagvalidation = 0;

    	$("#alert-body").empty();

    	if(username == "" || username == null)
    	{
    		$("#alert-body").append('<div class="alert alert-danger" role="alert"> '+
				'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> '+
				'<span class="sr-only">Error:</span> '+
				'User name must be filled'+
				'</div>');

    		flagvalidation++;
    	}

    	if(cellphone != "")
    	{
    		if(isNaN(cellphone) == true)
	    	{
	    		$("#alert-body").append('<div class="alert alert-danger" role="alert"> '+
					'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> '+
					'<span class="sr-only">Error:</span> '+
					'Cell phone must be numeric'+
					'</div>');

	    		flagvalidation++;
	    	}
    	}

    	if(email == "" || email == null)
    	{
    		$("#alert-body").append('<div class="alert alert-danger" role="alert"> '+
				'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> '+
				'<span class="sr-only">Error:</span> '+
				'Email must be filled'+
				'</div>');

    		flagvalidation++;
    	}

    	if(position == -1)
    	{
    		$("#alert-body").append('<div class="alert alert-danger" role="alert"> '+
				'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> '+
				'<span class="sr-only">Error:</span> '+
				'Position must be chosen'+
				'</div>');

    		flagvalidation++;
    	}

    	if(role == -1)
    	{
    		$("#alert-body").append('<div class="alert alert-danger" role="alert"> '+
				'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> '+
				'<span class="sr-only">Error:</span> '+
				'Role must be chosen'+
				'</div>');

    		flagvalidation++;
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
    		if(userid == -1)
    		{
	    		$.ajax(
				{
					type:'POST',
					async:false,
					url: base_url + 'useradmin/createUser',
					data:
					{
						username : username,
				    	cellphone : cellphone,
				    	email : email,
				    	position : position,
				    	role : role,
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
					url: base_url + 'useradmin/updateUser',
					data:
					{
						userid : userid,
						username : username,
						hashkey : hashkey,
				    	cellphone : cellphone,
				    	email : email,
				    	position : position,
				    	role : role,
				    	personincharge : personincharge
					},
					success: function(data)
					{
						window.location.replace(base_url + 'useradmin');
					}
				});
	    	}
    	}
    });
});