<?php
ini_set('session.save_path','.\session');
session_start();
?>
<html>
    <head>
        <title>Авторизація</title>
        <link rel='stylesheet' type='text/css' href='style.css'>
        <link rel='shortcut icon' href='i.png'>
    </head>
    <body>
        <div class='registr_all'>
            <div class='registr'>
                <center><h2>Авторизація</h2></center>
                <form method='post'>
                    <table>
                        <tr>
                            <td><p class='forms-text'>Нікнейм:</p>
                            <input class='inputs' type='text' name='name'></td>
                        </tr>
                        <tr>
                            <td><p class='forms-text'>Пароль:</p>
                            <input class='inputs' type='password' name='pass'></td>
                        </tr>
                        <tr>
                            <td><input class='input-button' type='submit' value='Отправить'><td>
                        </tr>
                    </table>
                </form>
                <p class='error'>

<?php

function clean($value = "") 
{
    $value = trim($value);
    $value = stripslashes($value);
    $value = strip_tags($value);
    $value = htmlspecialchars($value);
    
    return $value;
}


$name=$_POST['name'];
$pass=$_POST['pass'];

$name=clean($name);
$pass=clean($pass);

if(!empty($name) && !empty($pass))
{
    include "1.php";
    mysqli_select_db($dbcn, "Forum");

    $q="SELECT COUNT(*) FROM accaunts WHERE nickname='$name' AND password='$pass'";
    $usr=mysqli_query($dbcn,$q);

    if($usr==false)
    {
        echo"Помилка під час авторизації!";
    }

    $total=mysqli_fetch_array($usr);
    if($total[0]>0)
    {
        $_SESSION['name']=$name;
        $_SESSION['pass']=$pass;
    }
    else
    {
        echo"Пароль або логін не вірний!";
    }
}
else
{
    echo"Один з полів пустий!";
}


if(isset($_SESSION['name']))
{
    header("Location: ./forumsList.php");
}
?>
                </p>
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
		</div>
        <div class='end'>
        <br><p class='forms-text'>Сайт створив Бита Андрій Андрійович для випускної роботи у 2023 році!</p>
        <img src='logo.png' width='100px' height='100px'>
    </div>
    </body>
</html>