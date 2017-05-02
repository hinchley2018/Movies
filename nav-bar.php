<?php
/**
 * Created by PhpStorm.
 * User: jhinchley
 * Date: 4/12/17
 * Time: 5:47 PM
 */
    //connect to db and start session
    require("db_connect.php");
    //require("Functions.php");

$userID = 0;
$nav_bar= '
<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top" xmlns="http://www.w3.org/1999/html">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="index.php">Community Event Hub</a>
  </div>
  <div id="navbar" class="navbar-collapse collapse navbar-left">
    <ul class = "nav navbar-nav">
      <li class = "nav-item"><a href="index.php">Home</a></li>
      
      
      <li class = "nav-item dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Event Management <span class="caret"></span></a>
          <ul class="dropdown-menu">
            
            <li><a href="YourEvents.php">Manage Your Events</a></li>
            <!--
            If i have time
            <li><a href="PromoteEvent.php">Promote Your Events</a></li>
             
            <li role="separator" class="divider"></li>
            <li><a href="Profile.php">Profile</a></li>
            -->
          </ul>
      </li>
      <li><a href="AddEvent.php">Add Events <span class="glyphicon glyphicon-plus"></span></a></li>
      

    </ul>
    
  </div>
  <div class="navbar-collapse collapse navbar-right">
    <ul class="nav navbar-nav">
        <div class="g-signin2" data-onsuccess="onSignIn"></div>

        <!--<li class="nav-item"><a href="#" onclick="signOut();">Sign out</a></li>-->
    </ul>
</div>
    


</nav>';

function getMessages($db,$userID){

    $messageQuery = "SELECT Owner,Data FROM Messages WHERE Recipient=:id";
    try{
        $sth = $db->prepare($messageQuery);
        $query_params = array(':id'=>$userID);
        $result=$sth->execute($query_params);
    }
    catch (PDOException $e){
        // Note: On a production website, you should not output $ex->getMessage().
        // It may provide an attacker with helpful information about your code.
        die("Failed to run booth query: ");//. $e->getMessage()
    }

    $rows = $sth->fetchAll();

    $messages = '
    <li class = "nav-item dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Messages <span class="caret"></span></a>
        <ul class="dropdown-menu">
    ';
    foreach ($rows as $row){
        $messages .= '
            <li><a href="#">'.$row["Owner"].'</a></li><!-- this will be name once I create user table-->
            <li role="separator" class="divider"></li>';
    }

    $messages .= '
        </ul>
    </li>
    ';
    return $messages;

}