<?php 
	session_start();
	include_once(DOCUMENT_ROOT . 'core/init.php');
	//start new instance of database
	$db = new Database;
	//errors array to hold all of the error messages
	$errors = array();
	//initialize login attempts if not set
	if( isset($_SESSION['login_attempts']) ) {
		$_SESSION['login_attempts'] = 0;
	}

	// //create a random token
	// $token = rand_token(16);

	// //assign the session the token. 
	// $_SESSION['token'] = $token;

	/*
	* Handle login 
	*/
	//if form has been submitted
	if( isset($_POST['submit']) ) {
		//if a password and an email were provided
		if(  isset($_POST['password']) && isset($_POST['email']) ) {

			$is_successful_login = $db->check_user_login( $_POST['email'], $_POST['password'] );
			//if the login was successful redirect and set session, otherwise show errors. 
			if( $is_successful_login ) { 
				$_SESSION['logged_in'] = true;
				$_SESSION['user'] = $_POST['email'];
				header("Location:".BASE_URL."goals");
			} else {
				$errors[] = "Incorrect email or password.  Please try again.";
			}

		}
		//end if
	}
	//end if


