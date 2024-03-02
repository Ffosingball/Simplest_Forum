<?php
echo"
<p>Додати форум</p>
<form action='addForum.php' method='post'>
    <p>Назва форума</p>
    <input type='text' name='1'>
	<p class='text_com'>Опис форуму</p>
	<textarea type='text' name='2' cols='70' rows='15'></textarea>
    <p>Ім'я створювача</p>
    <input type='text' name='3'>
    <input type='submit' value='Додати'>
</form>";

include "1.php";

mysqli_select_db($dbcn, "Forum");

$q2="SELECT * FROM forumsList";
$y2=mysqli_query($dbcn,$q2);
echo "<h2>Список форумів</h2>";

echo "<table><tr>
		<th>ID</th>
		<th>Назва</th>
		<th>Автор</th>
        <th>Опис</th>
		<th>Дата</th></tr>";

while($p=mysqli_fetch_assoc($y2))
{
    echo"<tr>
	<td>".$p['id']."</td>
	<td>".$p['name']."</td>
	<td>".$p['creator']."</td>
	<td>".$p['descript']."</td>
    <td>".$p['dateOfCreation']."</td>
	</tr>";
}

echo "</table>";


$q2="SELECT * FROM accaunts";
$y2=mysqli_query($dbcn,$q2);
echo "<h2>Список акаунтів</h2>";

echo "<table><tr>
		<th>ID</th>
		<th>Нікнейм</th>
		<th>Пошта</th>
        <th>Пароль</th>
		<th>Про себе</th></tr>";

while($p=mysqli_fetch_assoc($y2))
{
    echo"<tr>
	<td>".$p['id']."</td>
	<td>".$p['nickname']."</td>
	<td>".$p['email']."</td>
	<td>".$p['password']."</td>
	<td>".$p['descript']."</td>
	</tr>";
}

echo "</table>";



$q2="SELECT * FROM F0014";
$y2=mysqli_query($dbcn,$q2);
echo "<h2>Список якогось форума</h2>";

echo "<table><tr>
		<th>ID</th>
		<th>Нікнейм</th>
		<th>Контент</th>
        <th>Дата</th>
		<th>Цепочка</th></tr>";

while($p=mysqli_fetch_assoc($y2))
{
    echo"<tr>
	<td>".$p['id']."</td>
	<td>".$p['nickname']."</td>
	<td>".$p['content']."</td>
    <td>".$p['dateOfCreation']."</td>
	<td>".$p['chainID']."</td>
	</tr>";
}

echo "</table><br>";

$proverka="W00000008";
$id="F0010";
$q2 = "SELECT * FROM F0010 WHERE id='W00000008'";
$y2 = mysqli_query($dbcn, $q2);
$p2 = mysqli_fetch_array($y2);
if ($p2) {
    echo "Повідомлення: " . $p2['content'];
} else {
    echo "Запись не найдена";
}
echo"<br>Ном. ".$proverka."<br>Фор. {$id}<br>
Повідомлення: ".$p2['nickname'];
?>