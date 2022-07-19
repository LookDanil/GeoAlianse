
<?php
    session_start();

    $full_name = filter_var(trim($_POST['full_name']),FILTER_SANITIZE_STRING);
    $company =  filter_var(trim($_POST['company']),FILTER_SANITIZE_STRING);
    $mail = filter_var(trim($_POST['email']),FILTER_SANITIZE_STRING);
    $login =  filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);
    $password =  filter_var(trim($_POST['password']),FILTER_SANITIZE_STRING);
    $password_confirm =  filter_var(trim($_POST['password_confirm']),FILTER_SANITIZE_STRING);
   
    if(str_len($full_name)<8 and str_len($company)<5 and str_len($login)<5){
        $_SESSION['message'] = 'Некорректные данные!';
        header('Location: ../register.php');
    }
    if( $password === $password_confirm){
            $password = md5($password);
            $mysql = new mysqli('localhost','root','root','register_bd');
            $mysql->query("INSERT INTO `users` (`id_user`, `login`, `password`, `full_name`, `company`, `mail`, `activated`) 
            VALUES (NULL, '$login', '$password', '$full_name', '$company', '$mail', '0')");
             
            $mysql->close();
            $_SESSION['message'] = 'Регистрация прошла успешно!';
            header('Location: ../index.php');
            
        }else{
        $_SESSION['message'] = 'Пароли не совпадают!';
        header('Location: ../register.php');
    }
    
?>