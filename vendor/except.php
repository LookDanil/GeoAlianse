<?php
    header('Content-Type: application/json');
    //$con=mysqli_connect('localhost', 'root', 'root', 'register_bd');
   /* $id = [
      "id" => $POST['id']  
    ];*/
    $id = $_POST['id'];
    $response = array();
    $response['value'] = $id;
    echo json_encode($response);
    //$con->query("UPDATE `orders` SET meneger = 1 WHERE id = '$id'");
?>