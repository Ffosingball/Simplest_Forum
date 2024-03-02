<?php
ini_set('session.save_path','.\session');
session_start();
?>

<html>
    <head>
        <title>Список форумів</title>
        <link rel='stylesheet' type='text/css' href='style.css'>
        <link rel='shortcut icon' href='i.png'>
    </head>
    <body>
<?php
 
 if(isset($_SESSION['name']))
 {
    echo"
    <div class='registr_all'>
            <div class='forum-listing'>
            <center><h2>Список форумів</h2></center>";

    if($_SESSION['name']=='Administrator')
    {
        echo"<center><a class='another-page' href=./delForum.php>Видалити форум</a></center>";
    }
    

    include "1.php";

    mysqli_select_db($dbcn, "Forum");

    $q2="SELECT * FROM forumsList";
    $y2=mysqli_query($dbcn,$q2);
    echo "<center><a class='another-page' href=./addNewForum.php>Додати форум</a></center>";

    echo "<table><tr>
            <th width='15%'><p class='forms-text'>Назва</p></th>
            <th width='45%'><p class='forms-text'>Опис</p></th>
            <th width='15%'><p class='forms-text'>Творець</p></th>
            <th width='15%'><p class='forms-text'>Дата створення</p></th>
            <th width='10%'><p class='forms-text'>Змінити</p></th></tr>";

    while($p=mysqli_fetch_assoc($y2))
    {
        echo"<tr>
        <td>
            <form method='POST' action='chat.php'>
                <input type='hidden' name='id_chat' value='".$p['id']."'>
                <input type='hidden' name='name_chat' value='".$p['name']."'>
                <input class='chose-forum' type='submit' value='".$p['name']."'>
            </form>
        </td>
        <td><p class='desc-text'>".$p['descript']."</p></td>
        <td><p class='error'>".$p['creator']."</p></td>
        <td><p class='desc-text'>".$p['dateOfCreation']."</p></td>";

        if($p['creator']==$_SESSION['name'])
        {
            echo"<td>
                <form action='changeForum.php' method='GET'>
                    <input type='hidden' name='id' value='".$p['id']."'>
                    <input class='input-button' type='submit' value='Змінити'>
                </form>
            </td>";
        }
        else
        {
            echo"<td></td>";
        }

        echo"</tr>";
    }

    echo "</table></div></div>";

    echo"
    <div class='menu2'>
        <p class='name'>".$_SESSION['name']."</p>
    </div>";

    if($_SESSION['name']=='Administrator')
    {
        echo"<div class='menu'>
            <ul class='css-menu'>
                <li><a href=./main.php>Головна</a></li>
                <li><a href=./forumsList.php>Форуми</a></li>
                <li><a href=./info.php>Особиста інформація</a></li>
                <li><a href=./delAccaunts.php>Акаунти</a></li>
                <li><a href=./exit.php>Вийти з акаунта</a></li>
            </ul>
    </div>";
    }
    else
    {
    echo"<div class='menu'>
        <ul class='css-menu'>
            <li><a href=./main.php>Головна</a></li>
            <li><a href=./forumsList.php>Форуми</a></li>
            <li><a href=./info.php>Особиста інформація</a></li>
            <li><a href=./exit.php>Вийти з акаунта</a></li>
        </ul>
    </div>";
    }
 }
 else
 {
    echo" 
        <div class='registr_all'>
            <div class='registr'>
                <p class='forms-text'>Щоб спілкуватися на форумах з іншими користувачами авторизуйтеся або зареєструйтеся!</p>
            </div>
        </div>
        <div class='menu2'>
            <p class='buton'></p>
        </div>
        <div class='menu'>
			<p class='buton'>
				<ul class='css-menu'>
				    <li><a href=./main.php>Головна</a></li>
				    <li><a href=./login.php>Авторизуватися</a></li>
				    <li><a href=./registration.php>Зареєструватися</a></li>
                </ul>
            </p>
		</div>";
 }
?>
    <div class='end'>
        <br><p class='forms-text'>Сайт створив Бита Андрій Андрійович для випускної роботи у 2023 році!</p>
        <img src='logo.png' width='100px' height='100px'>
    </div>
    </body>
</html>