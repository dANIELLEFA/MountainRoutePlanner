<?php
// allows page to use the functions
require_once('functions.php');
//inserts new password for admin
InsertPassword();

$Globals['cities']=NULL;
//gives city a list of city then puts the list of city names into
// $Globals['cities']
$city = arrayOfCities();
for($i =0;$i < count($city); $i++)
{
    $Globals['cities'][$i]=$city[$i][0];
}
//checks there is an item in the url 
 if(count($_GET)==0 || count($_GET) > 2)
 {
    
 }
 else
 {
    $redo = $_GET['r'];
    //if there is a y in the r variable, alerts user that they must choose two locations
    if($redo==='y'&&isset($_GET['r']))
    {
     echo "<script>alert('Please pick two seperate locations');</script>";
    }
    else{

        header('Location: index.php');
    }
 }
 //styles page
 style();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <style>
            
            .selectCities
            {
                text-align:center;
            }
            input, select
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
        
        <div class ="selectCities">
        <h1>Welcome to Danielle's Montana Project!</h1>
        <h2>Please select a starting city and stopping city</h2>
        <!-- displays two drop down lists that contains the city's name -->
        <form method = "POST" action="mainPage.php">
        <label>Starting Point:</label>
        <select name ="StartPoint">
        <?php
        for($i =0; $i<count($Globals['cities']); $i++)
            {
                echo"<option value='".$Globals['cities'][$i]."'>".$Globals['cities'][$i]."</option>";
            }
            ?>  
        </select>
        
        <label>Stopping Point:</label>
        <select name ="StopPoint">
            <?php
            for($i =0; $i<count($Globals['cities']); $i++)
            {
                echo"<option value='".$Globals['cities'][$i]."'>".$Globals['cities'][$i]."</option>";
            }
            ?>
        </select>
        
        <br><br>
        
        <input type="submit" value="Submit">
        </form>
        </div>
        
    </body>
</html>