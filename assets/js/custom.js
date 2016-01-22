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
		return false;
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
	$(document).on('click', '.menu-li-button', function() {
		var element = $(this);

		show_list_item_buttons(element);
		return false;
	});


	//show show the menu buttons to delete, move up and move down a list item on hover
	$(document).on('mouseenter', '.list-group-item', function() {
		var menuButtonElement = $(this);
		var elementsToShow = $('.menu-button-item');
		//traverse up to the parent and then down to select all of the child elements with a class of menu-button-item
		var elements = menuButtonElement.find(elementsToShow);
		elements.show();
		return false;
	});


	//show show the menu buttons to delete, move up and move down a list item on hover
	$(document).on('mouseleave', '.list-group-item', function() {
		var menuButtonElement = $(this);
		var elementsToShow = $('.menu-button-item');
		//traverse up to the parent and then down to select all of the child elements with a class of menu-button-item
		var elements = menuButtonElement.find(elementsToShow);
		elements.hide();
		return false;
	});


	/*
	*	Show popup to modify text input for a specific li element
	*/

	//when the user double clicks list item text show popup to modify it.
	function modify_list_item(element) {
		var listItem = element;

		//get the contents of the first span element in the list item
		var listMessage = listItem.parent().find('span').eq(0).text();
		console.log(listMessage);
		//get the data-timeframe attribute value for the form
		var listItemID = listItem.parent().attr('data-id');
		//build the html for the popup form
		$('.form-popup textarea').val(listMessage);
		$('.form-popup .message-id').val(listItemID);
		$('.form-popup').fadeIn();
	}
	//end modify_list_item

	//when a user clicks the pencil to modify a list item
	function modify_list_item_pencil(element) {
		var listItem = element;

		//get the contents of the first span element in the list item
		var listMessage = listItem.parent().parent().find('span').eq(0).text();
		//get the data-timeframe attribute value for the form
		var listItemID = listItem.parent().parent().attr('data-id');
		console.log(listItemID);
		//build the html for the popup form
		$('.form-popup textarea').val(listMessage);
		$('.form-popup .message-id').val(listItemID);
		$('.form-popup').fadeIn();
	}
	//end modify_list_item

	//when a user doubleclicks a list item show form with current content.
	$(document).on('dblclick', '.message-item', function() {
		var element = $(this);
		modify_list_item(element);
		return false;
	});	

	//hide form when cancel button is clicked.
	$(document).on('click', '.cancel-btn', function() {
		$('.form-popup').fadeOut();
		return false;
	});

	//when user clicks on pencil show edit form 
	$(document).on('click', '.glyphicon-pencil', function() {
		var element = $(this);
		modify_list_item_pencil(element);
		return false;
	});	


	/*
	*	Show popup to delete all data from a timeframe
	*/

	function show_delete_list_popup(element) {
		var clickedElement = element;
		console.log('clicked trash can');
		//get the current timeframe id for the database
		var timeFrameID = element.attr('data-timeframe');

		//assign the data-timeframe to the hidden form-popup for the time frame ID value
		$('.timeframe-id').val(timeFrameID);
		//fadein the form
		$('.form-popup-2').fadeIn();
	}
	//end delete_list_items

	//on click of trashcan run show_delete_list_popup
	$('.trash-can').on('click', function() {
		var element = $(this);
		show_delete_list_popup(element);
	});

	//trashcan form popup - when user hits cancel hide the popup
	$('.cancel-btn-2').on('click', function() {
		$('.form-popup-2').fadeOut();
	});







	/*
	*	Make items sortable with jquery sort
	*/

	$('.sort-container').sortable();

	

	/*
	*	function to reformat date from 2015-02-23 to jan 21, 2015
	*/
	function format_date(date) {
		//modifed date to return
		var finalDate;
		//months array for converting number to alphabetic month.
		var months = [
			'Jan',
			'Feb',
			'Mar',
			'Apr',
			'May',
			'June',
			'July',
			'Aug',
			'Sept',
			'Oct',
			'Nov',
			'Dec'
		];

		var day = date.slice(8, 10);

		var month = date.slice(5, 7);
		//convert to integer
		month = parseInt(month);
		//get the alphabetic value for the month.
		month = months[month];
		var year = date.slice(0, 4);

		//concat the date.
		finalDate = month + " " + day + ", " + year;

		return finalDate;
	}





	/*
	*	Post list items to add_list_items.php when user clicks submit on any of the forms
	*/

	//function to handle if item has been checked off or not.  isCheckedOff is from the database.
	function checkedOff(isCheckedOff) {
		//change database number to integer
		isCheckedOff = parseInt(isCheckedOff);
		//if it's not completed give it a class name of uncompleted-item. else completed item.
		if ( !isCheckedOff ) {
			return 'uncompleted-item';
		} else {
			return 'completed-item';
		}
	}



	//function to build list item from JSON that is returned from $.POST.  Builds the html for one list item
	function build_list_item( listItem, timeframe ) {
		var html = '<div class="list-group-item" data-time-frame="';
		html += timeframe;
		html += '"';
		html += 'data-id="';
		html += listItem.list_id;
		html += '"';
		html += '><span class="';
		html += checkedOff(listItem.list_completed);
		html += ' message-item">';
		html += listItem.list_contents;
		html += '</span><br><br><em><small class="dates">';
		html += format_date(listItem.list_date.slice(0, 10));
		html += '</small></em><div class="menu-li-button"><span class="glyphicon glyphicon-menu-hamburger"></span></div><div class="delete menu-button-item"><span class="glyphicon glyphicon-remove delete-button control-buttons" aria-hidden="true"></span></div><div class="menu-button-item"><span class="glyphicon glyphicon-ok control-buttons" aria-hidden="true"></span></div><div class="move-list-item menu-button-item"><span class="glyphicon glyphicon-arrow-up control-buttons" aria-hidden="true"></span></div><div class="move-list-item menu-button-item"><span class="glyphicon glyphicon-arrow-down control-buttons" aria-hidden="true"></span></div><div class="move-list-item menu-button-item"><span class="glyphicon glyphicon-pencil control-buttons" aria-hidden="true"></span></div></div>';

		return html;
	}
	//end build_list_html

	//function to reorder html so crossed off list items are last.
	function append_completed_items( timeframe ) {
		var timeframe_class = "#timeframe-" + timeframe;
		var timeframe_list_items = $(timeframe_class).children();
		var current_list_item_span;
		var current_list_item;

		timeframe_list_items.each(function( index ) {
			current_list_item_span = timeframe_list_items.eq(index).find('span').first();
			current_list_item = timeframe_list_items.eq(index);
			//if current list item has been checked off remove it and add it to the array nodes to append.
			if ( current_list_item_span.hasClass('completed-item') ) {
				current_list_item.remove();
				$(timeframe_class).append(current_list_item);
			}
			//end if
		});

	}
	//end append_completed_items


	//function to build list html given a JSON string and set the corresponding timeframe with the data
	function build_list_html(data, timeframe) {
		var timeframe = timeframe;
		var data = $.parseJSON( data );
		//find the length of data
		dataLength = data.length;
		var listItem;
		var html;
		
		if( dataLength >= 1 ) {
			for( var i = 0; i < dataLength; i++ ) {
				//use if statement to get rid of initial undefined value of HTML variable.
				if ( i === 0 ) {
					html = build_list_item( data[i], timeframe );
				} else {
					html += build_list_item( data[i], timeframe );
				}
				//end if
			}
			//end for
		} else {
			html = "";
		}
		//end if


		//inject the html
		var divToInjectHTML = '#timeframe-' + timeframe;
		$(divToInjectHTML).html(html);

		//reorder list items so crossed off items come last.
		append_completed_items( timeframe )
	}
	//end build list html



	//create a function to show and hide a successful form submission
	function item_added(element) {
		var elementToShow = element;
		element.next().fadeIn();
		setTimeout(function(){ 
			element.next().fadeOut();
		}, 1000);
	}
	//end item added


	//create a function for when a user doesn't enter any input
	function no_content(element) {
		var elementToShow = element;
		element.next().next().fadeIn();
		setTimeout(function(){ 
			element.next().next().fadeOut();
		}, 1000);
	}



	//when the form is submitted, send the information to add_list_items.php
	$(document).on('submit', '.submit-item', function(){
		var form = $(this);
		var timeFrame = form.attr('data-timeframe');
		//variable to check and make sure a form value was entered
		var checkIfValue = $.trim(form.find('textarea').val());
		if( checkIfValue ) {
			$.post('add_list_items.php', form.serialize() )
				.done(function(data){
					form.find('textarea').val('');
					item_added(form);
					//build the html and output it
					build_list_html(data, timeFrame);

				}).
				fail(function(){
					alert('Error connecting to database');
				});
			//end post
		} else {
			form.find('textarea').val('');
			no_content(form);
		}
		return false;
	});

	//run the same code if enter is clicked within the textarea
	$('.submit-item textarea').keyup(function(event) {
		//check if something was entered in textarea
		var checkIfValue = $.trim($(this).val());
		var form = $(this).parent().parent();
		var timeFrame = form.attr('data-timeframe');

		if( checkIfValue ) {
			//if user hits enter
			if (event.keyCode == 13) {
		        
				$.post('add_list_items.php', form.serialize())
					.done(function(data){
						//reset the form value to nothing.
						form.find('textarea').val('');
						item_added(form);
						$(this).focus();
						//set the html in the view
						build_list_html(data, timeFrame);
					}).
					fail(function(){
						alert('Error connecting to database');
					});
				//end post
				return false;
		    }
		    //end if
		} else {
			form.find('textarea').val('');
			no_content(form);
		}
		//end if
	});



	/*
	*	Handle delete list items for a timeframe form submission via ajax
	*/

	$(document).on('submit', '#delete-list-items', function(){
		var form = $(this);

		//get the current timeframe from the hidden form input 
		var timeFrame = form.find('input').val();
		console.log(timeFrame);
		$.post('delete_list_items.php', form.serialize())
			.done(function(data){
				console.log(data);
				//set the html in the view
				build_list_html(data, timeFrame);
				$('.form-popup-2').fadeOut();
			}).
			fail(function(){
				alert('Error connecting to database');
			});
		//end post
		
		return false;
	});



	/*
	*	function to load list data for each time frame. Takes a user_id parameter and a timeframe.
	*/

	function load_list_data( timeframe ) {
		
		//post to the php file.
		$.post('get_list_items.php', { time_frame: timeframe } )
			.done(function(data){
				//build the html and output it
				build_list_html(data, timeframe);
			}).
			fail(function(){
				alert('Error with your request.');
			});
			//end post
	}
	//end load_list_data


	/*
	*	create sortable lists that update the database when a user changes a list item order.
	*/

	//function to make sure only digits
	function isNumber(n) {
	  return !isNaN(parseFloat(n)) && isFinite(n);
	}

	//function to find out what timeframe we are currently in.  It checks whether a timeframe is hidden..if it's not that is the timeframe we are currently in. 
	function current_timeframe() {

		var timeframes = [
			'.daily-container',
			'.monthly-container',
			'.yearly-container'
		];
		var length = timeframes.length;
		//current element you're checking in the for loop
		var currentElement;
		//is the element displayed variable.
		var isDisplayed;
		//for loop to go through each array element
		for ( var i = 0; i < length; i++ ) {
			currentElement = $(timeframes[i]);
			//check the display css for the element
			isDisplayed = currentElement.css('display');
			if( isDisplayed == "block" ) {
				//if the element is displayed - return the timeframe in its digit value.
				return i + 1;
			}
			//end if
		}
		//end for
	}
	//end current_timeframe()


	//function to get all the id's of sorted elements and send them to the php file to process.
	function send_sort_order() {
		//get the current viewed timeframe
		var currentTimeframe = current_timeframe();
		//elements to sort
		var elementSelector = ".list-group-item[data-time-frame='" + currentTimeframe + "']";
		var elements    = $(elementSelector);
		var numElements = elements.length;
		//the data we want to send to php
		var dataToPHP   = "";
		var validated = true;


		//for each element get it's id (which is it's id in the database) and create a comma separated string with it. 
		elements.each(function() {
			//validate if the id is actually a number on the <li> element. 
			if(!isNumber($(this).attr('data-id'))) {
				validated = false;
			}

			dataToPHP = dataToPHP + $(this).attr('data-id');
			dataToPHP = dataToPHP + " ";
		});

		
		if( validated ) {
			$.post( "update_list_order.php", { list_order: dataToPHP, time_frame: currentTimeframe }, function(data){
					console.log("returned data " + data);
				})
				.fail(function() {
					console.log('failed to make connection to php file');
			});
		} else {
			alert('failed to sort items');
		}
	} //end send_sort_order()


	//after user has updated the sort for jquery sortable, send the function send_sort_order() to update the database.
	$(document).on( "sortupdate", ".sort-container", function( event, ui ) {
		send_sort_order();
	});





	/*
	*	Handle moving an item up or down the list. 
	*/

	//moves a list item up one spot in the timeframe. Also reorders the database.  Element is the up arrow button you clicked on...and timeframe is the current timeframe being viewed.
	function move_list_item_up( timeframe, element ) {
		//get the parent div of the button element up button that was clicked.  This is the first list-group-item div.
		var listGroupItemDiv = element.parent().parent();
		//get the index of the list Group item and subtract one to get the previous id index where listGroupItemDiv needs to be placed
		var listGroupItemIndex = listGroupItemDiv.index() - 1;
		//get the container that holds all of the list-group items.
		var container = "#timeframe-" + timeframe;
		container = $(container);

		//make sure this isn't the first item, if it is do nothing
		if( listGroupItemIndex >= 0 ) {
			//remove the div from it's current position
			listGroupItemDiv.remove();
			//insert the div into it's new location
			container.children().eq(listGroupItemIndex).before(listGroupItemDiv);
			//run the update list function to the database
			send_sort_order();
		}
		//end if
	}
	//move_list_item_up

	//when user clicks the up arrow, move the specified list item up and update the database
	$(document).on('click', '.glyphicon-arrow-up', function () {
		var element = $(this);
		move_list_item_up(current_timeframe(), element);
	});






	//moves a list item down one spot in the timeframe. Also reorders the database.  Element is the down arrow button you clicked on...and timeframe is the current timeframe being viewed.
	function move_list_item_down( timeframe, element ) {
		//get the parent div of the button element up button that was clicked.  This is the first list-group-item div.
		var listGroupItemDiv = element.parent().parent();
		//get the index of the list Group item and add one to get the previous id index where listGroupItemDiv needs to be placed
		var listGroupItemIndex = listGroupItemDiv.index();
		//get the container that holds all of the list-group items.
		var container = "#timeframe-" + timeframe;
		container = $(container);
		//get the number of list items in this time frame
		var numberOfListItems = container.children().length;

		//make sure this isn't the last item, if it is do nothing
		if( listGroupItemIndex != numberOfListItems - 1 ) {
			//remove the div from it's current position
			listGroupItemDiv.remove();
			//insert the div into it's new location
			container.children().eq(listGroupItemIndex).after(listGroupItemDiv);
			//run the update list function to the database
			send_sort_order();
		}
		//end if

		
	}
	//move_list_item_up

	//when user clicks the up arrow, move the specified list item up and update the database
	$(document).on('click', '.glyphicon-arrow-down', function () {
		var element = $(this);
		move_list_item_down(current_timeframe(), element);
	});



	/*
	*	Handle modify list item functionality
	*/

	//create function to send data to update a list item when "update" button is clicked.
	function update_list_item( element ) {
		//the id of the list item in question.
		var list_id = element.prev().val();

		var list_message = element.parent().find('textarea').val();
		//verify that list_id is a number - protect against injections
		if ( !isNumber(list_id) ) {
			return false;
		}
		//end if

		//current timeframe
		var time_frame = current_timeframe();


		$.post( "button_items.php", { list_message: list_message, update_list_item: true, time_frame: time_frame, list_id: list_id }, function(data){
					console.log("returned data " + data);
					//reload the list data.
					load_list_data( time_frame );

				})
				.fail(function() {
					console.log('failed to make connection to php file');
			});
	}
	//end update_list_item


	//when update button is clicked, send request to server to modify list item. 
	$(document).on('click', '#modify-list-item', function() {
		var element = $(this);
		update_list_item( element );
		//fade out the form
		$('.form-popup').fadeOut();
	});






	/*
	*	Take care of sorting checked off items to the bottom of the list. 
	*/

	//function to sort checked off items to bottom of the list.
	function move_checked_off_items( timeframe ) {
		//get the container of the current list items
		var container = $('#timeframe-' + timeframe);
		//get all the list items.
		var list_items = container.children();
		console.log(list_items);
		var is_checked_off;
		//iterate over each list item and see if there is a span element with a class of "completed-item"
		list_items.each(function (index) {
			is_checked_off = $(this).find('span').hasClass('completed-item');
			if( is_checked_off ) {
				//remove dom node
				$(this).remove();
				//append to the end of the current timeframe
				container.append($(this));
			}	
			//end if
		});

	}
	//end checked_off_items


	//change class of list item function when checked off is clicked.  The element attribute is the pencil that was clicked
	function check_uncheck_list_item( element ) {
		//get the span element
		var spanElement = element.parent().parent().find('.message-item');
		var listItemDiv = element.parent().parent();
		//data-id for the list item
		var list_id = listItemDiv.attr('data-id');
		var time_frame = current_timeframe();
		//what value to send the database for checked off column
		var isCheckedOff;
		//if it has class "completed-item" remove it and add "uncompleted-item" else opposite and either append or prepend
		if( spanElement.hasClass('completed-item') ) {
			spanElement.removeClass('completed-item');
			spanElement.addClass('uncompleted-item');
			listItemDiv.remove();
			listItemDiv.prependTo('#timeframe-' +  current_timeframe());
			isCheckedOff = 0;
		} else {
			spanElement.removeClass('uncompleted-item');
			spanElement.addClass('completed-item');
			listItemDiv.remove();
			listItemDiv.appendTo('#timeframe-' +  current_timeframe());
			isCheckedOff = 1;
		}

		//send the newly generated sort order to the database.
		send_sort_order();

		//send the item that was changed and update the database.
		//post to the php file.
		$.post('button_items.php', { time_frame: time_frame, checked_off: true, list_id: list_id, is_checked_off: isCheckedOff } )
			.done(function(data){
				console.log(data);
			}).
			fail(function(){
				alert('Error with your request.');
			});
		//end post

	}
	//end check_uncheck_list_item

	//when check is clicked, modify the text to show it checked off...or reintroduce it. 
	$(document).on('click', '.glyphicon-ok', function(){
		var element = $(this);

		check_uncheck_list_item( element )
	});


	/*
	*	Handle delete list item button functionality
	*/

	function delete_list_item( element ) {
		//get the id of the list item
		var list_id = element.closest('.list-group-item').attr('data-id');
		var time_frame = current_timeframe();
		//post to the php file the time frame and the list item id
		$.post('button_items.php', {  delete_item: true, list_id: list_id } )
			.done(function(data){
				console.log(data);

				//reload the list data.
				load_list_data( time_frame );
			}).
			fail(function(){
				alert('Error with your request.');
			});
		//end post


	}
	//end delete_list_item

	//when user clicks on delete button, delete the list item.
	$(document).on('click', '.delete-button', function(){
		var element = $(this);
		delete_list_item( element );
	});



	/*
	*	page load functions to run
	*/


	//load daily list data for currenlty logged in user. 
	load_list_data( 1 );
	//load monthly list data for currenlty logged in user. 
	load_list_data( 2 );
	//load yearly list data for currenlty logged in user. 
	load_list_data( 3 );
	





});