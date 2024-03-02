<?php
ini_set('session.save_path','.\session');
session_start();
?>

<html>
    <head>
        <title>Регістрація</title>
        <link rel='stylesheet' type='text/css' href='style.css'>
        <link rel='shortcut icon' href='i.png'>
    </head>
    <body>
        <div class='registr_all'>
            <div class='registr'>
                <center><h2>Регістрація</h2></center>
<?php
if(isset($_SESSION['name']))
{
    echo"<p class='error'>Щоб зареєструвати новий акаунт треба вийти з поточного!</p>
    </div></div>
 <div class='menu2'>
    <p class='buton'>".$_SESSION['name']."</p>
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
    echo"        <table>
                    <form method='post'>
                        <tr>
                            <td><p class='forms-text'>Нікнейм*:</p>
                            <input class='inputs' type='text' name='name'><br></td>
                        </tr> 
                        <tr>
                            <td><p class='forms-text'>Пароль*: </p>
                            <input class='inputs' type='password' name='pass'><br></td>
                        </tr>
                        <tr>
                            <td><p class='forms-text'>Повторно введіть пароль*: </p>
                            <input class='inputs' type='password' name='passagain'><br></td>
                        </tr>
                        <tr>
                            <td><p class='forms-text'>Е-mail*:</p>
                            <input class='inputs' type='text' name='email'><br></td>
                        </tr> 
                        <tr>
                            <td><p class='forms-text'>Про себе:</p>
                            <textarea class='inputs' type='text' name='opys' cols='40' rows='6'></textarea><br></td>
                        </tr> 
                        <tr>
                            <td colspan='2'><p class='error'>(Всі поля, які позначені * обов'язкові до ввода)</p></td>
                        </tr>
                        <tr>
                            <td><input class='input-button' type='submit' value='Зареєструватися'></td>
                        </tr>
                    </form>
                </table><p class='error'>";
    

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


    function generate_id($dbcn)
    {
        $q2="SELECT * FROM accaunts ORDER BY id DESC LIMIT 1";
        $y2=mysqli_query($dbcn,$q2);
        $p2=mysqli_fetch_assoc($y2);

        $substring = substr($p2['id'], 1, 9);
        $num=intval($substring);

        $num++;
        if($num>=1000000)
        {
            $id="A".$num;
        }
        elseif($num>=100000)
        {
            $id="A0".$num;
        }
        elseif($num>=10000)
        {
            $id="A00".$num;
        }
        elseif($num>=1000)
        {
            $id="A000".$num;
        }
        elseif($num>=100)
        {
            $id="A0000".$num;
        }
        elseif($num>=10)
        {
            $id="A00000".$num;
        }
        else
        {
            $id="A000000".$num;
        }

        return $id;
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

        if(check_length($name, 1, 15) && check_length($descript, 0, 100) && check_length($pass, 1, 8) && check_length($passagain, 1, 8) && check_length($email, 0, 60)) 
        {
            if($pass==$passagain)
            {
                include "1.php";
                mysqli_select_db($dbcn, "Forum");

                $q1="SELECT * FROM accaunts WHERE nickname='$name'";
                $y1=mysqli_query($dbcn,$q1);
                $p=mysqli_fetch_array($y1);

                if($p['nickname']==$name)
                {
                    echo"Такий нікнейм вже зайнято іншим користувачем, створіть інший!";
                }
                else
                {
                    $id=generate_id($dbcn);
                        
                    $q="INSERT INTO accaunts VALUES ('{$id}','{$name}','{$email}','{$pass}','{$descript}')";
                    echo $q;
                    $proverka=mysqli_query($dbcn, $q);
                        
                    if($proverka==false)
                    {
                        echo "Помилка при створенні вашого акаунта!";
                    } 
                    else
                    {
                        header("Location: ./login.php");
                    }
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
        echo "Заповніть порожні поля з зірочкою!";
    }
    
    echo" </p></div>
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

 echo"<div class='end'>
        <br><p class='forms-text'>Сайт створив Бита Андрій Андрійович для курсової роботи у 2023 році!</p>
        <img src='logo.png' width='100px' height='100px'>
    </div>
    </body>
</html>";
?>