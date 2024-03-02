<?php
ini_set('session.save_path','.\session');
session_start();
?>

<html>
    <head>
        <title>Про форум</title>
        <link rel='stylesheet' type='text/css' href='style.css'>
        <link rel='shortcut icon' href='i.png'>
    </head>
    <body>
        <div class='registr_all'>
            <div class='forum-listing'>
                <center><p class="name">Ім'я: Бита Андрій Андрійович
                <br>Клас: 11-Г
                <br>Керівники: Пасько Анатолій Іванович</p></center>
                <center><h2>Antertino</h2></center>
                <p class='main-text'>Сайт "Antertino" - це онлайн-спільнота, призначена для учнів ліцеїв, які поїхали за кордон навчатися. Цей веб-ресурс створений з метою створення зручної платформи для комунікації та обміну досвідом між ліцеїстами, які навчаються в різних країнах та ліцеями.
                <br>Основні функції та можливості сайту включають:</p>
                <ul>
                    <li class='main-text'>Профілі користувачів: Кожен учасник може створити особистий профіль, де розмістити інформацію про себе, своє навчання та інтереси.</li>
                    <li class='main-text'>Форуми: Учні можуть приєднатися до тематичних форумів для обговорення актуальних питань, обміну досвідом та задання питань один одному.</li>
                    <li class='main-text'>Пошук співрозмовників: Сайт надає можливість легко знайти інших ліцеїстів, які навчаються в тій же країні або навіть в тому ж самому місті. Це може допомогти встановити нові дружні стосунки та підтримувати один одного в незвичайному середовищі.</li>
                    <li class='main-text'>Мовне навчання: Спілкування на сайті може бути використане для покращення мовних навичок. Учні можуть спілкуватися між собою на іноземних мовах та вчити один одного нові вирази та граматичні конструкції.</li>
                    <li class='main-text'>Події та зустрічі: Сайт також може бути платформою для організації зустрічей та подій для ліцеїстів, які навчаються в одній країні. Це може сприяти підтримці та інтеграції у новому середовищі.</li>
                </ul>
                <p class='main-text'>Цей сайт створений з метою підтримати ліцеїстів, які перебувають за кордоном у процесі навчання та адаптації до нових умов. Він сприяє обміну інформацією, взаємопідтримці та формуванню нових знайомств у глобальному освітньому співтоваристві.</p>
            </div>
        </div>
<?php
 
 if(isset($_SESSION['name']))
 {
    echo"
 <div class='menu2'>
    <p class='name'>".$_SESSION['name']."</p>
 </div>";
 if($_SESSION['name']=='Administrator')
    {
        echo"<div class='menu'>
            <ul class='css-menu'>
                <li><a href=./main.php>Головна</a></li>
                <li><a href=./forumsList.php>Форуми</a></li>
                <li><a href=./info.php>Особиста інформація</a></li>
                <li><a href=./delAccaunts.php>Акаунти</a></li>
                <li><a href=./exit.php>Вийти з акаунта</a></li>
            </ul>
    </div>";
    }
    else
    {
    echo"<div class='menu'>
        <ul class='css-menu'>
            <li><a href=./main.php>Головна</a></li>
            <li><a href=./forumsList.php>Форуми</a></li>
            <li><a href=./info.php>Особиста інформація</a></li>
            <li><a href=./exit.php>Вийти з акаунта</a></li>
        </ul>
    </div>";
    }
 }
 else
 {
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