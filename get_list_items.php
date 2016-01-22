<?php 


	//start session
	session_start();
	//load all includes
	include('core/init.php');
	//start a database
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
	*	Handle data for list item from the ajax javascript request
	*/

	//the user_id is set in the php Database library under "check_user_loggin function"
	$current_user = $_SESSION['user_id'];
	$time_frame = $_POST['time_frame'];

	//if valid timeframe then return data
	if ( $time_frame == 1 || $time_frame == 2 || $time_frame == 3 ) {
		//sanitize the returned html to escape characters.
		$sanitized_html = sanitize_object_h( $db->get_list_items($time_frame, $current_user) );
		echo json_encode( $sanitized_html );
	} else {
		echo "not a valid timeframe";
	}
	//end if
	
	


	
	
	





