<?php
// allows page to use the functions
require_once('functions.php');
session_start();
session_destroy();
//styles page
style();
?>
<!DOCTYPE html>
<html>
    <style>
        
       body
       {
        text-align:center;
       }
            button
            {
                background-color:#995339;
                color: white;
            }
        
    </style>
    <body>
        <h2>You are Logged Out!</h2>
        <button onclick="location.href = 'index.php';"> Click to go to the Home Page!</button>
    </body>
</html>