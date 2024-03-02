<?php
ini_set('session.save_path','.\session');
session_start();
?>

<html>
    <head>
        <title>Додавання нового форума</title>
        <link rel='stylesheet' type='text/css' href='style.css'>
        <link rel='shortcut icon' href='i.png'>
    </head>
    <body>
<?php
 
if(isset($_SESSION['name']))
{
    echo"
    <div class='registr_all'>
        <div class='registr'>
            <center><h2>Додати форум</h2></center>";

    echo"
    <h2>Додати форум</h2>
        <form method='post'>
            <table>
                <tr>
                    <td><p class='forms-text'>Назва форума</p>
                    <input class='inputs' type='text' name='1'></td>
                </tr>
                <tr>
                    <td><p class='forms-text'>Опис форуму</p>
                    <textarea class='inputs' type='text' name='2' cols='50' rows='10'></textarea></td>
                </tr>
                <tr>
                    <td><input type='hidden' name='3' value='".$_SESSION['name']."'>
                    <input class='input-button' type='submit' value='Додати'></td>
                </tr>
            </table>
        </form>
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



    function generate_id($dbcn)
    {
        $q2="SELECT * FROM forumsList ORDER BY id DESC LIMIT 1";
        $y2=mysqli_query($dbcn,$q2);
        $p2=mysqli_fetch_assoc($y2);

        $substring = substr($p2['id'], 1, 6);
        $num=intval($substring);

        $num++;
        if($num>=1000)
        {
            $id="F".$num;
        }
        elseif($num>=100)
        {
            $id="F0".$num;
        }
        elseif($num>=10)
        {
            $id="F00".$num;
        }
        else
        {
            $id="F000".$num;
        }

        return $id;
    }


    $name = $_POST['1'];
    $descript = $_POST['2'];
    $creator = $_POST['3'];

    $name=clean($name);
    $descript=clean($descript);
    $creator=clean($creator);

    if(!empty($name) && !empty($descript) && !empty($creator)) 
    {
        if(check_length($name, 1, 60) && check_length($descript, 0, 400) && check_length($creator, 0, 20)) 
        {
            
            include "1.php";
            mysqli_select_db($dbcn, "Forum");

            $id=generate_id($dbcn);
            
            $q="INSERT INTO forumsList VALUES ('{$id}','{$name}','{$creator}','{$descript}',NOW())";
            $q2="CREATE TABLE {$id} (id VARCHAR(9) NOT NULL UNIQUE PRIMARY KEY, content VARCHAR(3000) NOT NULL, nickname VARCHAR(20) NOT NULL, dateOfCreation DATETIME NOT NULL, chainID VARCHAR(9)) ENGINE=InnoDB DEFAULT CHARSET=cp1251";
            
            echo $q;
            echo $q2;
            
            $proverka=mysqli_query($dbcn, $q);
            $proverka2=mysqli_query($dbcn, $q2);
            
            if($proverka==false or $proverka2==false)
            {
                echo "Помилка при створені нового форума!";
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
        <div class='registr_all'>
            <div class='registr'>
                <p class='forms-text'>Щоб створити свій форум авторизуйтеся або зареєструйтеся на цьому сайті!</p>
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