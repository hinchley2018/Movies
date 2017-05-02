<?php
/**
 * Created by PhpStorm.
 * User: jhinchley
 * Date: 4/26/17
 * Time: 5:24 PM
 */

//connect to db and start session
require("db_connect.php");
include("Functions.php");
include("nav-bar.php");

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Community Event Hub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body>

<?php echo $nav_bar;
    echo '<br><br><br>';
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="input-group" id="adv-search">
                <!-- http://www.w3schools.com/tags/tag_datalist.asp -->

                <div class="input-group-btn">
                    <div class="btn-group" role="group">

                        <form class="form-horizontal" role="form" action="Results.php" method="post">
                            <input id="eventInput" list="event" name="browser" class="form-control" placeholder="Search for events">
                            <datalist id="events">
                                <?php getEvents($db); ?>
                            </datalist>
                            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    if (!empty($_POST)){
        //debug to show stuff is in post you need to view source of a page to see this
        //var_dump($_POST);

        $results = getSearchedEvents($db,$_POST['browser']);

        //theres some results that match
        if (!empty($results)){
            //display a message to user
            echo '
            <div class="container">
                <h3>Results</h3>
            </div>

            <div class="container events" style="overflow-y: scroll; height: 300px">

                <form method="post" action="AdvancedDescription.php">';
            foreach ($results as $result){
                echo '
                <div id="event">
                      <button name="'.$result['ID'].'" id="'.$result['ID'].'">'.$result['Name'].'</button>
                      <!--this should submit the form and navigate to next page-->
                      <img src="http://www.atheistrepublic.com/sites/default/files/vote-up-down.png" alt="Event" height="42" width="42"/>
                      '.$result['Rating'].'
                </div>';
                if(end($results) !== $result){
                    echo '<hr>'; // not the last element
                }
            }
            echo '
                </form>
            </div>
            ';

        }
        //no results
        else{
            //display a message to user
            echo '
            <div class="container">
                <h3>No Results</h3>
            </div>
            ';
        }
    }
?>



</body>
</html>