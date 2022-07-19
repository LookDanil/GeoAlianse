<?php
    $id = $_POST['id'];
    $departament = $_POST['departament'];
    $mysql = new mysqli('localhost','root','root','register_bd');
    
    if($departament == 'Отдел по работе с клиентами'){
        $mysql->query("UPDATE `orders` SET meneger=1 WHERE id ='$id' ");
        header('Location: ../admins/manager_profile.php');
    }
    if($departament == 'Юридичсекий отдел'){
        $mysql->query("UPDATE `orders` SET meneger=1 WHERE id ='$id' ");
        header('Location: ../admins/lawey_profile.php');
    }
    if($departament == 'Технический отдел'){
        $mysql->query("UPDATE `orders` SET meneger=1 WHERE id ='$id' ");
        header('Location: ../admins/tech_profile.php');
    }
?>