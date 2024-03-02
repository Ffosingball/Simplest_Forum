<?php
$dblocation = "localhost";
$dbuser = "root";
$dbpasswd = "dlit";
$dbcn = mysqli_connect($dblocation, $dbuser, $dbpasswd);

$q="CREATE DATABASE IF NOT EXISTS Forum";

$y1=mysqli_query($dbcn, $q);

/*if($y1)
{
    echo"Датабаза Forum успішно створена!";
}
else
{
    echo"Помилка при створенні датабази!";
}*/
?>