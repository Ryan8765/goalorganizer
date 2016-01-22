<?php 
  //start session
  session_start();
  //load all includes
  include('core/init.php');
  //include controller
  include(DOCUMENT_ROOT.'controllers/signup.php');
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Yearly Goal App</title>

    <!-- Bootstrap -->
    <link href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- custom css -->
    <link href="<?php echo BASE_URL; ?>assets/css/signup.css" rel="stylesheet">

  </head>
  <body>


    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <h2 class="white centered">
          You successfully created an Organizer account.  Please sign in at the following link: <a href="<?php echo BASE_URL ?>login">Login</a>
        </h2>
      </div>
    </div>
    


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo BASE_URL; ?>assets/js/bootstrap.min.js"></script>
    <!-- custom script -->
    <script src="<?php echo BASE_URL; ?>assets/js/custom.js"></script>
    <!-- custom script -->
    <script src="<?php echo BASE_URL; ?>assets/js/jquery-ui.js"></script>
  </body>
</html>









    