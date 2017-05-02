<?php
    //connect to db and start session
    require("db_connect.php");
    include("Functions.php");
    include("nav-bar.php")

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Home Movie Hub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <!--google signin-->
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id" content="352736303365-c1b4madqmo13iak7n3fq4bncft0in9e1.apps.googleusercontent.com">
    <script src="assets/js/main.js"></script>

  </head>
  <body>

  <?php echo $nav_bar; ?>

  <br><br><br>
  <!--searchbar
  Link for snippet http://bootsnipp.com/snippets/2q81r
  Originally created by maridlcrmn
  Modified by me XD
  Note to self I may not end up using this because the autocomplete is so useful
  -->

  <!--http://stackoverflow.com/questions/4871595/highlight-div-for-few-seconds-->
  <div class="container" >
  <div class="row" id="search">
          <div class="col-md-10">
              <div class="input-group" id="adv-search">
                  <!-- http://www.w3schools.com/tags/tag_datalist.asp -->

                  <div class="input-group-btn">
                      <div class="btn-group" role="group">

                          <form class="form-horizontal" role="form" action="Results.php" method="post">
                              <input id="eventInput" list="event" name="browser" class="form-control" placeholder="Search for events">
                              <datalist id="events">
                                  <?php getMovies($db); ?>
                              </datalist>
                              <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                          </form>

                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
    <div class="container">
        <h3>Events</h3>
    </div>
    <div class="container movies" style="overflow-y: scroll; height: 300px">

        <form method="post" action="AdvancedDescription.php">
            <?php getMovies($db); ?>

        </form>
    </div>
      <br> <br>
      <div class="container">
          <h2>How It Works</h2>
          <p>Our app allows people to view what movies we own and add things to the wishlist. It offers a simple interface for people without an advanced technology background.</p>
      </div>
    <br> <br>

  <br><br>
  <a rel="nofollow" href="https://www.indeed.com/hire?indpubnum=8399187059831638"><img id="banner" src=" https://d2wqp97cin3huh.cloudfront.net/Dradis-Ads-for-Publishers/A-Dual/A-728x90Publishers.gif" alt="Post a Job"></a>

  </body>
</html>
