<?php
ini_set('session.save_path','.\session');
session_start();

echo"
<html>
    <head>
        <title>Інформація про іншу особу</title>
        <link rel='stylesheet' type='text/css' href='style.css'>
        <link rel='shortcut icon' href='i.png'>
    </head>
    <body>
        <div class='registr_all'>
            <div class='registr'>";

if(isset($_SESSION['name']))
{
    include "1.php";
    mysqli_select_db($dbcn, "Forum");

    $name=$_GET['name'];

    $q1="SELECT * FROM accaunts WHERE nickname='$name'";
    $y1=mysqli_query($dbcn,$q1);
    echo "<h2>".$name."</h2><table>";

    $p=mysqli_fetch_array($y1);
    echo"<tr>
            <td>
                <p class='desc-text'>E-mail:    </p>
            </td>
            <td>
                <p class='forms-text'>".$p['email']."<br></p>
            </td>
        </tr>
        <tr>
            <td>
                <p class='desc-text'>Description:  </p>
            </td>
            <td>
                <p class='forms-text'>".$p['descript']."<br></p>
            </td>
        </tr>";

    echo"
                </table>
            </div>
        </div>
        <div class='menu2'>
            <p class='name'>".$_SESSION['name']."</p>
        </div>
        <div class='menu'>
            <p class='buton'>
                <ul class='css-menu'>
                    <li><a href=./main.php>Головна</a></li>
                    <li><a href=./forumsList.php>Форуми</a></li>
                    <li><a href=./info.php>Особиста інформація</a></li>
                    <li><a href=./exit.php>Вийти з акаунта</a></li>
                </ul>
            </p>
        </div>";
}
else
{
    echo" 
                <p class='forms-text'>Ви не можете переглядати інформацію про інших користувачів, бо ви не авторизовані!</p>
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

echo"
    <div class='end'>
        <br><p class='forms-text'>Сайт створив Бита Андрій Андрійович для випускної роботи у 2023 році!</p>
        <img src='logo.png' width='100px' height='100px'>
    </div>
    </body>
</html>";

?>