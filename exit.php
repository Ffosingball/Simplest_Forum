<?php
ini_set('session.save_path','.\session');
session_start();

if(isset($_SESSION['name']))
{
    $_SESSION['name']=null;
    $_SESSION['pass']=null;
}

header("Location: ./main.php");
?>