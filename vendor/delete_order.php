<?php
    $id_order =  filter_var(trim($_POST['id_order']),FILTER_SANITIZE_STRING);

    $mysql = new mysqli('localhost','root','root','register_bd');
    $mysql->query("DELETE FROM `orders` WHERE `orders`.`id` = '$id_order'");
    //echo $id_order;
    header('Location: ../profile.php');
?>