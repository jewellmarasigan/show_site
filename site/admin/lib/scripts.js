var stuffWorking = 0; // Basically a variable to set when a user fires an ajax function, so its not fired multiple times
var editAdminId; // A variable that acts similar to a session variable for editing administrators, in opposition to using a hidden input

$(document).ready(function()
{
    resizeSearch();
});

$(window).resize(function()
{
    resizeSearch();
});

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


// Page usage: administrators.php
// To delete an administrator
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


// Page usage: administrators.php
// To show the edit box of an administrator
function editAdministrator(adminid)
{
	if(stuffWorking == 0)
	{
		$("#messageBox").html("Loading...");
		stuffWorking = 1;
		
		if($("#add_administrator").is(":visible"))
		{
			$("#add_administrator").animate({"position":"absolute","margin-top":"-310px"},500,'easeOutQuart',function()
			{
				$("#edit_administrator").slideUp(250);
				$.getJSON("includes/ajax/getAdministrator.php",{ id:adminid },function(data)
				{
					stuffWorking = 0;
					
					if(data.success==0)
					{
						$("#messageBox").html(data.error);
					}
					else
					{
						$("#add_administrator").hide();
						$("#edit_administrator").html(data.content).show().animate({"position":"absolute","margin-top":"0px"},250);
					}
				});
			});
		}
		else
		{
			$("#edit_administrator").animate({"position":"absolute","margin-top":"-310px"},500,'easeOutQuart',function()
			{
				$.getJSON("includes/ajax/getAdministrator.php",{ id:adminid },function(data)
				{
					stuffWorking = 0;
					
					if(data.success==0)
					{
						$("#messageBox").html(data.error);
					}
					else
					{
						$("#edit_administrator").html(data.content).animate({"position":"absolute","margin-top":"0px"},250);
					}
				});
			});
		}
		editAdminId = adminid;
	}
}

// Page usage: administrators.php
// To post the changes to an administrator
function editAdministratorPost()
{
	if(stuffWorking == 0)
	{
		$("#edit_administrator").fadeTo(250,0.5);
		
		var admin_name = $("#edit_admin_name").val(),
			admin_email = $("#edit_admin_email").val(),
			admin_password = $("#edit_admin_password").val(),
			admin_permissions = $("#edit_admin_permissions").val();
			
		
		$.getJSON("includes/ajax/editAdministrator.php",{ id:editAdminId, name:admin_name , email:admin_email , password:admin_password , permissions:admin_permissions },function(data)
		{
			stuffWorking = 0;
			console.log(data);
			
			if(data.success==0)
			{
				$("#messageBox").html(data.error);
			}
			else
			{
				$("#administrator"+editAdminId).replaceWith(data.content);
				editAdminId = 0;
				$("#edit_administrator").fadeTo(250,1);
				$("#edit_administrator").animate({"position":"absolute","margin-top":"-310px"},500,function()
				{
					$("#messageBox").html("");
					$("#edit_administrator").html("");
					$("#add_administrator").show().animate({"position":"absolute","margin-top":"0px"},250);
				});
			}
		});
	}
}


// Page usage: courseinfo.php
// To change the course info text
function changeCourseInfo()
{
	if(stuffWorking == 0)
	{
		$("#messageBox").html("Loading...");
		stuffWorking = 1;
		
		$.getJSON("includes/ajax/courseInfo.php",{ courseInfo:$("#course_info").val() },function(data)
		{
			stuffWorking = 0;
			
			if(data.success==0)
			{
				$("#messageBox").html(data.error);
			}
			else
			{
				$("#revertList").prepend(data.content);
				$("#messageBox").html("Course info changed successfully");
			}
		});
	}
}


// Page usage: courseinfo.php
// To revert back to a previous version of the course info
function courseInfoRevert(versionid)
{
	
	if(stuffWorking == 0)
	{
		$("#messageBox").html("Reverting...");
		stuffWorking = 1;
		
		$.getJSON("includes/ajax/courseInfoGet.php",{ id:versionid },function(data)
		{
			stuffWorking = 0;
			
			if(data.success==0)
			{
				$("#messageBox").html(data.error);
			}
			else
			{
				$("#course_info").val(data.content)
				$("#messageBox").html(" ");
			}
		});
	}
}


// Page usage: Global
// To resize the search bar to fit perfectly on any screen
function resizeSearch()
{
	var searchLeft = $("#search").offset().left;
	var rightWidth = $(".right").width();
	
	$("#search input").width($(window).width() - searchLeft - rightWidth);
	$(".search").width($(window).width() - searchLeft - rightWidth);
}