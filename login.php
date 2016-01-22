<?php 

  //load all includes
  include_once('core/init.php');
  include_once(DOCUMENT_ROOT . "controllers/login.php");

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Goal Organizer Login</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo BASE_URL; ?>assets/css/custom-login.css" rel="stylesheet">

  
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

    <div class="container">

      <form class="form-signin" method="post" action="<?php echo BASE_URL; ?>/login.php">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus name="email">
        <label for="inputPassword" class="sr-only">Password</label>
        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div>
          <a href="<?php echo BASE_URL; ?>signup">Create Account</a>
        </div>
        <div> 
          <a href="#">Forgot Password</a>
        </div>
        <input class="btn btn-lg btn-primary btn-block" type="submit" value="Login" name="submit">
      </form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo BASE_URL; ?>assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
