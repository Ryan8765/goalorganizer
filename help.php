<?php 
  //start session
  session_start();
  //load all includes
  include('core/init.php');
  //include controller
  include(DOCUMENT_ROOT.'controllers/help.php');
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
      <h3 class="white centered">
        <a class="white" href="<?php echo BASE_URL; ?>goals">Back to Goals</a>
      </h3>
    </div>

    <!-- add item block -->
    <div class="row">
      <div class="help-item col-md-6 col-md-offset-3">
        <h1 class="title-help centered">
          Add an Item
        </h1>
        <div class="centered">
          <img class="images-help" src="<?php echo BASE_URL; ?>assets/img/enter-item.png" alt="Image Enter Help">
        </div>
        <p class="centered text-help">
          Enter an item and hit enter or click "Add Goal";
        </p>
      </div>
    </div>
    <!-- add item block -->


    <div class="row">
      <div class="help-item col-md-6 col-md-offset-3">
        <h1 class="title-help centered">
          Modify a List Item
        </h1>
        <div class="centered">
          <img class="images-help" src="<?php echo BASE_URL; ?>assets/img/modify-item.png" alt="Image Enter Help">
          <img class="images-help" src="<?php echo BASE_URL; ?>assets/img/modify-item-2.png" alt="Image Enter Help">
        </div>
        <p class="centered text-help">
          Option 1 - Double click the text you want to change.
        </p>
        <p class="centered text-help">
          Option 2 - Hover your mouse over the item and click the pencil icon.
        </p>
        <p class="centered text-help">
          Phones - Click the menu button on the list item in the upper right hand corner and then click the pencil button. 
        </p>
      </div>
    </div>

    
    <!-- check off item block -->
    <div class="row">
      <div class="help-item col-md-6 col-md-offset-3">
        <h1 class="title-help centered">
          Check/Uncheck List Item
        </h1>
        <div class="centered">
          <img class="images-help" src="<?php echo BASE_URL; ?>assets/img/check-item.png" alt="Image Enter Help">
        </div>
        <p class="centered text-help">
          Click the green arrow to check/uncheck an item.  If checked off it will move to the bottom of your list.  If you uncheck it by clicking the green arrow again, it will move to the top of your list.  
        </p>
      </div>
    </div>
    <!-- check off item block -->


    <!-- move item block -->
    <div class="row">
      <div class="help-item col-md-6 col-md-offset-3">
        <h1 class="title-help centered">
          Move a List Item
        </h1>
        <div class="centered">
          <img class="images-help" src="<?php echo BASE_URL; ?>assets/img/move-item.png" alt="Image move help">
        </div>
        <p class="centered text-help">
          Option 1 - Click and drag an item to desired location.
        </p>
        <p class="centered text-help">
          Option 2 - Use the up and down arrow icons.
        </p>
      </div>
    </div>
    <!-- move off item block -->

    <!-- delete item block -->
    <div class="row">
      <div class="help-item col-md-6 col-md-offset-3">
        <h1 class="title-help centered">
          Delete a List Item
        </h1>
        <div class="centered">
          <img class="images-help" src="<?php echo BASE_URL; ?>assets/img/delete-item.png" alt="Image move help">
        </div>
        <p class="centered text-help">
          Click the "x" icon.
        </p>
      </div>
    </div>
    <!-- delete item block -->


    <!-- delete all item block -->
    <div class="row">
      <div class="help-item col-md-6 col-md-offset-3">
        <h1 class="title-help centered">
          Delete All List Items
        </h1>
        <div class="centered">
          <img class="images-help" src="<?php echo BASE_URL; ?>assets/img/delete-all-items.png" alt="Image move help">
        </div>
        <p class="centered text-help">
          Click the trash icon.  This will delete all list items from the current time frame.  Other time frames won't be affects.
        </p>
      </div>
    </div>
    <!-- delete all item block -->




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









    