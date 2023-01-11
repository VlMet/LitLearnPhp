<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>"Онлайн расписание Авиатехникума</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="header pd">
        <div class="logo">
            <img src="../img/logo.png" alt="logo" class="logo-img">
            <a href="./index.php">
                <h1>Онлайн расписание Авиатехникума</h1>
            </a>
        </div>
        <div class="reload_btn">
            <form action="" method="post">
                <button id="reload" type="submit" name="rel">Обновить ИС</button>
            </form>
        </div>
        <ul class="header-nav">
            <li><a href="./">Главная</a></li>
            <li><a href="./in.php">Войти в систему</a></li>
        </ul>
    </div>
    <div class="content">
    <?php include_once "includes/connect.php"; ?>
    <?php 
    session_start();
    
    if (isset($_POST['rel'])) {
        unset($_POST);
        //mysql_close();
        header("Refresh:0");
    }
        
    
    ?>