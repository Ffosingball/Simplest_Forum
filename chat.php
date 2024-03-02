<?php
ini_set('session.save_path','.\session');
session_start();
?>

<html>
    <head>
        <title>Форум</title>
        <link rel='stylesheet' type='text/css' href='style.css'>
        <link rel='stylesheet' type='text/css' href='style_chat.css'>
        <link rel='shortcut icon' href='i.png'>
    </head>
    <body>
<?php
 
if(!empty($_POST['id_chat']))
{
    $_SESSION['id_chat']=$_POST['id_chat'];
    $_POST['id_chat']=null;
    $_SESSION['name_chat']=$_POST['name_chat'];
    $_POST['name_chat']=null;
}
$id=$_SESSION['id_chat'];

if(isset($_SESSION['name']))
{
    if(!empty($_POST['id_chaine']))
    {
        $chain=$_POST['id_chaine'];
    }
    else
    {
        $chain="-";
    }

    echo"
            <div class='chat_all'>
            <div class='chat-listing'>
            <center><h2>".$_SESSION['name_chat']."</h2></center>
            <p class='error'>".$_SESSION['Error']."</p>";
    

    include "1.php";

    mysqli_select_db($dbcn, "Forum");

    $q2="SELECT * FROM {$id} ORDER BY dateOfCreation DESC";
    $y2=mysqli_query($dbcn,$q2);


    while($p=mysqli_fetch_assoc($y2))
    {
        echo"<div class='message'>
                <div class='content-box'>
                    <div style='display: inline-block;'>
                        <form action='otherInfo.php' method='get'>
                            <input type='hidden' name='name' value='".$p['nickname']."'>
                            <input class='chose-nickname' type='submit' value='".$p['nickname']."'>
                        </form>
                    </div>
                    <div style='display: inline-block;'>
                        <p class='date'>".$p['dateOfCreation']."</p>
                    </div>
                </div>";

        if($p['chainID']!="-")
        {
            $proverka=$p['chainID'];
            $qc="SELECT * FROM {$id} WHERE id='{$proverka}'";
            $yc=mysqli_query($dbcn,$qc);
            $pc=mysqli_fetch_array($yc);

            $value=$pc['content'];
            if(mb_strlen($value)>60)
            {
                $value1=substr($value, 0, 100);
                $value1=$value1."...";
                echo"<div class='chain'><a class='chain-text' href='#".$proverka."'>".$value1."</a></div>";
            }
            else
            {
                echo"<div class='chain'><a class='chain-text' href='#".$proverka."'>".$value."</a></div>";
            }
        }

        echo"<div class='content-box'>
                <a class='content-text' name='".$p['id']."'>".$p['content']."</a>
                <form method='post'>
                    <input type='hidden' name='id_chaine' value='".$p['id']."'>
                    <input class='another-page' type='submit' value='Відповісти'>
                </form>
            </div>
        </div>";
    }

    echo "</div></div>
    <div class='menu_bottom'>
        <form action='getData.php' method='GET'>
        <table>
            <tr>";
    
    if($chain!="-")
    {
        $qc="SELECT * FROM {$id} WHERE id='{$chain}'";
        $yc=mysqli_query($dbcn,$qc);
        $pc=mysqli_fetch_array($yc);

        $value=$pc['content'];
        if(mb_strlen($value)>60)
        {
            $value1=substr($value, 0, 100);
            $value1=$value1."...";
            echo"<td width='30%'><center><p class='content-text'>".$value1."</p></center></td>";
        }
        else
        {
            echo"<td width='30%'><center><p class='content-text'>".$value."</p></center></td>";
        }
    }
    else
    {
        echo"<td width='30%'></td>";
    }
    
    echo"   <td width='50%'><textarea type='text' class='inputs' name='content' cols='100' rows='2'></textarea>
            <input type='hidden' name='chain' value='".$chain."'>
            <input type='hidden' name='idForum' value='".$id."'></td>
            <td width='20%'><center><input class='send-button' type='submit' value='Надіслати'></center><td>
        </tr>
    </table>
    </form>
    </div>";


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
                <p class='forms-text'>Щоб спілкуватися на цьому форумі з іншими користувачами авторизуйтеся або зареєструйтеся!</p>
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
    </body>
</html>