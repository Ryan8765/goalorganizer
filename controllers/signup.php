<?php 

	//array for errors
	$errors = array();
	//start a new database
	$db = new Database;
	
	

	/*
	* Handle weather a user has entered all needed form data.  If they have submit data to database
	*/
	if( isset($_POST['submit']) ) {



		//make sure fields aren't empty. if they are log errors to the $errors variable
		$required_fields = array(
			'First name'       => 'first_name',
			'Last name'        => 'last_name',
			'Email'            => 'email',
			'Password'         => 'password',
			'Confirm password' => 'password_confirm'
		);

		foreach( $required_fields as $key=>$value ) {
			if ( empty($_POST[$value]) ) {
				$errors[] = $key . " is a required field.";
			}
			//end if

		}
		//end foreach

		//make sure passwords match
		if( !empty($_POST['password']) ) {
			if( $_POST['password_confirm'] != $_POST['password'] ) {
				$errors[] = "Your passwords didn't match.";
			}
			//end if
		}
		//end if
		


		// //make sure certain fields are only alphabetic.  Log errors if not.
		// $fields = array(
		// 	'First Name'       => 'first_name',
		// 	'Last Name'        => 'last_name'
		// );

		// if( !empty($_POST['first_name']) || !empty($_POST['last_name']) ) {
		// 	foreach( $fields as $field ) {
		// 		if( isset($_POST[$field]) ) {
		// 			if( !ctype_alpha($_POST[$field]) ) {
		// 				$errors[] = "Your name can only contain letters.";
		// 			} 
		// 			//end if
		// 		}
		// 		//end if
		// 	}
		// 	//end foreach
		// }
		// //end if

		


		//make sure user doesn't already exist
		if( $db->user_already_exists($_POST['email']) ) {
			$errors[] = "I am sorry, a user with that email address already exists.";
		}



		//if there are no errors - enter information into database, else report errors.
		if( empty($errors) ) {
			$db->log_new_user_information();
			header("Location:".BASE_URL."success");
		}
	}
	//end if submit

	


	

