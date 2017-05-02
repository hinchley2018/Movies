<?php
/**
 * Created by PhpStorm.
 * User: jhinchley
 * Date: 4/12/17
 * Time: 5:47 PM
 */


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
    <a class="navbar-brand" href="index.php">Movies Hub</a>
  </div>
  <div id="navbar" class="navbar-collapse collapse navbar-left">
    <ul class = "nav navbar-nav">
      
      <li><a href="AddEvent.php">Add Movies <span class="glyphicon glyphicon-plus"></span></a></li>

    </ul>
    
  </div>
  <div class="navbar-collapse collapse navbar-right">
    <ul class="nav navbar-nav">
        <div class="g-signin2" data-onsuccess="onSignIn"></div>

        <!--<li class="nav-item"><a href="#" onclick="signOut();">Sign out</a></li>-->
    </ul>
</div>
    


</nav>';
