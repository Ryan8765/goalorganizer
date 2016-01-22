<?php   


	/***************************
		This file handles most of the button functionality of the list items (delete button, modify pencil button etc.).  It does this via a $.post from javascript in the custom.js file
	****************************/


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
	$user_id = $_SESSION['user_id'];

	/*
	*	handle update list items.
	*/

	//if update list item was clicked in the browser.
	if ( isset($_POST['update_list_item']) ) {
		$list_id = $_POST['list_id'];
		$updated_message = $_POST['list_message'];
		echo $updated_message;



		$db->update_list_item( $list_id, $user_id, $updated_message );
	}
	//end if


	//if pencil button was clicked in the browser.
	if ( !empty($_POST['checked_off']) ) {
		$list_id = $_POST['list_id'];
		//what value to add to the column list_completed in database
		$is_checked_off = $_POST['is_checked_off'];

		$db->update_list_item_is_completed( $list_id, $user_id, $is_checked_off );
	}
	//end if


	//if delete button was clicked handle ajax post from javascript.
	if ( $_POST['delete_item'] ) {
		$list_id = $_POST['list_id'];
		
		//update the database
		$db->delete_list_item( $user_id, $list_id );
	}
	//end if


	


