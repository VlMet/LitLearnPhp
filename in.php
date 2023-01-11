<?php include_once "includes/header.php"; ?>
<?php include_once "includes/connect.php"; ?>
<div class="block">
    <h3>Войти в профиль</h3>
    <form action="" method="post" class="form_selectGroup">

        <input type="text" name="login" id="login" placeholder="Логин" require>
        <input type="password" name="pass" id="pass" placeholder="Пароль" require>
        <button type="submit" name="go">Авторизация</button>
    </form>


</div>
<?php
$_SESSION['admin'] = false;

if (isset($_POST['go'])) {
    $sql = "SELECT * FROM `users`";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['name'] == $_POST['login'] && $row['password'] == $_POST['pass']) {
                $_SESSION['admin'] = true;
                header("Location: ./admin.php");
                exit();
            }
        }
    } else {
        echo "профиль не найден";
    }
}
?>
<style>
    .reload_btn{
        display: none;
    }
</style>