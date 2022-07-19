
<?php
    session_start();
    $login =  filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);
    $password =  filter_var(trim($_POST['password']),FILTER_SANITIZE_STRING);

    $mysql = new mysqli('localhost','root','root','register_bd');
    $password = md5($password);
    $chek_user = mysqli_query($mysql,"SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password' ");
    if(mysqli_num_rows($chek_user) > 0){
        
        $user = mysqli_fetch_assoc($chek_user);
        $_SESSION['user']=[
                'id' => $user['id_user'],
                'full_name' => $user['full_name'],
                'company' => $user['company'],
        ];
        header('Location: ../profile.php');
    }else{
        $_SESSION['message'] = 'Неверный логин или пароль!';
        header('Location: ../index.php');
    }
   // $mysql->close();

?>