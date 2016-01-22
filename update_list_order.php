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
	*	Handle reorder of list items
	*/

	
	//get the new list order array of id's from the ajax call.
	$new_list_order = $_POST['list_order'];
	//get the time frame and user id 
	$time_frame = $_POST['time_frame'];
	$current_user = $_SESSION['user_id'];
	//get rid of trailing empty space setup by ajax
	$new_list_order = rtrim( $new_list_order );
	
	//get array of id's of images - id's are the id of the image in the database.
	$list_order_array = explode(" ", $new_list_order);
	

	//update list order
	$db->reorder_list_items( $list_order_array, $time_frame, $current_user );
		
	
