<?php

/*@desc user logout
  @version 7.0
  @author priyanka
*/
session_start();
if(session_destroy()) // Destroying All Sessions
{
    header("Location:userLogin.php"); // Redirecting To Home Page
}
?>