<?php
if(session_destroy()) // Destroying All Sessions
{
Utils::redirect('login');
}
?>

