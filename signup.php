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

    <!-- begin error block -->
    <?php if( !empty($errors) ): ?>
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <div class="errors">
            <?php foreach( $errors as $error ): ?>
              <p class="centered"><?php echo $error; ?></p>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    <?php endif; ?>
    <!-- begin error block -->


    <div class="row">
      <div class="col-md-4 col-md-offset-4">
          <form class="form-horizontal" action="<?php echo BASE_URL; ?>signup" method="POST">
            <fieldset>
              <div id="legend">
                <legend class="">Signup for Goal Organizer!</legend>
              </div>
              

              <div class="control-group">
                <label class="control-label" for="username">First Name</label>
                <div class="controls">
                  <input type="text" id="firstname" name="first_name" class="form-control" <?php reload_input_value_h('first_name');  ?>>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label" for="username">Last Name</label>
                <div class="controls">
                  <input type="text" id="lastname" name="last_name" class="form-control " <?php reload_input_value_h('last_name');  ?>>
                </div>
              </div>
           
              <div class="control-group">
                <label class="control-label" for="email">E-mail</label>
                <div class="controls">
                  <input type="email" id="email" name="email" placeholder="" class="form-control " <?php reload_input_value_h('email');  ?>>
                  <p class="help-block">Please provide your E-mail</p>
                </div>
              </div>
           
              <div class="control-group">
                <label class="control-label" for="password">Password</label>
                <div class="controls">
                  <input type="password" id="password" name="password" placeholder="" class="form-control " <?php reload_input_value_h('password');  ?>>
                  <p class="help-block">Password should be at least 6 characters</p>
                </div>
              </div>
           
              <div class="control-group">
                <label class="control-label" for="password_confirm">Password (Confirm)</label>
                <div class="controls">
                  <input type="password" id="password_confirm" name="password_confirm" placeholder="" class="form-control "  <?php reload_input_value_h('password_confirm');  ?>>
                  <p class="help-block">Please confirm password</p>
                </div>
              </div>
           
              <div class="control-group">
                <!-- Button -->
                <div class="controls">
                  <input class="btn btn-success" value="Register" type="submit" name="submit">
                </div>
              </div>
          </fieldset>
        </form>
      </div>
    </div>

    <div class="footer">
      
      <p class="centered white">Goal Organizer<br>All Rights Reserved &copy; 2015</p>
          
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









    