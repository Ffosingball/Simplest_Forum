<?php
ini_set('session.save_path','.\session');
session_start();

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



function generate_id($dbcn,$loc_id)
{
    $q4="SELECT * FROM {$loc_id} ORDER BY id DESC LIMIT 1";
    $y4=mysqli_query($dbcn,$q4);
    $p4=mysqli_fetch_assoc($y4);

    $substring = substr($p4['id'], 1, 10);
    $num=intval($substring);

    $num++;
    if($num>=10000000)
    {
        $id="W".$num;
    }
    elseif($num>=1000000)
    {
        $id="W0".$num;
    }
    elseif($num>=100000)
    {
        $id="W00".$num;
    }
    elseif($num>=10000)
    {
        $id="W000".$num;
    }
    elseif($num>=1000)
    {
        $id="W0000".$num;
    }
    elseif($num>=100)
    {
        $id="W00000".$num;
    }
    elseif($num>=10)
    {
        $id="W000000".$num;
    }
    else
    {
        $id="W0000000".$num;
    }

    return $id;
}


$content = $_GET['content'];
$chain2=$_GET['chain'];
$id=$_GET['idForum'];

$content=clean($content);

if(!empty($content)) 
{
    if(check_length($content, 1, 3000)) 
    {
        
        include "1.php";
        mysqli_select_db($dbcn, "Forum");

        $id_mes=generate_id($dbcn,$id);
        $name=$_SESSION['name'];
        
        $q="INSERT INTO {$id} VALUES ('{$id_mes}','{$content}','{$name}',NOW(),'{$chain2}')";
        
        $proverka=mysqli_query($dbcn, $q);

        if($proverka==false)
        {
            var_dump($_GET);
            echo"<br>{$q}<br>";
            echo"{$q}";
            $_SESSION['Error']="Відбулася помилка при відправлені повідомлення!";
            header("Location: ./chat.php");
        }  
        else
        {
            $_SESSION['Error']="Надіслано!";
            header("Location: ./chat.php");
        }
    } 
    else 
    { 
        $_SESSION['Error']="Занадто великий текст! Максимум 3000 символів!";
        header("Location: ./chat.php");
    }
} 
else 
{ 
    $_SESSION['Error']="Ви нічого не написали!";
    header("Location: ./chat.php");
}
?>