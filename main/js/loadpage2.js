$(document).ready(function(){
	var ajax_load = "<img src='js/loading_spinner.gif' alt='loading...' />";
	
	var page = $(this).attr('href');
	$('#right').html(ajax_load).load('index3.php');
	return false;
});