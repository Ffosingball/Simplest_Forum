<?php
ini_set('session.save_path','.\session');
session_start();
?>

<html>
    <head>
        <title>Список акаунтів</title>
        <link rel='stylesheet' type='text/css' href='style.css'>
        <link rel='shortcut icon' href='i.png'>
    </head>
    <body>
<?php
 
 if(isset($_SESSION['name']) && $_SESSION['name']=='Administrator')
 {
    echo"
    <div class='registr_all'>
            <div class='forum-listing'>
            <center><h2>Список акаунтів</h2></center>";
    

    include "1.php";

    mysqli_select_db($dbcn, "Forum");

    $q2="SELECT * FROM accaunts";
    $y2=mysqli_query($dbcn,$q2);

    echo "<table><tr>
            <th width='15%'><p class='forms-text'>ID</p></th>
            <th width='15%'><p class='forms-text'>Нікнейм</p></th>
            <th width='20%'><p class='forms-text'>E-mail</p></th>
            <th width='40%'><p class='forms-text'>Опис</p></th>
            <th width='10%'><p class='forms-text'>Видалити</p></th></tr>";

    while($p=mysqli_fetch_assoc($y2))
    {
        if($p['nickname']!='Administrator')
        {
            echo"<tr>
            <td><p class='desc-text'>".$p['id']."</p></td>
            <td><p class='error'>".$p['nickname']."</p></td>
            <td><p class='desc-text'>".$p['email']."</p></td>
            <td><p class='desc-text'>".$p['descript']."</p></td>
            <td>
                <form method='POST' action='deleteAccaunts.php'>
                    <input type='hidden' name='id' value='".$p['id']."'>
                    <input class='input-button' type='submit' value='Видалити'>
                </form>
            </td>
            </tr>";
        }
    }

    echo "</table></div></div>";

    echo"
 <div class='menu2'>
    <p class='name'>".$_SESSION['name']."</p>
 </div>
 <div class='menu'>
    <p class='buton'>
        <ul class='css-menu'>
            <li><a href=./main.php>Головна</a></li>
            <li><a href=./forumsList.php>Форуми</a></li>
            <li><a href=./info.php>Особиста інформація</a></li>
            <li><a href=./delAccaunts.php>Акаунти</a></li>
            <li><a href=./exit.php>Вийти з акаунта</a></li>
        </ul>
    </p>
</div>";
 }
 else
 {
    header("Location: ./main.php");
 }
?>
    <div class='end'>
        <br><p class='forms-text'>Сайт створив Бита Андрій Андрійович для випускної роботи у 2023 році!</p>
        <img src='logo.png' width='100px' height='100px'>
    </div>
    </body>
</html>