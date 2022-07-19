<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Регистрация администратора</title>
    <link rel="stylesheet" href="css/main.css">
    <style>
        select{
            padding:10px;
        }
        label{
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="container_reg">
    <div class="header">
    <h2>Регистрация сотрудников</h2>
    </div>
        <!-- Форма регистрации !-->
        
    <div class="form_reg">
        <form  action="vendor/signup_admins.php" method="post">
            <label>ФИО</label><input type="text" name="full_name" id="" placeholder = "Введите ФИО">
            <label for="">Отдел:</label>
            <select name="departament">
                <option>Отдел по работе с клиентами</option>
                <option>Юридичсекий отдел</option>
                <option>Технический отдел</option>
            </select>
            <label>Почта</label><input type="text" name="email" id="" placeholder = "Введите email">
            <label>Логин</label><input type="text" name="login" id="" placeholder = "Введите логин">
            <label>Пароль</label><input type="password" name="password" id="" placeholder="Введите пароль">
            <label>Подтверждение пароля</label><input type="password" name="password_confirm" id="" placeholder="Подтвердите пароль">
            <button type="submit"> Зарегистрироваться</button>
            <p>У вас уже есть аккаунт?- <a href="index_admins.php">Авторизируйтесь!</a></p>
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