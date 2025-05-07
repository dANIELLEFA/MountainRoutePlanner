<?php
// allows page to use the functions
require_once('functions.php');
style();
//styles page
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <style>
            body
            {
                text-align:center;
            }
            #logIn
            {
                text-align:center;
            }
            input
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
        </div>
        <div id= "logIn">
            <h1>Log In</h1>
            <br>
            <!-- Displays place for username and password. Sends information to loginvalid -->
            <form form id = "validateLogin" method = "POST" action = "loginvalid.php">
                Username: <br><input type="text" name="user" autofocus/><br />
                <br>
                Password:<br><input type="password" name="password" /><br />
                <br><br>
                <input type="submit" value="Login" />
            </form>
        </div>
    </body>
</html>
