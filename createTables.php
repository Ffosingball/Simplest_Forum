<?php
include "1.php";
mysqli_select_db($dbcn, "Forum");
$q1="CREATE TABLE accaunts (id VARCHAR(8) NOT NULL UNIQUE PRIMARY KEY, nickname VARCHAR(15) NOT NULL, email VARCHAR(60) NOT NULL, password VARCHAR(8) NOT NULL, descript VARCHAR(100)) ENGINE=InnoDB DEFAULT CHARSET=cp1251";
$q2="CREATE TABLE forumsList (id VARCHAR(5) NOT NULL UNIQUE PRIMARY KEY, name VARCHAR(60) NOT NULL, creator VARCHAR(20) NOT NULL, descript VARCHAR(400), dateOfCreation DATETIME NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=cp1251";

$y1=mysqli_query($dbcn, $q1);
if($y1)
{
    echo"Таблиця accaunts успішно створена!";
}
else
{
    echo"Помилка при створенні таблиці accaunts!";
}

$y1=mysqli_query($dbcn, $q2);
if($y1)
{
    echo"Таблиця forumsList успішно створена!";
}
else
{
    echo"Помилка при створенні таблиці forumsList!";
}
?>