
<?php
    session_start();
    $full_name = filter_var(trim($_POST['full_name']),FILTER_SANITIZE_STRING);
    $departament =  filter_var(trim($_POST['departament']),FILTER_SANITIZE_STRING);
    $mail = filter_var(trim($_POST['email']),FILTER_SANITIZE_STRING);
    $login =  filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);
    $password =  filter_var(trim($_POST['password']),FILTER_SANITIZE_STRING);
    $password_confirm =  filter_var(trim($_POST['password_confirm']),FILTER_SANITIZE_STRING);
    if( $password === $password_confirm){
            $password = md5($password);
            $mysql = new mysqli('localhost','root','root','register_bd');
            $mysql->query("INSERT INTO `admins` (`id`, `full_name`, `login`, `password`, `departament`, `mail`)
             VALUES (NULL, '$full_name', '$login', '$password', '$departament', '$mail')");
            
            $mysql->close();
            $_SESSION['message'] = 'Регистрация прошла успешно!';
            header('Location: ../index.php');
            
        }else{
        $_SESSION['message'] = 'Пароли не совпадают!';
        header('Location: ../register.php');
    }
    
?>