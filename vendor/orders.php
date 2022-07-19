<?php
    session_start();
    $full_name = $_SESSION['user']['full_name'];
    $company = $_SESSION['user']['company'];
    $date =  date("m.d.y");
    $service = filter_var(trim($_POST['orders']),FILTER_SANITIZE_STRING);
    $file = filter_var(trim($_POST['file']),FILTER_SANITIZE_STRING);
    $id_user = $_SESSION['user']['id'];
    $path = 'uploads/' . time() . $_FILES['file']['name'];
    if(!move_uploaded_file($_FILES['file']['tmp_name'], '../' .$path)){
        $_SESSION['message'] = 'Ошибка при загрузке файла';
        //header('Location: ../profile.php');
    }
    $mysql = new mysqli('localhost','root','root','register_bd');
    $mysql->query("INSERT INTO `orders` (`id`, `id_user`, `Date`, `services`, `full_name`, `company`, `file`, `meneger`, `tech`, `lawey`) 
    VALUES (NULL, '$id_user', '$date', '$service', '$full_name', '$company', '$path', '0', '0', '0')");
    header('Location: ../profile.php');
    $_SESSION['order']['data'] =$date;
    $mysql->close();
?>