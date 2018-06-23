<?php

/*@desc admin logout
  @version 7.0
  @author ramesh
*/
session_start();
if(session_destroy()) // Destroying All Sessions
{
header("Location:adminLogin.php"); // Redirecting To Home Page
}
?>