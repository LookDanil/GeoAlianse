<?php
    $id_order =  filter_var(trim($_POST['id']),FILTER_SANITIZE_STRING);
    $error_text = filter_var(trim($_POST['error_text']),FILTER_SANITIZE_STRING);
    $file_error = filter_var(trim($_POST['file_error']),FILTER_SANITIZE_STRING);
    $mysql = new mysqli('localhost','root','root','register_bd');

    $path = 'uploads/' . time() . $_FILES['file_error']['name'];

    if(!move_uploaded_file($_FILES['file_error']['tmp_name'], '../' .$path)){
        $_SESSION['message'] = 'Ошибка при загрузке файла';
        header('Location: ../admins/manager_profile.php');
    }
    $mysql->query("UPDATE `orders` SET `meneger` = '0' WHERE `orders`.`id` = '$id_order'");
    $mysql->query("INSERT INTO `error_text` (`id_text_error`, `text`, `id_order`, `correct_file`) VALUES (NULL, '$error_text', '$id_order', '$path')");

    header('Location: ../admins/manager_profile.php');
?>
