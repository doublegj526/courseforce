$(document).ready(function(){
	var ajax_load = "<img src='js/loading_spinner.gif' alt='loading...' />";
	
	var page = $(this).attr('href');

	$('#left').html(ajax_load).load('index2.php');

	return false;
});