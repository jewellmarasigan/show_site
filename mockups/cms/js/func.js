/* THIS JS FILE IS A MESS I KNOW OK IM SORRY */

var index = [];
var names = [];
var suggestions = [];
var selectedSuggestion = 0;

var searchSelected = false;

function init () {
	resizeSearch();
	hideSearch();
}

function resizeSearch () {
	var searchLeft = $("#search").offset().left;
	var rightWidth = $(".right").width();
	
	$(".search").css("left", searchLeft-1);
	$("#search input").width($(window).width() - searchLeft - rightWidth);
	$(".search").width($(window).width() - searchLeft - rightWidth + 2);
}

function showSearch () {
	searchSelected = true;
	$(".search").css("display", "block");
}

function hideSearch () {
	searchSelected = false;
	$(".search").css("display", "none");
}


function showSuggested () {
	$(".search .add span").html("Add ");	
	for (i=0; i<suggestions.length; i++) {
		$(".search .add span").append("<a class='name'>"+suggestions[i]+"</a>");
	}
	$(".search .add span").append(" as a user");
}

function isAllowSearch () {
	if($("#search input").val() != "") {
		return true;
	}else{
		return false;
	}
}

function trimEnds (str) {
    str = str.replace(/^\s+/, '');
    for (var i = str.length - 1; i >= 0; i--) {
        if (/\S/.test(str.charAt(i))) {
            str = str.substring(0, i + 1);
            break;
        }
    }
    return str;
}

function parseString (string) {
	nameArray = string.split(",");
	console.log(nameArray.length);
	
	for (i=0; i<nameArray.length; i++) {
		nameArray[i] = trimEnds(nameArray[i]);
		var currentName = nameArray[i]
		
		if (nameArray[i] == "" || nameArray[i] == " ") {
			nameArray.splice(i, 1);
		}
		
		console.log(currentName);	
	}
	
	suggestions = nameArray;
}

$("#search input").focus(function() {
	if (isAllowSearch()) {
		showSearch();	
	}
});

$("#search input").blur(function() {
	hideSearch();	
});


$("#search input").keyup(function() {
	if($("#search input").val() != "") {
		parseString($("#search input").val());
		showSearch();
		showSuggested();
	
	}else{
		hideSearch();	
	}
});

$(window).resize(function() {
	resizeSearch();
});

init();