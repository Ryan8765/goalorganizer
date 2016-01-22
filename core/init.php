<?php 
	
	//config file
	require_once('config/config.php');

	//helpers function file
	require_once('helpers/helpers.php');

	//auto-load classes from the libraries folder
	function __autoload($class_name) {
		require_once('libraries/' . $class_name . '.php');
	}

 ?>