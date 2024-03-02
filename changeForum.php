<?php
ini_set('session.save_path','.\session');
session_start();

$id_ac="";

echo"
<html>
    <head>
        <title>Зміна деталей про форум</title>
        <link rel='stylesheet' type='text/css' href='style.css'>
        <link rel='shortcut icon' href='i.png'>
    </head>
    <body>
        <div class='registr_all'>
            <div class='registr'>
                <center><h2>Зміна деталей про форум</h2></center>";

if(isset($_SESSION['name']))
{
    include "1.php";
    mysqli_select_db($dbcn, "Forum");
    
    $id=$_GET['id'];

    $q1="SELECT * FROM forumsList WHERE id='{$id}'";
    $y1=mysqli_query($dbcn,$q1);

    $p=mysqli_fetch_array($y1);
    
    echo"<table>
    <form method='get'>
        <tr>
            <td><p class='forms-text'>Назва:</p></td>
            <td><input class='inputs' type='text' name='name' value='".$p['name']."'></td>
        </tr> 
        <tr>
            <td><p class='forms-text'>Про форум:</p></td>
            <td><textarea class='inputs' type='text' name='opys' cols='40' rows='6'>".$p['descript']."</textarea></td>
        </tr> 
        <tr>
            <td><input type='hidden' name='id' value='{$id}'></td>
            <td><input class='input-button' type='submit' value='Змінити'></td>
    </tr></form></table><p class='error'>";

    
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

    
    $name = $_GET['name'];
    $descript = $_GET['opys'];


    $name=clean($name);
    $descript=clean($descript);

    if(!empty($descript) && !empty($name)) 
    {
        if(check_length($descript, 0, 400) && check_length($name, 0, 60)) 
        {
            
            include "1.php";
            mysqli_select_db($dbcn, "Forum");
            
            $q="UPDATE forumsList SET name='{$name}', descript='{$descript}' WHERE id='{$id}'";
            
            $proverka=mysqli_query($dbcn, $q);
            
            if($proverka==false)
            {
                echo "Помилка при змінені деталей форума!";
            } 
            else
            {
                echo "<br>";
                $last_id = mysqli_insert_id($dbcn);
                echo $last_id;
                header("Location: ./forumsList.php");
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
    echo "</p></div></div>";


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
    echo"<p clas='forms-text'>Ви не можете змінювати інформацію, бо ви не авторизовані у свій акаунт!</p>";

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