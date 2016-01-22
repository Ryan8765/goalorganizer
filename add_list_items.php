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

	
	$list_item = $_POST['list_item'];
	$time_frame = $_POST['time_frame'];

	//add the list items
	if( $db->add_list_item( $time_frame, $current_user, $list_item ) ) {
		$sanitized_html = sanitize_object_h( $db->get_list_items($time_frame, $current_user) );
		echo json_encode( $sanitized_html );
	}
	//end if

	
	
	





