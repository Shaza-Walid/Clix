<?php
session_start();   //continue the session to access user data
session_unset();   //destroys all session variables
session_destroy(); //destroys the session completely

header("Location: login.html"); // Redirect the user to the login page
exit();

/*
    how the code works:
    1. The script starts the session to access user data.
    2. It unsets all session variables, effectively logging the user out.
    3. It destroys the session completely.
    4. Finally, it redirects the user to the login page.
*/
