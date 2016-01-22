<?php 

	//create a new database instance
	$db = new Database;

	/*
	*	Handle session privacy checking user_agent
	*/


	$redirect_url = BASE_URL . "login.php";
	session_user_agent_h($redirect_url, "userAgent");
	//end if

	//make sure user is logged in
	check_if_logged_in_h();

	/*
	*	Get all list item rows for each time frame
	*/
	$current_user = $_SESSION['user_id'];
	$dailyListItems = $db->get_list_items(1, $current_user);
	$monthlyListItems = $db->get_list_items(2, $current_user);
	$yearlyListItems = $db->get_list_items(3, $current_user);

	/*
	*	create function that displays checked off or unchecked off list item classes
	*/
	function checked_off( $checkedOff ) {
		//if item is checked off echo class
		if( $checkedOff ) {
			echo "completed-item";
		} else {
			echo "uncompleted-item";
		}
	}
	//end check_off










	

	
