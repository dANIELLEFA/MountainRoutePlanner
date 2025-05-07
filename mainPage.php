<?php
// allows page to use the functions
require_once('functions.php');

$start =$_POST['StartPoint'];
$stop =$_POST['StopPoint'];
// sends the user back to index if they choose the same location or 
//if they did not select a start or stop
if($start ===$stop)
{
   header('Location: index.php?r=y');
}
if(!isset($start)||!isset($stop))
{
    header("Location: index.php");
}
//gets information to insert into logs
date_default_timezone_set("America/Denver");
$date = date("Y-m-d");
$time =date("H:i:s");
//inserts information into logs
$log = Insert('logs'," (day,time,origin,destination) ",
"'$date','$time','$start' ,'$stop'");
//adds one the to the amount of times visited to both cities
$startVisited = selectVisitCount("$start");
$startVisited++;
$stopVisited = selectVisitCount("$stop");
$stopVisited++;
// updates both cities visited counts
$updateStart =update("cities","visitcount = '$startVisited'", "name = '$start'");
$updateStop =update("cities","visitcount = '$stopVisited'", "name = '$stop'");
//styles page
style();
?>
<!DOCTYPE html>
<html>
<!-- decorates the bottom section, the table, and the buttons -->
    <head>
        <meta charset="UTF-8">
        <style>
           
            .endOfPage 
            {
                background-color: #2d2c2f;
                overflow: hidden;
                height:50px
                
            }
            .endOfPage p
            {
                
                /* float: left; */
                color: #dfdedc;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
                font-size: 17px;
            }
             th, td {
            border: 3px #926049 solid;
            }
            table{
                text-align:center;
            }
            h1
            {
                text-align: center;
                color:white;
            }
            button
            {
                background-color:#995339;
                color: white;
            }
        </style>
</head>
<body>
    <!-- displays navigation bar -->
    <div class="navigationBar">
        <a href ="index.php">Home</a>
        <a href ="loginPage.php">Log In</a>
    </div>
    
    <h1><?php echo $start?> To <?php echo $stop ?></h1>
    <!-- displays image of route -->
    <img id = "img" src="images/mapOfMontana.png" style="width:50%; margin-left: auto;
    margin-right: auto; display: block;">
    <!-- displays which city is the red and burgundy dot-->
    <p id = "redDot"></p>
    <p id = "burgundyDot"></p>
    <div class="info">
    <br>
        
        <?php
        //changes photo to the correct one
        changePhoto($start,$stop);
        //puts a list of cities that are in between start and stop into citiesInBetween
        //puts a list of points of interest that are in between start and stop into POIInBetween
        $citiesInBetween = returnCities($start,$stop);
        $POIInBetween = returnPOI($start,$stop);
        echo "<h2 style='text-align:center'>Click a location of your choosing to view the location's forecast for the next three days. 
        <br>In order to make the location's forecast disappear, click the location's button again.</h2>";
        echo "<br>";
        echo "<br>";
        echo "<h3>Here are the two cities you selected:</h3>";
        //displays start and stop cities weather information 
        cityFormat($start);
        echo "  ";
        cityFormat($stop);
        //if there is a city between the two selected cities, it wiil display its weather information 
        if($citiesInBetween!=NULL)
        {
            sort($citiesInBetween);
            
            echo "<br>";
            echo "<br>";
            if(count($citiesInBetween)==1)
            {
                echo "<h3>Here is the city that sits between the two locations:</h3>";
            }     
            else
            {
                echo "<h3>Here are the cities that sit between the two locations:</h3>";
            }
            foreach($citiesInBetween as $city)
            {
                cityFormat($city);
            }
           
        }
        //if there is a point of interest between the two selected cities, it wiil display its weather information
        if(!empty($POIInBetween))
        {
            sort($POIInBetween);
            
            echo "<br>";
            echo "<br>";
            if(count($POIInBetween)==1)
            {
                echo "<h3>Here is the point of interest that sits between the two locations:</h3>";
            }     
            else
            {
                echo "<h3>Here are the points of interests that sit between the two locations:</h3>";
            }
            foreach($POIInBetween as $points)
            {
                cityFormat($points);
            }
        }
    ?>
    
    </div>
    
<div class = "endOfPage"> 
        <p> All data is taken from https://api.weather.gov/</p>
        </div>
</body>
</html>