
<?php
//estabishes a connection with the database CSCI470 using Final
function connection()
{
  $servername="localhost";
  $username="Final";
  $password="Project";
  $dbname= "CSCI470";
  $conn = new mysqli($servername, $username, $password, $dbname);
  
  if ($conn->connect_error) 
  {
    die("Connection failed: " . $conn->connect_error);
  }
  return $conn;

}
//queries the mysql table and closes the connection
function queryMysql($query)
{
  $conn = connection(); 
  $result = $conn->query($query);
  if (!$result) die("Fatal Error");
  $conn -> close();
  return $result;

}
//sends insert query to queryMysql
function Insert($name, $values, $query)
{
  
  queryMysql("INSERT IGNORE INTO $name $values VALUES ($query)");
}
//sends update query to queryMysql
function update($tableName, $values, $query)
{
  queryMysql("UPDATE $tableName SET $values WHERE $query");
  
}
//inserts new password and hashes it
function InsertPassword()
{
  $pass =  password_hash("pass", PASSWORD_DEFAULT);
  queryMysql("UPDATE user SET passwrd = '$pass' WHERE username = 'user'");
}
//selects the visit count from the specified city
function selectVisitCount($query)
{
  $result = queryMysql("SELECT visitcount FROM cities WHERE name = '$query'");
  $row = mysqli_fetch_array($result);
  return $row[0];
}
//returns a list of cities between start and stop
function returnCities($start,$stop)
{
  
  $cities = NULL;
  if(($start == "Miles City"&& ($stop == "Missoula" || $stop == "Helena"|| $stop == "Dillon"))||
  (($start == "Missoula" || $start == "Helena"|| $start == "Dillon") && $stop =="Miles City"))
  {
    $cities = array("Billings","Bozeman","Livingston","Butte");
  }
  else if(($start == "Miles City"&& $stop == "Butte")||($stop == "Miles City"&& $start == "Butte"))
  {
    $cities = array("Billings","Bozeman","Livingston");
  }
  else if(($start == "Miles City"&& $stop == "Hardin")||($stop == "Miles City"&& $start == "Hardin"))
  {
    $cities = array("Billings");
  }
  else if(($start == "Miles City"&& $stop == "Great Falls")||($stop == "Miles City"&& $start == "Great Falls"))
  {
    $cities = array("Billings","Bozeman","Livingston","Butte", "Helena");
  }
  else if(($start == "Miles City"&& $stop == "Livingston")||($stop == "Miles City"&& $start == "Livingston"))
  {
    $cities = array("Billings","Bozeman");
  }
  else if(($start == "Miles City"&& $stop == "Bozeman")||($stop == "Miles City"&& $start == "Bozeman"))
  {
    $cities = array("Billings");
  }
  else if(($start == "Billings"&& ($stop == "Missoula" || $stop == "Helena"|| $stop == "Dillon"))||
  (($start == "Missoula" || $start == "Helena"|| $start == "Dillon") && $stop =="Billings"))
  {
    $cities = array("Bozeman","Livingston","Butte");
  }
  else if(($start == "Billings"&& $stop == "Butte") || ($stop == "Billings"&& $start == "Butte"))
  {
    $cities = array("Bozeman","Livingston");
  }
  else if(($start == "Billings"&& $stop == "Great Falls")||($stop == "Billings"&& $start == "Great Falls"))
  {
    $cities = array("Bozeman","Livingston","Butte", "Helena");
  }
  else if(($start == "Billings"&& $stop == "Livingston")||($stop == "Billings"&& $start == "Livingston"))
  {
    $cities = array("Bozeman");
  }
  else if(($start == "Bozeman"&& ($stop == "Missoula" || $stop == "Helena"|| $stop == "Dillon"))||
  ($start == "Bozeman"&&($start == "Missoula" || $start == "Helena"|| $start == "Dillon")))
  {
    $cities = array("Livingston","Butte");
  }
  else if(($start == "Bozeman"&& $stop == "Butte")||($stop == "Bozeman"&& $start == "Butte"))
  {
    $cities = array("Livingston");
  }
  else if(($start == "Bozeman"&& $stop == "Great Falls")||($stop == "Bozeman"&& $start == "Great Falls"))
  {
    $cities = array("Livingston","Butte", "Helena");
  }
  else if(($start == "Bozeman"&& $stop == "Hardin")||($stop == "Bozeman"&& $start == "Hardin"))
  {
    $cities = array("Billings");
  }
  else if(($start == "Livingston"&& ($stop == "Missoula" || $stop == "Helena"|| $stop == "Dillon"))||
  ($stop == "Livingston"&&($start == "Missoula" || $start == "Helena"|| $start == "Dillon")))
  {
    $cities = array("Butte");
  }
  else if(($start == "Livingston"&& $stop == "Great Falls")||($stop == "Livingston"&& $start == "Great Falls"))
  {
    $cities = array("Butte", "Helena");
  }
  else if(($start == "Livingston"&& $stop == "Hardin")||($stop == "Livingston"&& $start == "Hardin"))
  {
    $cities = array("Bozeman","Billings");
  }
  else if(($start == "Butte"&& $stop == "Great Falls")||($stop == "Butte"&& $start == "Great Falls"))
  {
    $cities = array("Helena");
  }
  else if(($start == "Butte"&& $stop == "Hardin")||($stop == "Butte"&& $start == "Hardin"))
  {
    $cities = array("Livingston","Bozeman","Billings");
  }
  else if((($start == "Missoula" || $start == "Helena"|| $start == "Dillon")&& $stop == "Hardin")||
  (($stop == "Missoula" || $stop == "Helena"|| $stop == "Dillon")&& $start == "Hardin"))
  {
    $cities = array("Butte","Livingston","Bozeman","Billings");
  }
  else if(($start == "Hardin"&& $stop == "Great Falls")||($start == "Great Falls"&& $stop == "Hardin"))
  {
    $cities = array("Butte","Helena","Livingston","Bozeman","Billings");
  }
  else if(($start == "Hardin"&& $stop == "Missoula")||($start == "Missoula"&& $stop == "Hardin"))
  {
    $cities = array("Butte","Livingston","Bozeman","Billings");
  }
  else if(($start == "Missoula"&& ($stop == "Helena"||$stop == "Dillon"))||
  (($start == "Helena"||$start == "Dillon")&& $stop == "Missoula"))
  {
    $cities = array("Butte");
  }
  else if(($start == "Great Falls"&& $stop == "Missoula")||($start == "Missoula"&& $stop == "Great Falls"))
  {
    $cities = array("Butte","Helena");
  }
  return $cities;

}
//returns a list of points of interest between start and stop
function returnPOI($start,$stop)
{
  $cities = returnCities($start,$stop);
  $pointsOfInterest=array();
  if($start=="Miles City"||$stop=="Miles City")
  {
    array_push($pointsOfInterest, "Bighorn River Bridge");
  }
  if($start=="Great Falls"||$stop=="Great Falls")
  {
    array_push($pointsOfInterest, "Bear Gulch","Missouri River Bridge");
  }
  if($start=="Billings" && $stop=="Livingston"||$stop=="Billings" && $start=="Livingston")
  {
    array_push($pointsOfInterest, "Yellowstone River Bridge");
  }
  if($start=="Bozeman" && $stop=="Butte"||$stop=="Bozeman" && $start=="Butte")
  {
    array_push($pointsOfInterest, "Homestake Pass");
  }
  if($cities!=NULL)
  {
  if((in_array("Billings",$cities)== true && in_array("Livingston",$cities)== true) || 
  (($start=="Billings" ||$stop=="Billings")&& in_array("Livingston",$cities)== true)||(($start=="Livingston" ||
  $stop=="Livingston")&& in_array("Billings",$cities)== true))
  {
    array_push($pointsOfInterest, "Yellowstone River Bridge");
  }
  if((in_array("Bozeman",$cities)== true && in_array("Butte",$cities)== true) || 
  (($start=="Bozeman" ||$stop=="Bozeman")&& in_array("Butte",$cities)== true)||(($start=="Butte" ||
  $stop=="Butte")&& in_array("Bozeman",$cities)== true))
  {
    array_push($pointsOfInterest, "Homestake Pass");
  }
  }
  return $pointsOfInterest;
}
//returns list of cities with their name,section,p1,p2
function arrayOfCities()
{
  $result = queryMysql("SELECT name,section,p1,p2 FROM cities");
  $cities = array();
  $i=0;
  while($row = $result->fetch_assoc())
  {
    $cities[$i]=array($row['name'],$row['section'],$row['p1'],$row['p2']);
    $i++;
  }
  return $cities;
}
//returns list of points of interest with their name,section,p1,p2
function arrayOfPOI()
{
  $result = queryMysql("SELECT name,section,p1,p2 FROM pointsOfInterest");
  $POI = array();
  $i=0;
  while($row = $result->fetch_assoc())
  {
    $POI[$i]=array($row['name'],$row['section'],$row['p1'],$row['p2']);
    $i++;
  }

  return $POI;
}
//returns all values from log table
function getLogs()
{
  $result = queryMysql("SELECT * FROM logs");
  $logs = array();
  $i=0;
  while($row = $result->fetch_assoc())
  {
    $logs[$i]=array($row['id'],$row['day'],$row['time'],$row['destination'],$row['origin']);
    $i++;
  }

  return $logs;
}
//finds city and points of interest section, p1 and p2 if it is not null
function findCityInfo($name)
{
  $a = NULL;
  $cities = arrayOfCities();
  $points = arrayOfPOI();
  for($i =0;$i<count($cities);$i++)
  {
    if($cities[$i][0]=== $name)
    {
    $a = array($cities[$i][1],$cities[$i][2],$cities[$i][3]);
    return $a;
    }
  }
  for($i =0;$i<count($points);$i++)
  {
    if($points[$i][0]=== $name)
    {
    $a = array($points[$i][1],$points[$i][2],$points[$i][3]);
    return $a;
    }
  }
  if($a ==NULL)
  {
    return "Does Not Exist";
  }
}
//Puts weather into the different tables
//input: String city and int period
function weather($city,$period)
{
  
  //array that contains city's section, point 1, and point 2
  $info = findCityInfo($city);
  if ($info === "Does Not Exist")
  {
    echo "<script> console.log('DNE');</script>";
  }
  else
  {
    $city = preg_replace('/\s+/', '', $city);
    ?>
    
    <script>
      var citi = <?php echo $city ?>;
      var xmlhttp = new XMLHttpRequest();
      //opens a portal into the api
      xmlhttp.open('GET',"https://api.weather.gov/gridpoints/<?php echo "$info[0]"?>/<?php echo "$info[1]"?>,<?php echo "$info[2]"?>/forecast" );
      xmlhttp.send();
      xmlhttp.onload = function() 
      {
        // parsing
        const myObj = JSON.parse(this.responseText);
        //selects time period based on number
        var x =myObj.properties.periods[<?php echo $period?>];
        //prints name, detail, icon
        document.getElementById('<?php echo "$city.name.$period"?>').innerHTML = x.name;
        document.getElementById('<?php echo "$city.detail.$period"?>').innerHTML = x.detailedForecast;
        document.getElementById('<?php echo "$city.image.$period"?>').src = x.icon;
      };
    </script>
    <?php
  }
}
//styles background and navigation bar
function style()
{
  ?>
  <style>
     .navigationBar 
            {
                background-color: #2d2c2f;
                overflow: hidden;
                width: 100%;
            }
            .navigationBar a 
            {
                float: left;
                color: #dfdedc;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
                font-size: 17px;
            }
            body
            {
                background-color:#315338;
                color: white;
            }
            
  </style>
  <?php
}
//changes photo on mainPage.php to the correct one
function changePhoto($s1,$s2){
  $city1 = $s1;
  $city2 = $s2;
  $s1=$s1[0].$s1[1].$s1[2];
  $s2=$s2[0].$s2[1].$s2[2];
  
  $_Global['url'] ="images/".$s1."To".$s2.".png";
  //checks if file exists then changes it on mainPage.php. Sets red and burgundy dot values
  if (file_exists($_Global['url']) ){
      ?>
      <script>
        
      document.getElementById("img").src ="<?php echo $_Global['url'] ?>";
      document.getElementById('redDot').innerHTML = "<?php echo $city1 ?> is the red dot.";
      document.getElementById("burgundyDot").innerHTML = "<?php echo $city2 ?> is the burgundy dot.";
      </script>
      <?php
  } else 
  {
    //changes it on mainPage.php. Sets red and burgundy dot values
    $_Global['url'] ="images/".$s2."To".$s1.".png";
    ?>
    <script>
      
      document.getElementById("img").src ="<?php echo $_Global['url'] ?>";
      document.getElementById('redDot').innerHTML = "<?php echo $city2 ?> is the red dot.";
      document.getElementById("burgundyDot").innerHTML = "<?php echo $city1 ?> is the burgundy dot.";
    </script>
    <?php
  }
}
//sets each city and point of interest to specific format. removes spaces for ids
function cityFormat($city)
{
  $cityWSpace = preg_replace('/\s+/', '', $city);

  echo "<button onclick=\"changeView('$cityWSpace')\">$city</button>";
  echo "<table id='$cityWSpace' style='display:none'><tr ><th>Day</th>
  <th>Details about The Forecast</th>
  <th>Forecast Photo</th>
  </tr>";
    
  for($i =1; $i<7;$i++)
  {
    weather($city,$i);
    echo "<tr ><td id ='$cityWSpace.name.$i'>Error</td>
    <td id ='$cityWSpace.detail.$i' style = 'text-wrap: balance;'>Unable To Load</td>
    <td ><img id ='$cityWSpace.image.$i' src='https://api.weather.gov/icons/land/day/snow,20/bkn?size=small '></td>
    </tr>";
  }
  echo "</table>";
                 
}
//imports jquery
?>
<script 
src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
</script>
<script>
//fades in or out element depending on whether the element is already showing
function changeView(element)
{
  var id = document.getElementById(element);
  if(id.style.display === 'none')
  {
    $(id).fadeIn("slow");
  }
  else
  {
    $(id).fadeOut("slow"); 
  }
}
</script>