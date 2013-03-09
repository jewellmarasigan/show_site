var stuffWorking = 0; // Basically a variable to set when a user fires an ajax function, so its not fired multiple times

// Page usage: administrators.php
// To add a new administrator
function addAdministrator()
{
	if(stuffWorking == 0)
	{
		$("#messageBox").html("Loading...");
		stuffWorking = 1;
		
		var admin_name = $("#admin_name").val(),
			admin_email = $("#admin_email").val(),
			admin_password = $("#admin_password").val(),
			admin_permissions = $("#admin_permissions").val();
		
		$.getJSON("includes/ajax/addAdministrator.php",{ name:admin_name , email:admin_email , password:admin_password , permissions:admin_permissions },function(data)
		{
			stuffWorking = 0;
			if(data.success==0)
			{
				$("#messageBox").html(data.error);
			}
			else
			{
				location.reload();
			}
		});
	}	
}

function deleteAdministrator(adminid)
{
	if(stuffWorking == 0)
	{
		$("#messageBox").html("Loading...");
		stuffWorking = 1;
		
		$.getJSON("includes/ajax/deleteAdministrator.php",{ id:adminid },function(data)
		{
			stuffWorking = 0;
			
			if(data.success==0)
			{
				$("#messageBox").html(data.error);
			}
			else
			{
				$("#administrator"+adminid).slideUp(250,function()
				{
					$("#administrator"+adminid).remove();
				});
				$("#messageBox").html("Administrator deleted successfully");
			}
		});
	}
}