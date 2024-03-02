<?php
ini_set('session.save_path','.\session');
session_start();

if(isset($_SESSION['name']) && $_SESSION['name']=='Administrator')
{
    include "1.php";
    mysqli_select_db($dbcn, "Forum");
    $q="DELETE FROM forumsList WHERE id = '{$_POST['id']}'";
    $q2="DROP TABLE {$_POST['id']}";

    if(mysqli_query($dbcn,$q) && mysqli_query($dbcn,$q2))
    {
        header("Location: ".$_SERVER["HTTP_REFERER"]);
    }
    else
    {
        echo "Помилка при видалені форума";
    }
}
else
{
    header("Location: ./main.php");
}
?>