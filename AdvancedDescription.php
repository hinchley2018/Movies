<?php
/**
 * Created by PhpStorm.
 * User: jhinchley
 * Date: 4/12/17
 * Time: 8:06 PM
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

        <!--jquery and bootstrap-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>




    </head>
    <body>

<?php echo $nav_bar; ?>

<br><br>

<?php
    //var_dump($_POST);

    //this could screw up if someone sends incorrect args, but my form should take care of that
    reset($_POST);
    $key = key($_POST);

    //get row data from db using id
    $row = getAdvanced($db,$key);

    //var_dump($row);


    echo '
    <div class="container">
        <h1>'.$row['Name'].'</h1>
        <b>Date: </b>'.$row['Date'].'
        <br><br>
        <b>Time: </b>'.$row['Time'].'
        <br><br>
        <b>Location: </b>'.$row['Location'].'
        <br><br>
        <b>Zip: </b><div id="Zip">'.$row['Zip'].'</div>
        <br>
        <iframe
            
            width="100%"
            height="300px"
            
            frameborder="0" style="border:0"
            src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCtgyO6S_Gwi8njZRtHNuBT610ZPOszidI&q='.urlencode($row['Location']).'" allowfullscreen>
        </iframe>
        <br>
        
        <b>Description: </b><br>'.$row['Description'].'
        
    </div>
    ';

?>

    <div class="container">
        <h3>5-Day Forecast</h3>
    </div>
    <div class="container weather" style="overflow-y: scroll; height: 300px">

    </div>

    <script type="application/javascript">
        var zip = document.getElementById('Zip').textContent;
        //alert(zip);
        $('document').ready(function() {
            //alert("hello");
            $.getJSON("http://api.openweathermap.org/data/2.5/forecast?zip="+zip+"&APPID=9a2421509e61ec55533a2adcb34c9075", function(json){
                var weather ="";
                var count = parseInt(json.cnt);
                //alert(count);
                for (i = 0; i < count; i++) {
                    var iconCode = json.list[i].weather[0].icon;
                    var iconUrl = "http://openweathermap.org/img/w/" + iconCode + ".png";
                    //alert(json.list[0].weather[0].icon);
                    var dt = json.list[i].dt_txt;
                    weather += "<img src='" + iconUrl  + "'>"+dt;
                    weather+="<br>";
                }

                $(".weather").html(weather);
            })
        })

    </script>
    </body>
</html>