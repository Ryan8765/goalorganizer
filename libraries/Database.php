<?php 

	class Database {

		private $username = DB_USERNAME;
		private $host = DB_HOST;
		private $pw = DB_PW;
		private $name = DB_NAME;

		private $error;
		private $stmt;
		private $db;


		//construct a new PDO database object
		function __construct() {
			$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->name;

			//options for the database connection
			$options = array(
				PDO::ATTR_PERSISTENT => true,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
			);
			

			//if there are errors connecting to the database catch them and echo the error messages
			try {
				$this->db = new PDO($dsn, $this->username, $this->pw);
			} catch (PDOException $e) {
				echo "<p>There were errors connecting to the database: " . $e->getMessage() . "</p>";
			}
			//end try/catch
			
		}
		//end constructor


		/*
		*	Query method for database
		*/

		public function query($query) {
			$this->stmt = $this->db->prepare($query);
		}
		//end insert_data function




		/*
		*	Get one row of data from database
		*/

		public function single_row() {
			
		}
		//end single_row function





		/*
		*	check user login with email and password
		*/

		public function check_user_login($email, $password) {
			
			//check for email address in database to get the salt for the password
			$query = "SELECT * FROM users 
					  WHERE user_email = :email";
			$statement = $this->db->prepare($query);
			$statement->bindValue(':email' , $email);
			$statement->execute();
			//fetch the row as an object
			$row = $statement->fetch(PDO::FETCH_OBJ);
			//if that email doesn't exist return false, otherwise keep going.
			if( !$row ) {
				return false;
			}
			//get the database salt value
			$database_salt_value = $row->user_salt;
			//close the cursor
			$statement->closeCursor();



			//encrypt the password to check the database encrypted password
			$options = [
			    'cost' => 11,
			    'salt' => $database_salt_value
			];

			$encrypted_password = password_hash($password, PASSWORD_BCRYPT, $options);

			//check the encrypted password against the database password and email
			$query = "SELECT * FROM users 
					  WHERE user_email = :email 
					  AND user_pw = :password";
			$statement = $this->db->prepare($query);
			$statement->bindValue(':email' , $email);
			$statement->bindValue(':password' , $encrypted_password);
			$statement->execute();

			//fetch the row of data if one exists
			$rows = $statement->fetch(PDO::FETCH_OBJ);
			//start session for the new user
			$_SESSION['user_id'] = $rows->user_id;
			return $rows;
		}
		//end check_user_login



		/*
		*	Make sure user doesn't exist by checking for their email address
		*/ 
		public function user_already_exists($email) {

			$query = "SELECT * FROM users 
					  WHERE user_email = :email";
			$statement = $this->db->prepare($query);
			$statement->bindValue(':email' , $email);
			$statement->execute();
			//fetch the row as an object
			$row = $statement->fetch(PDO::FETCH_OBJ);

			return $row;

		}
		//end user_already_exists



		/*
		*	Enter new user information into database.
		*/
		public function log_new_user_information() {

			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			//options for encrypting
			$options = [
				//cost is basically a way to slow down brute force attacks.  It takes more resources to do a brute force attack.  10 is the recommended value
			    'cost' => 11,
			    //used to salt the password.
			    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)
			];
			


			//deal with encrypting the password.  password_hash is a php function.
			$password = password_hash($password, PASSWORD_BCRYPT, $options);

			//create query
			$query = "INSERT INTO users (user_firstname, 	   user_lastname, user_email, user_pw, user_salt)
					  VALUES (:first_name, :last_name, :email, :password, :salt)";
			//bind values
			$statement = $this->db->prepare($query);
			$statement->bindValue( ':first_name', $first_name );
			$statement->bindValue( ':last_name', $last_name );
			$statement->bindValue( ':email', $email );
			$statement->bindValue( ':password', $password );
			$statement->bindValue( ':salt', $options['salt'] );
			//execute statement and report an error if you weren't added to the database
			if( !$statement->execute() ) {
				$errors[] = "I am sorry, your input was not able to be added.  Please try again.";
			}
			//close the cursor
			$statement->closeCursor();
		} 
		//end log_user_information


		/*
		*	Add a new list item
		*/

		public function add_list_item( $timeframe, $user_id, $list_item ) {
			//change timeframe to integer
			$timeframe = intval($timeframe);
			//first check timeframe.  If not a correct timeframe return false.
			if ( $timeframe != 1 && $timeframe != 2 && $timeframe != 3 ) {
				echo "timeframe error";
				return false;
			}
			//find the maximum list_order in the current timeframe
			$query = "SELECT MAX(list_order) 
					  AS list_order
					  FROM lists
					  WHERE user_id = :user_id
					  AND list_category = :time_frame";
			$statement = $this->db->prepare($query);
			$statement->bindValue(':time_frame' , $timeframe);
			$statement->bindValue(':user_id' , $user_id);
			$statement->execute();
			$row = $statement->fetch(PDO::FETCH_OBJ);
			$max_list_order = $row->list_order;

			//this is the list order number for the database.  Orders the list items.
			$list_order = $max_list_order + 1;

			//create query to insert the new 
			$query = "INSERT INTO lists (list_order, list_category, user_id, list_contents)
					  VALUES (:list_order, :list_category, :user_id, :list_contents)";
			//bind values
			$statement = $this->db->prepare($query);
			$statement->bindValue( ':list_order', $list_order );
			$statement->bindValue( ':list_category', $timeframe );
			$statement->bindValue( ':user_id', $user_id );
			$statement->bindValue( ':list_contents', $list_item );

			if( !$statement->execute() ) {
				return false;
			} else {
				return true;
			}
			//end if
			
		}
		//end add_list_item



		/*
		*	Delete list items for a timeframe
		*/

		public function delete_list_items_by_timeframe( $user_id, $time_frame ) {
			//make sure we have a real timeframe value
			if ( $time_frame != 1 && $time_frame != 2 && $time_frame != 3 ) {
				echo "timeframe error";
				return false;
			}

			//create query to insert the new 
			$query = "DELETE FROM lists
					  WHERE user_id = :user_id
					  AND list_category = :time_frame";
			//bind values
			$statement = $this->db->prepare($query);
			$statement->bindValue( ':time_frame', $time_frame );
			$statement->bindValue( ':user_id', $user_id );

			//if the statement doesn't execute return false.
			if( !$statement->execute() ) {
				return false;
			} else {
				return true;
			}
			//end if
		}
		//end delete_list_items


		/*
		*	Get list items 
		*/


		public function get_list_items($timeframe, $user_id) {

			//get the list items for the specified timeframe
			$query = "SELECT *
					  FROM lists
					  WHERE list_category = :time_frame
					  AND user_id= :user_id
					  ORDER BY list_order";
			$statement = $this->db->prepare($query);
			$statement->bindValue(':time_frame' , $timeframe);
			$statement->bindValue(':user_id' , $user_id);
			$statement->execute();
			$rows = $statement->fetchAll(PDO::FETCH_OBJ);


			return $rows;
		}
		//end get_list_items()


		/*
		*	Update list order
		*/
		public function reorder_list_items( $list_order_id_array, $time_frame, $user_id ) {
			$orderCounter = 1;
			foreach( $list_order_id_array as $id ) {

				//create query
				$query = "UPDATE lists
						  SET list_order = :order
						  WHERE list_category = :timeframe
						  AND user_id = :user_id
						  AND list_id = :id";
				//bind values
				$statement = $this->db->prepare($query);
				$statement->bindValue( ':timeframe', $time_frame );
				$statement->bindValue( ':order', $orderCounter );
				$statement->bindValue( ':user_id', $user_id );
				$statement->bindValue( ':id', $id );

				$statement->execute();
				
				//increase order counter
				$orderCounter++;
			}
			//end foreach

			//close the cursor
			$statement->closeCursor();

		}
		//end reorder_images()





		/*
		*	Function that updates list items.
		*/
		public function update_list_item( $list_id, $user_id, $message ) {
			//create query
				$query = "UPDATE lists
						  SET list_contents = :contents
						  WHERE list_id = :list_id
						  AND user_id = :user_id";
				//bind values
				$statement = $this->db->prepare($query);
				$statement->bindValue( ':contents', $message );
				$statement->bindValue( ':list_id', $list_id );
				$statement->bindValue( ':user_id', $user_id );
				$statement->execute();
		}
		//update_list_item() end




		/*
		*	Function that updates list item column list_completed. deals with checking off a list item and adding the class when it is checke doff. 
		*/
		public function update_list_item_is_completed( $list_id, $user_id, $is_checked_off ) {
			//create query
				$query = "UPDATE lists
						  SET list_completed = :completed
						  WHERE list_id = :list_id
						  AND user_id = :user_id";
				//bind values
				$statement = $this->db->prepare($query);
				$statement->bindValue( ':completed', $is_checked_off );
				$statement->bindValue( ':list_id', $list_id );
				$statement->bindValue( ':user_id', $user_id );
				$statement->execute();
		}
		//update_list_item() end

		/*
		*	function to handle delete button on list item.  delete a list item.
		*/
		function delete_list_item( $user_id, $list_id ) {
			//build the query
			$query = "DELETE FROM lists
					  WHERE user_id = :user_id
					  AND list_id = :list_id";
			//prepare the query to be sent
			$statement = $this->db->prepare($query);
			$statement->bindValue( ':user_id', $user_id );
			$statement->bindValue( ':list_id', $list_id );
			if( $statement->execute() ) {
				return true;
			}
		}
		//end delete_list_item

		/*
		*	Function to get the latest date you did an exercise.
		*/

			
		function exercise_last_done_date_h( $exerciseID, $userID ) {



			$query = "SELECT MAX(date) 
					  AS lastdate 
					  FROM sets 
					  WHERE exercises_id = :exercises_id
					  AND userID = :userID";

			$statement = $this->db->prepare($query);
			$statement->bindValue(':exercises_id' , $exercisesID);
			$statement->bindValue(':userID' , $userID);
			$statement->execute();
			//fetch the row as an object
			$exercise = $statement->fetch(PDO::FETCH_OBJ);

			$date = $exercise->date;

			return $date;

		}//end user_already_exists



	}
	//end Database class
 ?>