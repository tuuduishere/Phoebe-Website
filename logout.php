<?php
session_start();
file_put_contents('temp_uid.txt', ""); 
session_unset();
session_destroy();
header("Location: login.php");
exit();
?>