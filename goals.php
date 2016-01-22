<?php 
  //start session
  session_start();
  //load all includes
  include('core/init.php');
  //include controller
  include(DOCUMENT_ROOT.'controllers/goals.php');

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
    <link href="<?php echo BASE_URL; ?>assets/css/custom.css" rel="stylesheet">
  </head>
  <body>


    
    <!-- navigation block -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Goal Organizer</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a id="daily" class="nav-button daily" href="#">Daily</a></li>
            <li><a id="monthly" class="nav-button monthly" href="#">Monthly</a></li>
            <li><a id="yearly" class= "nav-button yearly" href="#">Yearly</a></li>
            <li><a class= "logout" href="<?php echo BASE_URL; ?>help">Help</a></li>
            <li><a class= "logout" href="<?php echo BASE_URL; ?>logout">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <!-- end navigation block -->



    <!-- used for getting list data -->
    <!-- <form action="#" method="post" id="user-id-input">
      <input id="hidden-time-frame" name="time_frame" type="hidden">
    </form> -->
    <!-- used for getting list data -->




    <!-- begin daily container -->
    <div class="daily-container view-block">
      <div class="container margin">
        <div class="row">
          <h1 class="centered daily-title">Daily</h1>
        </div>
      </div>


      <div class="row margin-sm">
        <div class="col-md-4 col-md-offset-4">
            <div class="well li-daily">
              <form method="post" action="#" class="form-horizontal submit-item" data-timeframe="1">
                <div class="form-group" style="padding:14px;">
                  <textarea  maxlength="5000" class="form-control" placeholder="Add a Daily Goal..." name="list_item"></textarea>
                </div>
                <div class="centered">
                  <input class="btn btn-daily" value="Add Goal" name="submit" type="submit">
                </div>
                <input type="hidden" name="time_frame" value="1">
              </form>
              <div class="item-added">
                <p>Your item was succesfully added!</p>
              </div>
              <div class="no-content">
                <p>You didn't enter a list item.</p>
              </div>
            </div>
        </div>
      </div>
      

      <!-- enter item panel -->
      <div class="row margin margin-sm">
        <div class="col-md-6 col-md-offset-3">
          <div class="panel panel-default li-daily">
            <div class="panel-heading">
                <h4>Daily Goals <span class="trash-can glyphicon glyphicon-trash" aria-hidden="true" title="Delete All List Items" data-timeframe="1"></span></h4>
            </div>
              <div class="panel-body">
                <div id="timeframe-1" class="list-group sort-container" data-timeframe="1">
                  
                  <!-- begin list group items -->
                 <!--  <?php foreach ( $dailyListItems as $item ): ?>
                    <div class="list-group-item" data-timeframe="1">
                      <span class="<?php checked_off( $item->list_completed ); ?> message-item">
                        <?php echo $item->list_contents; ?>
                      </span>
                      <br>
                      <br>
                      <em><small class="dates"><?php echo format_date_h( $item->list_date ); ?></small></em>
                      <div class="menu-li-button">
                        <span class="glyphicon glyphicon-menu-hamburger"></span>
                      </div>
                      <div class="delete menu-button-item" title="Delete Item">
                        <span class="glyphicon glyphicon-remove delete-button control-buttons" aria-hidden="true"></span>
                      </div>
                      <div class="menu-button-item" title="Check Off Item">
                        <span class="glyphicon glyphicon-ok control-buttons" aria-hidden="true"></span>
                      </div>
                      <div class="move-list-item menu-button-item" title="Move Item Up">
                        <span class="glyphicon glyphicon-arrow-up control-buttons" aria-hidden="true"></span>
                      </div>
                      <div class="move-list-item menu-button-item" title="Move Item Down">
                        <span class="glyphicon glyphicon-arrow-down control-buttons" aria-hidden="true"></span>
                      </div>
                      <div class="move-list-item menu-button-item" title="Edit Text">
                        <span class="glyphicon glyphicon-pencil control-buttons" aria-hidden="true"></span>
                      </div>
                    </div>
                  <?php endforeach; ?> -->
                  

                  <!-- end list group items -->



                  <!-- <div class="list-group-item" data-timeframe="1">
                    <span class="uncompleted-item message-item">  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum natus repellat deserunt necessitatibus accusantium tempora voluptatum nulla atque fugiat adipisci ducimus ab iste iure facilis, pariatur modi, officia, quis minus.</span>
                    <br>
                    <br>
                    <em><small class="dates">Jan 21, 2015</small></em>
                    <div class="menu-li-button">
                      <span class="glyphicon glyphicon-menu-hamburger"></span>
                    </div>
                    <div class="delete menu-button-item">
                      <span class="glyphicon glyphicon-remove delete-button control-buttons" aria-hidden="true"></span>
                    </div>
                    <div class="menu-button-item">
                      <span class="glyphicon glyphicon-ok control-buttons" aria-hidden="true"></span>
                    </div>
                    <div class="move-list-item menu-button-item">
                      <span class="glyphicon glyphicon-arrow-up control-buttons" aria-hidden="true"></span>
                    </div>
                    <div class="move-list-item menu-button-item">
                      <span class="glyphicon glyphicon-arrow-down control-buttons" aria-hidden="true"></span>
                    </div>
                    <div class="move-list-item menu-button-item">
                      <span class="glyphicon glyphicon-pencil control-buttons" aria-hidden="true"></span>
                    </div>
                  </div> -->
                  



                </div>
              </div>
              <!--/panel-body-->
            </div>
            <!-- end col -->
          </div>
          <!--/panel-->
      </div> 
      <!-- end row -->
      <!-- enter item panel end -->

      <div class="cover-container centered margin">
        <div class="mastfoot">
          <div class="inner">
            <p>Goal Organizer<br>All Rights Reserved &copy; 2015</p>
          </div>
        </div>
      </div>


    </div>
    <!-- end daily container -->




    <!-- begin monthly container -->
    <div class="monthly-container view-block">
      <div class="container margin">
        <div class="row">
          <h1 class="centered monthly-title">Monthly</h1>
        </div>
      </div>


      <div class="row margin-sm">
        <div class="col-md-4 col-md-offset-4">
            <div class="well li-monthly">
              <form method="post" action="#" class="form-horizontal submit-item" data-timeframe="2">
                <div class="form-group" style="padding:14px;">
                  <textarea  maxlength="5000" class="form-control" placeholder="Add a Monthly Goal..." name="list_item"></textarea>
                </div>
                <div class="centered">
                  <input class="btn btn-monthly" value="Add Goal" name="submit_month" type="submit">
                </div>
                <input type="hidden" name="time_frame" value="2">
              </form>
              <div class="item-added">
                <p>Your item was succesfully added!</p>
              </div>
              <div class="no-content">
                <p>You didn't enter a list item.</p>
              </div>
            </div>
        </div>
      </div>
      




      <!-- buttons panel -->
      <!-- <div class="row margin">
        <div class="col-md-6 col-md-offset-3 centered">
          <button class="daily btn btn-success btn-lg">Daily</button>
          <button class="monthly btn btn-info btn-lg">Monthly</button>
          <button class="yearly btn btn-warning btn-lg">Yearly</button>
        </div>
      </div> -->
      <!-- end buttons panel -->

      <!-- enter item panel -->
      <div class="row margin margin-sm">
        <div class="col-md-6 col-md-offset-3">
          <div class="panel panel-default li-monthly">
            <div class="panel-heading">
              <h4>Monthly Goals<span class="trash-can glyphicon glyphicon-trash" aria-hidden="true" title="Delete All List Items" data-timeframe="2"></span></h4>
            </div>
              <div class="panel-body">
                <div id="timeframe-2" class="list-group sort-container">
                  <!-- <div class="list-group-item" data-timeframe="2">
                    <span class="uncompleted-item message-item">  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum natus repellat deserunt necessitatibus accusantium tempora voluptatum nulla atque fugiat adipisci ducimus ab iste iure facilis, pariatur modi, officia, quis minus.</span>
                    <br>
                    <br>
                    <em><small class="dates">Jan 21, 2015</small></em>
                    <div class="menu-li-button">
                      <span class="glyphicon glyphicon-menu-hamburger"></span>
                    </div>
                    <div class="delete menu-button-item" title="Delete Item">
                      <span class="glyphicon glyphicon-remove delete-button control-buttons" aria-hidden="true"></span>
                    </div>
                    <div class="menu-button-item" title="Check Off Item">
                      <span class="glyphicon glyphicon-ok control-buttons" aria-hidden="true"></span>
                    </div>
                    <div class="move-list-item menu-button-item" title="Move Item Up">
                      <span class="glyphicon glyphicon-arrow-up control-buttons" aria-hidden="true"></span>
                    </div>
                    <div class="move-list-item menu-button-item" title="Move Item Down">
                      <span class="glyphicon glyphicon-arrow-down control-buttons" aria-hidden="true"></span>
                    </div>
                    <div class="move-list-item menu-button-item" title="Edit Text">
                      <span class="glyphicon glyphicon-pencil control-buttons" aria-hidden="true"></span>
                    </div>
                  </div> -->


                  <!-- begin list group items -->
                  
                  <!-- end list group items -->
                  
                  
                  
                </div>
              </div>
              <!--/panel-body-->
            </div>
            <!-- end col -->
          </div>
          <!--/panel-->
      </div> 
      <!-- end row -->
      <!-- enter item panel end -->


      
      <div class="cover-container centered margin">
        <div class="mastfoot">
          <div class="inner">
            <p>Goal Organizer<br>All Rights Reserved &copy; 2015</p>
          </div>
        </div>
      </div>

    </div>
    <!-- end monthly container -->

    





    <!-- begin yearly container -->
    <div class="yearly-container view-block">
      <div class="container margin">
        <div class="row">
          <h1 class="centered yearly-title">Yearly</h1>
        </div>
      </div>


      <div class="row margin-sm">
        <div class="col-md-4 col-md-offset-4">
            <div class="well li-yearly">
              <form method="post" action="#" class="form-horizontal submit-item" data-timeframe="3">
                <div class="form-group" style="padding:14px;">
                  <textarea  maxlength="5000" class="form-control" placeholder="Add a Yearly Goal..." name="list_item"></textarea>
                </div>
                <div class="centered">
                  <input class="btn btn-yearly" value="Add Goal" name="submit" type="submit">
                </div>
                <input type="hidden" name="time_frame" value="3">
              </form>
              <div class="item-added">
                <p>Your item was succesfully added!</p>
              </div>
              <div class="no-content">
                <p>You didn't enter a list item.</p>
              </div>
            </div>
        </div>
      </div>
      




      <!-- buttons panel -->
      <!-- <div class="row margin">
        <div class="col-md-6 col-md-offset-3 centered">
          <button class="daily btn btn-success btn-lg">Daily</button>
          <button class="monthly btn btn-info btn-lg">Monthly</button>
          <button class="yearly btn btn-warning btn-lg">Yearly</button>
        </div>
      </div> -->
      <!-- end buttons panel -->

      <!-- enter item panel -->
      <div class="row margin margin-sm">
        <div class="col-md-6 col-md-offset-3">
          <div class="panel panel-default li-yearly">
            <div class="panel-heading">
              <h4>Yearly Goals<span class="trash-can glyphicon glyphicon-trash" aria-hidden="true" title="Delete All List Items" data-timeframe="3"></span></h4>
            </div>
              <div class="panel-body">
                <div id="timeframe-3" class="list-group sort-container">
                  <!-- <div class="list-group-item" data-timeframe="3">
                    <span class="uncompleted-item message-item">  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum natus repellat deserunt necessitatibus accusantium tempora voluptatum nulla atque fugiat adipisci ducimus ab iste iure facilis, pariatur modi, officia, quis minus.</span>
                    <br>
                    <br>
                    <em><small class="dates">Jan 21, 2015</small></em>
                    <div class="menu-li-button">
                      <span class="glyphicon glyphicon-menu-hamburger"></span>
                    </div>
                    <div class="delete menu-button-item" title="Delete Item">
                      <span class="glyphicon glyphicon-remove delete-button control-buttons" aria-hidden="true"></span>
                    </div>
                    <div class="menu-button-item" title="Check Off Item">
                      <span class="glyphicon glyphicon-ok control-buttons" aria-hidden="true"></span>
                    </div>
                    <div class="move-list-item menu-button-item" title="Move Item Up">
                      <span class="glyphicon glyphicon-arrow-up control-buttons" aria-hidden="true"></span>
                    </div>
                    <div class="move-list-item menu-button-item" title="Move Item Down">
                      <span class="glyphicon glyphicon-arrow-down control-buttons" aria-hidden="true"></span>
                    </div>
                    <div class="move-list-item menu-button-item" title="Edit Text">
                      <span class="glyphicon glyphicon-pencil control-buttons" aria-hidden="true"></span>
                    </div>
                  </div> -->



                  <!-- begin list group items -->
                  
                  <!-- end list group items -->

                  
                  
                  
                  
                </div>
              </div>
              <!--/panel-body-->
            </div>
            <!-- end col -->
          </div>
          <!--/panel-->
      </div> 
      <!-- end row -->
      <!-- enter item panel end -->


      
      <div class="cover-container centered margin">
        <div class="mastfoot">
          <div class="inner">
            <p>Goal Organizer<br>All Rights Reserved &copy; 2015</p>
          </div>
        </div>
      </div>

    </div>
    <!-- end yearly container -->







    <!-- begin modify message form -->
    <div class="form-popup">
        <div class="col-md-4 col-md-offset-4">
          <h3 class="centered">Modify List Item</h3>
          <div class="form-group">
            <textarea class="form-control" rows="5" maxlength="5000"></textarea>
          </div>
          <input name="timeframe" class="message-id" type="hidden">
          <button id="modify-list-item" class="btn btn-success">Update</button>
          <div class="btn btn-warning cancel-btn">Cancel</div>
        </div>
    </div>
    <!-- end modify message form -->


    <!-- begin delete all timeframe popup form -->
    <div class="form-popup-2">
        <div class="col-md-4 col-md-offset-4">
          <form id="delete-list-items" method="post" action="#" class="centered">
            <h3 class="centered">Delete all list items for this time frame?</h3>
            <input name="timeframe" class="timeframe-id" type="hidden">
            <button type="submit" class="btn btn-success">Yes</button>
            <div class="btn btn-warning cancel-btn-2">Cancel</div>
          </form>
        </div>
    </div>
    <!-- end delete all timeframe popup -->




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









    