<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Регистрация/Авторизация</title>
    <link rel="stylesheet" href="css/main.css">

</head>
<style>
   .mini_title{
            color: #c7ae54;
            font-size:30px;
        }
</style>
<body>
    <div class="container">
        <div class="main">
            <img src="image/logo.png" class = "logo" alt=""> <p class = "mini_title"> GEOALLIANCE</p>
            <h1>Добро пожаловать наш сайт!</br>
                Авторизируйтесь для дальнейшей работы</h1>
        </div>
    <!-- Форма авторизации !-->
    
        <div class="form">
            <form  action="vendor/signin.php" method="post">
                <label>Логин</label><input type="text" name="login" id="" placeholder = "Введите логин">
                <label>Пароль</label><input type="password" name="password" id="" placeholder="Введите парль">
                <button type="submit" class="button"> Войти</button>
                <p class="regist">У вас нет аккаунта? - <a href="register.php">Зарегистрируйтесь!</a></p>
                <?php
                    if($_SESSION['message']){
                        echo '<p class="msg">' .$_SESSION['message'] .'</p>';
                    }
                    unset( $_SESSION['message'] );
                    ?>
            </form>
        </div>
    </div>
</body>
</html>