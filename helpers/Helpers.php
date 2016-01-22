<?php 
	


	/*
	*	function to redirect to a different webpage
	*/
	// public function redirect_URL($URL) {
	// 	return header("Location:".$URL);
	// }
	//end redirect_URL

	/*
	*	function to create a random token - $length is the length of the random token you want generated.
	*/
	function rand_token($length) {
		$token = bin2hex( openssl_random_pseudo_bytes($length / 2) );  
		return $token;
	}


	/*
	*	Check if the user agent session variable has been set, if not set it.  Also checks to make sure valid user agent for the current session...if not redirect.  It takes a redirect_path variable to send the user to if the session doesn't match. It also takes a session_name variable which names the user agent session variable. 
	*/

	function session_user_agent_h($redirect_path, $session_name) {
		if( !isset($_SESSION[$session_name]) ) {
			$_SESSION[$session_name] = $_SERVER['HTTP_USER_AGENT'] ;
		}
		//end if

		//if a session user agent has been set, check to make sure it is the same one.  Otherwise redirect.
		if( isset($_SESSION['agent']) ) {
			if( $_SERVER['HTTP_USER_AGENT']  != $_SESSION[$session_name] ) {
				header("Location:".$redirect_path);
			}
			//end if
		}
		//end if
	}
	//end session_user_agent()

	/*
	*	Function for error reporting.  Takes the error parameter you want to show on the screen. 
	*/
	function error_h($error) {
		echo "<h1>" . $error . "</h1><br>";
	}

	/*
	*	Destroy a session completely
	*/

	function session_destroy_h() {
		//clear browser session variables
		if ( isset( $_COOKIE[session_name()] ) ) {
			setcookie( session_name(), "", time()-3600, "/" );
		}
		//clear session from globals
		$_SESSION = array();
		//clear session from disk
		session_destroy();
	}
	//end session_destroy_h


	/*
	*	Check that a session has been initiated, if not redirect to login
	*/
	function check_if_logged_in_h() {
		if( !isset($_SESSION['logged_in']) ) {
			header("Location:".BASE_URL."login");
		}
	}





	/*
	*	Make sure all fields are filled out on a form. Uses a variable (not in the function) called $errors to log errors to as it checks if fields are filled out.  Modify the interior array in this function to change form fields.  The values in the array need to match the $_POST names of the input fields. 
	*/

	function are_fields_empty() {
		//field of required inputs.  The values need to match post_values
		$errors = array();
		$required_fields = array(
			'First Name'       => 'first_name',
			'Last Name'        => 'last_name',
			'Email'            => 'email',
			'Password'         => 'password',
			'Confirm Password' => 'password_confirm'
		);

		foreach( $required_fields as $key=>$value ) {
			if ( !isset($_POST[$value]) ) {
				$errors[] = $value . "is a required field.";
			}
			//end if
		}
		//end foreach
		
		if( isset($errors) ) {
			return $errors;
		}
	}
	//end are_fields_empty()

	/*
	*	Are fields alphabetic - checks whether the given fields are alphabetic and if not logs an error message in $errors array.  Array values must match input names on form
	*/

	function are_fields_alphabetic() {

		$fields = array(
			'First Name'       => 'first_name',
			'Last Name'        => 'last_name'
		);

		foreach( $fields as $field ) {
			if( isset($_POST[$field]) ) {
				if( !ctype_alpha($_POST[$field]) ) {
					$errors[] = "Your name can only contain letters.";
				} 
				//end if
			}
			//end if
		}
		//end foreach
	}
	//end are_fields_alphabetic()



	/*
	*	Reload input values into form fields if the form has been submitted.
	*/

	function reload_input_value_h($input_name) {
		if( isset($_POST[$input_name]) ) {
			echo "value='".$_POST[$input_name]."'";
		}
	}
	//end reload_input_value_h

	//format date function
	function format_date_h($date) {
		$formatted_date = date("M j, Y",strtotime($date));
		return $formatted_date;
	}//end format_date()


	/*
	*	Function to sanitize rows of data from an array that contains objects - works for rows returned by database fetchAll function. 
	*/

	function sanitize_object_h( $array ) {
		$array_modified = $array;

		foreach( $array_modified as $object ) {
			foreach( $object as &$item ) {
				$item = htmlentities( $item, ENT_QUOTES );
			}
			//end foreach
		}
		//end foreach
		return $array_modified;
	}
	//end sanitize_object_h

 ?>