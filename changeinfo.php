<?php
ini_set('session.save_path','.\session');
session_start();

$id_ac="";

echo"
<html>
    <head>
        <title>Змінити особисті дані</title>
        <link rel='stylesheet' type='text/css' href='style.css'>
        <link rel='shortcut icon' href='i.png'>
    </head>
    <body>
        <div class='registr_all'>
            <div class='registr'>
                <center><h2>Зміна особистих даних</h2></center>";

if(isset($_SESSION['name']))
{
    include "1.php";
    mysqli_select_db($dbcn, "Forum");

    $name=$_SESSION['name'];
    $pass=$_SESSION['pass'];

    $q1="SELECT * FROM accaunts WHERE nickname='$name' AND password='$pass'";
    $y1=mysqli_query($dbcn,$q1);

    $p=mysqli_fetch_array($y1);

    $id_ac=$p['id'];
    
    echo"<table>
    <form method='post'>
        <tr>
            <td><p class='forms-text'>Нікнейм*:</p></td>
            <td><input class='inputs' type='text' name='name' value='".$p['nickname']."'></td>
        </tr> 
        <tr>
            <td><p class='forms-text'>Пароль*: </p></td>
            <td><input class='inputs' type='password' name='pass' value='".$p['password']."'></td>
        </tr>
        <tr>
            <td colspan='2'><p class='error'>(якщо не будете змінювати то нижче введіть старий пароль, якщо будете то зверху і знизу напишіть новий пароль)</p></td>
        </tr>
        <tr>
            <td><p class='forms-text'>Повторно введіть пароль*: </p></td>
            <td><input class='inputs' type='password' name='passagain'></td>
        </tr>
        <tr>
            <td><p class='forms-text'>Е-mail*:</p></td>
            <td><input class='inputs' type='text' name='email' value='".$p['email']."'></td>
        </tr> 
        <tr>
            <td><p class='forms-text'>Про себе:</p></td>
            <td><textarea class='inputs' type='text' name='opys' cols='30' rows='6'>".$p['descript']."</textarea></td>
        </tr> 
        <tr>
            <td></td>
            <td><input class='input-button' type='submit' value='Змінити'></td>
        </tr>
        </forms>
        </table>
        <p class='error'>";


    function clean($value = "") 
    {
        $value = trim($value);
        $value = stripslashes($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value);
        
        return $value;
    }


    function check_length($value = "", $min, $max) 
    {
        $result = (mb_strlen($value) < $min || mb_strlen($value) > $max);
        return !$result;
    }


    $name = $_POST['name'];
    $pass = $_POST['pass'];
    $passagain = $_POST['passagain'];
    $email = $_POST['email'];
    $descript = $_POST['opys'];

    $name=clean($name);
    $pass=clean($pass);
    $pasagain=clean($passagain);
    $email=clean($email);
    $descript=clean($descript);

    if(!empty($name) && !empty($pass) && !empty($pasagain) && !empty($email)) 
    {
        if(empty($descript))
        {
            $descript=" ";
        }

        if(empty($picture))
        {
            $picture=" ";
        }

        if(check_length($name, 1, 20) && check_length($descript, 0, 100) && check_length($pass, 1, 8) && check_length($passagain, 1, 8) && check_length($email, 0, 60)) 
        {
            if($pass==$passagain)
            {
                include "1.php";
                mysqli_select_db($dbcn, "Forum");
                    
                $q="UPDATE accaunts SET nickname='{$name}', email='{$email}', password='{$pass}', descript='{$descript}' WHERE id='{$id_ac}'";
                $proverka=mysqli_query($dbcn, $q);
                    
                if($proverka==false)
                {
                    echo "Помилка при зміні данних у вашому акаунті!";
                } 
                else
                {
                    $_SESSION['name']=$name;
                    $_SESSION['pass']=$pass;
                    header("Location: ./info.php");
                }
            }
            else
            {
                echo "Паролі не збігаються!";
            }
        } 
        else 
        { 
            echo "Довжина за межами дозволеного діапазона!";
        }
    } 
    else 
    { 
        echo "Заповніть порожні поля!";
    }

    echo"
                </p>
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
    echo"<p class='forms-text'>Ви не можете змінювати інформацію, бо ви не авторизовані у свій акаунт!</p>";

    echo" 
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