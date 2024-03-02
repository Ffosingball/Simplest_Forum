<?php
include "1.php";
mysqli_select_db($dbcn, "Forum");
$q1="INSERT INTO accaunts VALUES ('A0000001','Administrator','admin@gmail.com','cXytti94','perevirka.jpg','Я адміністратор цього сайту!')";
$q2="INSERT INTO forumsList VALUES ('F0001','Форум Адміна','Розробник сайту','Перший форум на цьому сайті!', NOW())";
for ($i=1; $i<=2; $i++)
{
	$q=${'q'.$i};
	$y1=mysqli_query($dbcn,$q);

	if($y1)
	{
    	echo"Данні успішно введені в таблицю!";
	}
	else
	{
		echo"Помилка при введені данних у таблицю!";
	}
}
?>