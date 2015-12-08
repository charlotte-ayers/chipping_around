<?php
session_start();
if(session_destroy()) // Destroying All Sessions
{
header("Location: chipping_around/page/login-view.php"); // Redirecting To Home Page
}
?>

