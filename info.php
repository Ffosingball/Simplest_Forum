<?php
ini_set('session.save_path','.\session');
session_start();

echo"
<html>
    <head>
        <title>Особиста інформація</title>
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

    $name=$_SESSION['name'];
    $pass=$_SESSION['pass'];

    $q1="SELECT * FROM accaunts WHERE nickname='$name' AND password='$pass'";
    $y1=mysqli_query($dbcn,$q1);
    echo "<center><h2>Особисті дані</h2></center><table>";

    $p=mysqli_fetch_array($y1);
    echo"<tr>
            <td>
                <p class='desc-text'>ID  </p>
            </td>
            <td>
                <p class='forms-text'>".$p['id']."<br></p>
            </td>
        </tr>
        <tr>
            <td>
                <p class='desc-text'>Nickname  </p>
            </td>
            <td>
                <p class='forms-text'>".$p['nickname']."<br></p>
            </td>
        </tr>
        <tr>
            <td>
                <p class='desc-text'>E-mail  </p>
            </td>
            <td>
                <p class='forms-text'>".$p['email']."<br></p>
            </td>
        </tr>
        <tr>
            <td>
                <p class='desc-text'>Description  </p>
            </td>
            <td>
                <p class='forms-text'>".$p['descript']."<br></p>
            </td>
        </tr>
    </table>
    <h4><a class='another-page' href=./changeinfo.php>Змінити деталі</a></h4>";

    echo"
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
                <p class='forms-text'>Ви не можете переглядати особисту інформацію, бо ви не авторизовані!</p>
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