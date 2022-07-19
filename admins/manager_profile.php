<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>
    <link rel="stylesheet" href="../css/kek_style.css">
    <link rel="stylesheet" href="../css/kek_modal.css">
    <link rel="stylesheet" href="../css/style_admins.css">
    <link rel="stylesheet" href="fontawesome-free-6.1.1-web/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <style>
        .modal{
            width:100%;
        }
        .order_title{
            font-size:25px;
        }
        .tech_file{
            flex-direction:column;
            padding: 10px;
        }
    </style>
</head>
<body>
<div class="header">
        <div class="title"><h2> Личный кабинет сотрудника ООО "ГеоАльянс"</h2></div>
        <div class="header_info">
            <p><?=  $_SESSION['admin']['full_name']?></p>
            <p><?=  $_SESSION['admin']['departament']?></p>
            <p><a class = "exit" href="../index_admins.php">Выйти</a></p>
        </div>
    </div>
    <div class="container">
            <div class="dop_block"></div>
        <div class="menu">
        <!--<div class="title_block">
            <h3 class="order_title">Главная страница</h3>
            </div>
           <div class="icons">
            <img class = "icon" src="../image/Reports.png" id="icon_reports"  onclick = "AddBlock(reports,menu)">
            <img class = "icon" src="../image/Orders.png" id="icon_orders"  onclick = "AddBlock(orders,menu)">
            <img class = "icon" src="../image/Files.png" onclick = "AddBlock(files,menu)" >
            <img class = "icon" src="../image/Message.png">
           </div>
        </div>!-->
        <div class="orders" style="display:block">
            <h3 class="order_title">Заявки</h3>
            <?php
                session_start();
                $con=mysqli_connect('localhost', 'root', 'root', 'register_bd');
                if (mysqli_connect_errno()){
                    echo "Ошибка подключения: " . mysqli_connect_error();}
                $query = mysqli_query($con, "SELECT * FROM `orders`");
                $k = 0;
                while($row=mysqli_fetch_array($query)){
                    $k = $k+1;
                    $id_user = $row['id_user'];
                    $mail = mysqli_query($con, "SELECT mail FROM `users` WHERE id_user = '$id_user'");
                    $kek = mysqli_fetch_array($mail);
                    $id = $row['id'];
                echo('<div class="order">
                        <div class="item"><p>№: </br><div class="id_order">'.$row['id'].'</div></p></div>
                        <div class="item"><p>Клиентская компания: </br>'.$row['company'].' </p></div>
                        <div class="item"><p>Услуга: </br>'.$row['services'].'</p></div>
                        <div class="item"><div class="button_info js-open-modal"  data-modal="'.$row['id'].'">Информация</div></div>
                    </div>
                    <div class="modal" data-modal="'.$row['id'].'">
                        <svg class="modal__cross js-modal-close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M23.954 21.03l-9.184-9.095 9.092-9.174-2.832-2.807-9.09 9.179-9.176-9.088-2.81 2.81 9.186 9.105-9.095 9.184 2.81 2.81 9.112-9.192 9.18 9.1z"/></svg>
                        <p class="modal__title" val = "'.$row['id'].'">Заявка №'.$row['id'].'</p>

                        <div class="modal_body">
                            <div class="modal_info">
                                <div class="item_info">
                                    <p>Компания</p>
                                    <p class="shablon_info">'.$row['company'].'</p>
                                </div>
                                <div class="item_info">
                                    <p >Представитель</p>
                                    <p class="shablon_info">'.$row['full_name'].'</p>
                                </div>
                                <div class="item_info">
                                    <p >Техническое задание</p>
                                    <p class="shablon_info"><a href="'.$row['file'].'" download/>Скачать файл</a></p>
                                </div>
                                <div class="item_info">
                                    <p>Реквизиты</p>
                                    <p class="shablon_info">Пока не знаю что тут написать</p>
                                </div>
                                <div class="item_info">
                                    <p>Почта</p>
                                    <p class="shablon_info">'.$kek['mail'].'</p>
                                </div>
                            </div>

                            <div class="modal_funtion">
                                <div class="buttons_order">
                                    <form action="../vendor/mem.php" method="post">
                                        <input name ="departament" type="text" value="'.$_SESSION['admin']['departament'].'" style="display:none;">
                                        <input name ="id" type="text" value="'.$id.'" style="display:none;">
                                        <button class="confirm" type="submit"> Подтвердить</button>
                                    </form>
                                    <div class="refuse" onclick = "Kek(event)"  id="'.$k.'"> &nbsp;Отклонить</div>
                                </div>

                                <div style="display:none;" class="Keka" id="'.$k.'">
                                        <form action="../vendor/refuse.php" method="post" enctype="multipart/form-data">
                                            </br></br><label>Введите причину отказа: </label></br></br>
                                            <input name ="departament" type="text" value="'.$_SESSION['admin']['departament'].'" style="display:none;">
                                            <input name ="id" type="text" value="'.$id.'" style="display:none;">
                                            <textarea class="trable" name="error_text"></textarea>
                                            <div class="tech_file" >
                                                <p>Файл с поправками</p>
                                                <div class="input__wrapper">
                                                    <input name="file_error" type="file" multiple="">
                                                </div>
                                        </div>
                                            <button class="bnt_refuse" type="submit"> Отказать</button>
                                        </form>
                                    </div>
                            </div>
                        </div>
                    </div>
                    ');
                }
                ?>
                
            <a href="#"  onclick = "Back(orders,menu)" ><div class="back">Назад</div></a>
        </div>
        
        <div class="reports">
            <h3 class="reports_title">Отчеты</h3>
            <?php
                session_start();
                $con=mysqli_connect('localhost', 'root', 'root', 'register_bd');
                if (mysqli_connect_errno()){
                    echo "Ошибка подключения: " . mysqli_connect_error();}
                $query = mysqli_query($con, "SELECT * FROM `orders`");
                while($row=mysqli_fetch_array($query)){
                echo('<div class="report">
                        <div class="item"><p><div class="id_order">'.$row['id'].'</div></p></div>
                        <div class="item"><p>'.$row['company'].' </p></div>
                        <div class="item"><p><a href="'.$row['file'].'" download/>Скачать отчет</a></p></div>
                        <div class="item"><p>'.$row['Date'].' </p></div>
                    </div>
                    ');
                }
                ?>
             <a href="#"  onclick = "Back(reports,menu)" ><div class="back">Назад</div></a>
        </div>
        <div class="files">
            <h3 class="reports_title">Файлы</h3>
            <?php
                session_start();
                $con=mysqli_connect('localhost', 'root', 'root', 'register_bd');
                if (mysqli_connect_errno()){
                    echo "Ошибка подключения: " . mysqli_connect_error();}
                $query = mysqli_query($con, "SELECT * FROM `orders`");
                while($row=mysqli_fetch_array($query)){
                echo('<div class="report">
                        <div class="item"><p><div class="id_order">'.$row['id'].'</div></p></div>
                        <div class="item"><p>'.$row['company'].' </p></div>
                        <div class="item"><p><a href="'.$row['file'].'" download/>Скачать техническое задание</a></p></div>
                        <div class="item"><p>'.$row['Date'].' </p></div>
                    </div>
                    ');
                }
                ?>
             <a href="#"  onclick = "Back(files,menu)" ><div class="back">Назад</div></a>
        </div>
        <div class="overlay js-overlay-modal"></div>
        <script src="../js/modal.js"></script>
        <script src="../js/block.js"></script>
        <script src="../js/popravka.js"></script>
        <script src="../js/block_text_error.js"></script>
        <script>
                        var orders = document.querySelector(".orders");
            var menu = document.querySelector(".menu");
            var reports = document.querySelector(".reports");
            var files = document.querySelector(".files");

            function AddBlock(object,menu){
            object.classList.toggle('dispB');
            menu.classList.add('dispN');
            }
            function Back(object,menu){
                menu.classList.remove('dispN');
                object.classList.remove('dispB');
            }
        </script>
</body>
</html>