<?php
// allows page to use the functions
require_once('functions.php');
// defines all main variables
$tableName ="user";
$user = htmlspecialchars($_POST["user"]);
$user = strip_tags($user);
$user = stripslashes($user);
$passwd = htmlspecialchars($_POST["password"]);
$passwd = strip_tags($passwd);
$passwd = stripslashes($passwd);
$allowed = true;
// checks to see if the username and passwords are correct length and string
if(is_string($user)&& strlen($user) < 6)
{
        
}
if(is_string($passwd)&& strlen($passwd) < 6)
{
       
}
else
{
    $allowed = false;
    //sends you back to home
    header("Location: index.php");
}
if ($allowed == true)
{

    $query = "SELECT passwrd FROM ".$tableName." WHERE username = '$user' ";

    $result = querymysql($query);
    // checks if there are users with the entered username
    if ($result) 
    {
   
        if (mysqli_num_rows($result) > 0) 
        {
            // checks to see if the password is correct
            $row = mysqli_fetch_array($result);
            if(password_verify($passwd,$row[0] ))
            {
                //sets session and session username
                session_start();
                $_SESSION["user"] = $user;
                header("Location:dataViewing.php");
            }
            else 
            {
                //sends you back to home
                header("Location: index.php");
            }
        } 
        else 
        {
            //sends you back to home
            header("Location: index.php");
        }
    } 
    else 
    {
        //sends you back to home
        header("Location: index.php");
    }

}
else
{
    //sends you back to home
    header("Location: index.php");
}
?>