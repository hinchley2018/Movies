<?php

/**
 * Created by PhpStorm.
 * User: jhinchley
 * Date: 11/22/16
 * Time: 5:16 PM
 */

function insertEvents($db,$data){
    $eventQuery = "INSERT INTO events (Name, Description, Location, Zip, Date, Time) VALUES (:name, :des, :loc, :zip, :date, :time)";
    try{
        $sth = $db->prepare($eventQuery);
        $query_params = array(
            ':name'=>$data["Name"],
            ':des'=>$data["Description"],
            ':loc'=>$data["Location"],
            ':zip'=>intval($data["Zip"]),
            ':date'=>$data["Date"],
            ':time'=>$data["Time"]
        );
        $result=$sth->execute($query_params);
        return $result;
    }
    catch (PDOException $e){
        // Note: On a production website, you should not output $ex->getMessage().
        // It may provide an attacker with helpful information about your code.
        die("Failed to run event query: ". $e->getMessage());//. $e->getMessage()
    }


}

function getMovies($db){
    $eventQuery = "SELECT * FROM events";
    try{
        $sth = $db->prepare($eventQuery);

        $result=$sth->execute();
    }
    catch (PDOException $e){
        // Note: On a production website, you should not output $ex->getMessage().
        // It may provide an attacker with helpful information about your code.
        die("Failed to run booth query: ");//. $e->getMessage()
    }

    $rows = $sth->fetchAll();
    $count = 0;
    echo '
    <table class="table">
        <tr>
            <th>Event</th>
            <th>Date</th>
            <th>Owner</th>
        </tr>
    ';
    foreach ($rows as $row) {
        echo '
        <div id="event">
             <tr>
              <td><button class="" name="'.$row['ID'].'" id="'.$row['ID'].'">'.$row['Name'].'</button></td>
              <td>'.$row['Date'].'</td>
              <td>N/A</td>
              <!--<img src="http://www.atheistrepublic.com/sites/default/files/vote-up-down.png" alt="Event" height="42" width="42"/>-->
            </tr>
        </div>';//'.$row['Rating'].'
        /*
        if(end($rows) !== $row){
            echo '<hr>'; // not the last element
        }
        */
        $count++;
    }
    echo '</table>';
}

function getWeather(){
    //do API call here

    echo '
    <img src="https://d30y9cdsu7xlg0.cloudfront.net/png/19222-200.png" alt="Event" height="142" width="142"/>Mon
    <img src="https://d30y9cdsu7xlg0.cloudfront.net/png/19222-200.png" alt="Event" height="142" width="142"/>Tues
    <img src="https://d30y9cdsu7xlg0.cloudfront.net/png/19222-200.png" alt="Event" height="142" width="142"/>Wed
    ';
}

function getAdvanced($db,$id){
    $eventQuery = "SELECT * FROM events WHERE ID=:id";
    try{
        $sth = $db->prepare($eventQuery);
        $query_params = array(':id'=>$id);
        $result=$sth->execute($query_params);
    }
    catch (PDOException $e){
        // Note: On a production website, you should not output $ex->getMessage().
        // It may provide an attacker with helpful information about your code.
        die("Failed to run booth query: ");//. $e->getMessage()
    }

    //weird way of getting
    $rows = $sth->fetchAll();
    //only return first result
    $row = $rows[0];
    return $row;
}

function getUserEvents($db,$userID){
    $eventQuery = "SELECT ID,Name FROM events WHERE Owner=:id";
    try{
        $sth = $db->prepare($eventQuery);
        $query_params = array(':id'=>$userID);
        $result=$sth->execute($query_params);
    }
    catch (PDOException $e){
        // Note: On a production website, you should not output $ex->getMessage().
        // It may provide an attacker with helpful information about your code.
        die("Failed to run booth query: ");//. $e->getMessage()
    }

    //weird way of getting
    $rows = $sth->fetchAll();

    //theres some events
    if (!empty($rows)){

        echo '
        <form method="post" action="ManageEvent.php">
            <select name="Events">';
        foreach ($rows as $row){
            echo '<option value="'.$row["ID"].'">'.$row["Name"].'</option>';
        }
        echo '
            </select>
            <input type="submit">
        </form>
        ';
    }
    else{
        echo '<h3>No Events</h3>';
    }
}

function getSearchedEvents($db,$keyword){
    $eventQuery = "SELECT ID,Name FROM events WHERE Name LIKE '%{$keyword}%'";
    try{
        $sth = $db->prepare($eventQuery);
        $query_params = array(':keyword'=>$keyword);
        $result=$sth->execute($query_params);
    }
    catch (PDOException $e){
        // Note: On a production website, you should not output $ex->getMessage().
        // It may provide an attacker with helpful information about your code.
        die("Failed to run booth query: ");//. $e->getMessage()
    }

    //weird way of getting
    $rows = $sth->fetchAll();
    return $rows;
}