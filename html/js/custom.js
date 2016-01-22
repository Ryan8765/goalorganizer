$(document).ready(function() {


	/*
	*	Create a function to show the different year/day/month views. Takes one parameter - the nav object clicked on.
	*/

	function show_different_time(element) {
		//gets the desired time frame from the class name
		var desiredTimeFrame = element.attr('id');
		//create the class element to show
		var elementToShow = "." + desiredTimeFrame + "-container";
		console.log(elementToShow);
		//hide the current time frame
		$('.view-block').fadeOut(800);
		
		//use set-timeout so you can see the element fadein
		setTimeout(function(){ 
			//fade in the desired time frame
			$(elementToShow).fadeIn(800);
		}, 800);
		//end set timeout

	}
	//end show_different_time




	//on nav click show a different time frame
	$('.nav-button').on('click', function() {
		var desiredTimeFrame = $(this);
		show_different_time(desiredTimeFrame);
	});	
	//end .nav-button on click


	/*
	*	Menu button function to run when list item menu button is clicked.  Takes the specific menu icon that is clicked on as as parameter.
	*/

	function show_list_item_buttons(element) {
		var menuButtonElement = element;
		var elementsToShow = $('.menu-button-item');
		//traverse up to the parent and then down to select all of the child elements with a class of menu-button-item
		var elements = menuButtonElement.parent().find(elementsToShow);
		elements.fadeToggle();
	}

	//on menu button click, show the menu buttons to delete, move up and move down a list item.
	$('.menu-li-button').on('click', function() {
		var element = $(this);

		show_list_item_buttons(element);
	});


	//show show the menu buttons to delete, move up and move down a list item on hover
	$('.list-group-item').mouseenter(function() {
		var menuButtonElement = $(this);
		var elementsToShow = $('.menu-button-item');
		//traverse up to the parent and then down to select all of the child elements with a class of menu-button-item
		var elements = menuButtonElement.find(elementsToShow);
		elements.show();
	});


	//show show the menu buttons to delete, move up and move down a list item on hover
	$('.list-group-item').mouseleave(function() {
		var menuButtonElement = $(this);
		var elementsToShow = $('.menu-button-item');
		//traverse up to the parent and then down to select all of the child elements with a class of menu-button-item
		var elements = menuButtonElement.find(elementsToShow);
		elements.hide();
	});


	/*
	*	Show popup to modify text input for a specific li element
	*/

	function modify_list_item(element) {
		var listItem = element;

		//get the contents of the first span element in the list item
		var listMessage = listItem.parent().find('span').eq(0).text();
		//get the data-id attribute value for the form
		var listItemID = listItem.parent().attr('data-id');
		console.log(listItemID);
		//build the html for the popup form
		$('.form-popup textarea').text(listMessage);
		$('.form-popup .message-id').val(listItemID);
		$('.form-popup').fadeIn();
	}
	//end modify_list_item

	function modify_list_item_pencil(element) {
		var listItem = element;

		//get the contents of the first span element in the list item
		var listMessage = listItem.parent().parent().find('span').eq(0).text();
		//get the data-id attribute value for the form
		var listItemID = listItem.parent().parent().attr('data-id');
		console.log(listItemID);
		//build the html for the popup form
		$('.form-popup textarea').text(listMessage);
		$('.form-popup .message-id').val(listItemID);
		$('.form-popup').fadeIn();
	}
	//end modify_list_item

	//when a user doubleclicks a list item show form with current content.
	$('.message-item').on('dblclick', function() {
		var element = $(this);
		modify_list_item(element);
		return false;
	});	

	//hide form when cancel button is clicked.
	$('.cancel-btn').on('click', function() {
		$('.form-popup').fadeOut();
		return false;
	});

	//when user clicks on pencil show edit form 
	$('.glyphicon-pencil').on('click', function() {
		var element = $(this);
		modify_list_item_pencil(element);
		return false;
	});	






	/*
	*	Make items sortable with jquery sort
	*/

	$('.sort-container').sortable();





});