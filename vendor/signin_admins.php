
<?php
    session_start();
    $login =  filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);
    $password =  filter_var(trim($_POST['password']),FILTER_SANITIZE_STRING);

    $mysql = new mysqli('localhost','root','root','register_bd');
    $password = md5($password);
    $chek_admin = mysqli_query($mysql,"SELECT * FROM `admins` WHERE `login` = '$login' AND `password` = '$password' ");
    $row=mysqli_fetch_array($chek_admin);
    $departament = $row['departament'];
    $full_name = $row['full_name'];
    $id_admin = $row['id_admin'];
    if(mysqli_num_rows($chek_admin) > 0){
        $_SESSION['admin']=[
                'id' => $id_admin,
                'full_name' => $full_name,
                'departament' => $departament,
        ];
        if($departament == "Отдел по работе с клиентами"){header('Location: ../admins/manager_profile.php');}
        if($departament == "Юридичсекий отдел"){header('Location: ../admins/lawey_profile.php');}
        if($departament == "Технический отдел"){header('Location: ../admins/tech_profile.php');}
    }else{
        $_SESSION['message'] = 'Неверный логин или пароль!';
        header('Location: ../index_admins.php');
    }
   // $mysql->close();

?>