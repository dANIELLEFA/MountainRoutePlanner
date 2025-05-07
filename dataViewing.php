<?php
// allows page to use the functions
require_once('functions.php');
//starts session
session_start();
$user= $_SESSION["user"];
// if the session does not have a user, it makes them go home
if(!isset($user))
{
    header("Location: index.php");
}
$Globals['cities']=NULL;
//gives city a list of city then puts the list of city names into
// $Globals['cities']
$city = arrayOfCities();
for($i =0;$i < count($city); $i++)
{
    $Globals['cities'][$i]=$city[$i][0];
}
//styles page
style();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <style>
            th, td {
            border: 3px #926049 solid;
            }
            table{
                text-align:center;
                
            }
           
            button
            {
                background-color:#995339;
                color: white;
            }
            .selectCities
            {
                text-align:center;
            }
            #pieChart
            {       
                height: 200px;
                width: 200px;
                border-radius: 50%;
            }
            .endOfPage 
            {
                background-color: #2d2c2f;
                overflow: hidden;
                height:50px
            }
            
        </style>
    </head>
    <body>
        <!-- displays navigation bar -->
        <div class="navigationBar">
        <a href ="logOut.php">Log Out</a>
        </div>
        <h1>Welcome Admin Page!</h1>
        <!-- creates pie chart -->
        <div id="pieChart">
            <?php
            //adds up how many visits there have been total 
            $total =0;
            for($i=0;$i<count($Globals['cities']);$i++)
            {
                $total+=selectVisitCount($Globals['cities'][$i]);
               
            }
            // if there has been at least one cty visited it will display the pie chart
            if ($total >0)
            {
                $percents = array(array("Name" => "NA","per" => 0.00));
                $percents2=array(0);
                //gets an array of the cities and how many times it has been visited to a percentage
                for($i=0;$i<count($Globals['cities']);$i++)
                {
                    $percent = selectVisitCount($Globals['cities'][$i])/$total;
                    $percent *= 100;
                    $percent= round($percent,2);
                    $j =$i+1;
                    $percents[$j] = array("Name" => $Globals['cities'][$i],"per" => $percent);
                    
                }
                //sorts the array by percentage
                array_multisort( array_column($percents, "per"), SORT_ASC, $percents );
                for($i=1;$i<count($percents);$i++)
                {
                $j=$i-1;
                $percents2[$i]= $percents[$i]['per']+$percents2[$j];
                }
                $percents2[count($percents2) -1] -= .01;
                //diplays pie chart
                echo"
                <style>
                #pieChart {
                    background: conic-gradient( black 0.00% ".$percents2[1]."%, blue ".$percents2[1]."% "
                    .$percents2[2]."%, green ".$percents2[2]."% ".$percents2[3]."%, 
                    yellow ".$percents2[3]."% ".$percents2[4]."%, grey ".$percents2[4]."% ".$percents2[5]."%, 
                    orange ".$percents2[5]."% ".$percents2[6]."%,
                        purple ".$percents2[6]."% ".$percents2[7]."%, pink ".$percents2[7]."% ".$percents2[8]."%, 
                        brown ".$percents2[8]."% ".$percents2[9]."%,red ".$percents2[9]."%);
                }
                </style>

                ";
                
            
            ?>
        </div>
        <h2> The list of cities visited, from the least to most frequent, as shown on the graph.</h2>
        <?php
        //lists out the cities shown in the piechart
                for($i=1;$i<count($percents);$i++)
                {
                    if($percents[$i]['per'] > 0)
                    {
                        echo "<p>".$percents[$i]['Name']."</p>";
                    }
                }
            }
        ?>
        <!-- display logs if the button is clicked -->
        <button onclick='changeView("logs")'>Click to view the data logs</button>
               
              
        <div id ='logs' style='display:none'>
            <!-- table of logs -->
            <table id='logsTable'><tr>
                <th>ID</th> 
                <th>Day Accessed</th>
                <th>Time Accessed (Mountain Time)</th>
                <th>Destination</th> 
                <th>Orgin</th>
            </tr>
            <?php
            //gets all logs from logs table into an array
            $logs=getLogs();
            for($i=0; $i <count($logs);$i++)
            {
                // if the origin or destination is empty, don't display
                if($logs[$i][3] ===""||$logs[$i][4]==="")
                {

                }
                else
                {
                    echo "<tr><td>".$logs[$i][0]."</td> 
                    <td>".$logs[$i][1]."</td>
                    <td>".$logs[$i][2]."</td>
                    <td>".$logs[$i][3]."</td> 
                    <td>".$logs[$i][4]."</td></tr>";
                }
            }
            ?>
            </table>
        </div>
        <div class = "endOfPage"> 
            <p></p>
        </div>
    </body>
</html>