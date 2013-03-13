var stuffWorking = 0; // Basically a variable to set when a user fires an ajax function, so its not fired multiple times

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

function resizeSearch()
{
	var searchLeft = $("#search").offset().left;
	var rightWidth = $(".right").width();
	
	$("#search input").width($(window).width() - searchLeft - rightWidth);
	$(".search").width($(window).width() - searchLeft - rightWidth);
}