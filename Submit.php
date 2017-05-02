<?php
/**
 * Created by PhpStorm.
 * User: jhinchley
 * Date: 4/17/17
 * Time: 4:31 PM
 */

//connect to db and start session
require("db_connect.php");
include("Functions.php");
include("nav-bar.php")

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


<?php
    //print nav-bar
    echo $nav_bar;


    if (!empty($_POST)){
        //debug to show stuff is in post you need to view source of a page to see this
        var_dump($_POST);

        //Functions.php to insert the data into the database
        $result = insertEvents($db,$_POST);

        //successfully inserted
        if ($result == true){
            //display a message to user
            echo "<br><br><h2>Event Added</h2>";

            //redirect to home after giving user a few seconds to read msg
            header("refresh:2; url=index.php");
            exit();
        }
        //something broke
        else{
            //display a message to user
            echo "<br><br><h2>Oh Oh! Something went wrong.</h2>";

            //redirect to home after giving user a few seconds to read msg
            header("refresh:2; url=index.php");
            exit();
        }
    }
?>


