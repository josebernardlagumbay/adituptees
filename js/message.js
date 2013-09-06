$(document).ready(function(){

	/* Converting the #box div into a bounceBox: */
	$('#box').bounceBox();

	/* Listening for the click event and toggling the box: */
	$('a.button').click(function(e){

		$('#box').bounceBoxToggle();
	});
	
	/* When the box is clicked, hide it: */
	$('#box').click(function(){
		$('#box').bounceBoxHide();
	});
});

function init_message()
{
	$('#message_header').html('');
	$('#message_detail').html('');
}

function insert_detail_message(message)
{
	$('#message_detail').append(message+'<br/>');
}

function insert_header_message(message)
{
	$('#message_header').append(message+'<br/>');
}

function display_message()
{
	$('#box').css('display','block');
	$('#box').bounceBoxToggle();
}

function hide_message()
{
	$('#box').bounceBoxHide();
}

function cmdClose()
{
	$('#box').bounceBoxHide();
}