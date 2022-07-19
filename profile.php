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
    <link rel="stylesheet" href="css/kek_style.css">
    <link rel="stylesheet" href="css/kek_modal.css">
    <link rel="stylesheet" href="fontawesome-free-6.1.1-web/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <style>
        .modal__title{
            font-size:26px;
        }
        .modal{
            width:50%;
        }
    </style>
</head>
<body>
<div class="header">
        <div class="title"><h2>Личный кабинет клиента ООО "ГеоАльянс"</h2></div>
        <div class="header_info">
            <p><?= $_SESSION['user']['full_name']?></p>
            <p><?= $_SESSION['user']['company']?></p>
            <p><a class = "exit" href="index.php">Выйти</a></p>
        </div>
    </div>
    <div class="container">

        <h3 class="order_title">Ваши заявки:</h3>
        <div class="order_block">
            <?php
            session_start();
            $con=mysqli_connect('localhost', 'root', 'root', 'register_bd');
            $id = $_SESSION['user']['id'];
            if (mysqli_connect_errno()){
                echo "Ошибка подключения: " . mysqli_connect_error();}
            $i = 0;
            $query1 = mysqli_query($con, "SELECT * FROM `orders` WHERE  `id_user`='$id'");
            while($row=mysqli_fetch_array($query1)){
            $i=$i+1;
            $icon_yes='<i class="fa fa-check" style=" font-size:35px; color:green;"></i>';
            $icon_process='<i class="fa fa-cog fa-spin fa-3x fa-fw" color:yellow;"></i>';
            //$state = "На рассмотрении";
            if(($row['meneger']== 0) && ($row['tech']==0) && ($row['lawey']==0)){$state = "На рассмотрении менеджера"; $meneger =  $icon_process;$tech= $icon_process;$lawey= $icon_process;}
            if(($row['meneger']== 1) && ($row['tech']==0) && ($row['lawey']==0)){$state = "На рассмотрении технического отдела";$meneger =  $icon_yes;$tech= $icon_process;$lawey= $icon_process;}
            if(($row['meneger']== 1) && ($row['tech']==1) && ($row['lawey']==0)){$state = "На рассмотрении юридического отдела";$meneger =  $icon_yes;$tech= $icon_yes;$lawey= $icon_process;}
            if(($row['meneger']== 1) && ($row['tech']==1) && ($row['lawey']==1)){$state = "Заявка рассмаотрена!";$meneger =  $icon_yes;$tech= $icon_yes;$lawey= $icon_yes;}
            $id_order =$row['id'];
            $error = mysqli_query($con, "SELECT `text` FROM `error_text` WHERE `id_order` = '$id_order'");
            $correct_file = mysqli_query($con, "SELECT `correct_file` FROM `error_text` WHERE `id_order` = '$id_order'");
            if(mysqli_num_rows($error) == 0){
                echo('
                <div class="order">
                    <div class="item"><p>Номер заявки: </br>'.$i.'</p></div>
                    <div class="item"><p>Дата создания заявки: </br>'.$row['Date'].' </p></div>
                    <div class="item"><p>Статус заявки: </br>'.$state.'</p></div>
                    <div class="item"><p>Услуга: </br>'.$row['services'].'</p></div>
                    <div class="item"><p>Техническое задание:<div class="update_file"><a href="'.$row['file'].'" download/>Скачать документ</a></div>
                        <div class="update_file">Изменить документ</div>
                    </div>
                    <div class="item"><p>Менеджер: </br>'.$meneger.'</p></div>
                    <div class="item"><p>Технический отдел: </br>'.$tech.'</p></div>
                    <div class="item"><p>Юридический отдел: </br>'.$lawey.'</p></div>
                    <div class="item_mini"><i class="fa close js-open-modal"  data-modal="2"></i></div>
                </div>
            
            <div class="modal" data-modal="2"> 
                <svg class="modal__cross js-modal-close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M23.954 21.03l-9.184-9.095 9.092-9.174-2.832-2.807-9.09 9.179-9.176-9.088-2.81 2.81 9.186 9.105-9.095 9.184 2.81 2.81 9.112-9.192 9.18 9.1z"/></svg>
                <p class="modal__title">Удаление заявки</p>
                <div class="modal_body">
                    <p class="par_closed">Удаление заявки приведет к отмене заказа</p></br>
                    <p class="par_closed">Вы уверены в том, что хотите удалить заявку?</p>
                    
                    <form action="vendor/delete_order.php"  method="post" class="closed">
                        <div class="Dont js-modal-close"> Не удалять заявку </div>
                        <input name ="id_order" type="text" value="'.$id_order.'" style="display:none;">
                        <input type="submit" class="Do" value="Удалить заявку"/>
                    </form> 
                </div>
            </div>
            ');
            }else{
                $error_text = join("",mysqli_fetch_assoc($error));
                $mda=mysqli_fetch_array($correct_file);
                $file_correct = $mda['correct_file'];
                echo('
                <div class="order">
                    <div class="item"><p>Номер заявки: </br>'.$i.'</p></div>
                    <div class="item"><p>Дата создания заявки: </br>'.$row['Date'].' </p></div>
                    <div class="item"><p>Статус заявки: </br>'.$state.'</p></div>
                    <div class="item"><p>Услуга: </br>'.$row['services'].'</p></div>
                    <div class="item"><p>Техническое задание: </br><a href="'.$row['file'].'" download/>Скачать документ</a></p></div>
                    <div class="item"><p>Менеджер: </br>'.$error_text.'</p></div>
                    <div class="item"><p>Техническое задание:</br><a href="'.$file_correct.'" download/>Замечания по техническому заданию</a></p> </br></p></div>
                    <div class="item_mini"><i class="fa close js-open-modal"  data-modal="2"></i></div>
                </div>
                
                <div class="modal" data-modal="2"> 
                <svg class="modal__cross js-modal-close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M23.954 21.03l-9.184-9.095 9.092-9.174-2.832-2.807-9.09 9.179-9.176-9.088-2.81 2.81 9.186 9.105-9.095 9.184 2.81 2.81 9.112-9.192 9.18 9.1z"/></svg>
                <p class="modal__title">Удаление заявки</p>
                <div class="modal_body">
                    <p class="par_closed">Удаление заявки приведет к отмене заказа</p></br>
                    <p class="par_closed">Вы уверены в том, что хотите удалить заявку?</p>
                    
                    <form action="vendor/delete_order.php"  method="post" class="closed">
                        <div class="Dont js-modal-close"> Не удалять заявку </div>
                        <input name ="id_order" type="text" value="'.$id_order.'" style="display:none;">
                        <input type="submit" class="Do" value="Удалить заявку"/>
                    </form> 
                </div>
            </div>');
            }
                
            }
            mysqli_close($con); ?>
        </div>
        
        <div class="button">
            <a href="#"  class="js-open-modal create_order" data-modal="1">
            Создать заявку
            </a>    
        </div>
    </div>
    <div class="modal" data-modal="1">
                <!--   Svg иконка для закрытия окна  -->
                <svg class="modal__cross js-modal-close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M23.954 21.03l-9.184-9.095 9.092-9.174-2.832-2.807-9.09 9.179-9.176-9.088-2.81 2.81 9.186 9.105-9.095 9.184 2.81 2.81 9.112-9.192 9.18 9.1z"/></svg>
                <p class="modal__title">Создание заявки</p>
                <div class="modal_body">
                <form action="vendor/orders.php"  method="post" enctype="multipart/form-data">
                    <div class="service">
                        <label for="">Услуга</label>
                        
                        <select name = "orders">
                                <?php
                                     $con=mysqli_connect('localhost', 'root', 'root', 'register_bd');
                                     $query1 = mysqli_query($con, "SELECT * FROM `services`");
                                     while($row=mysqli_fetch_array($query1)){
                                         echo('<option>'.$row['name'].'</option>');
                                     }
                                ?>
                        </select>
                    </div>

                    <div class="tech_file">
                        <label for="">Файл технического задания</label>

                        <div class="input__wrapper">
                        <input name="file" type="file" id="input__file" class="input input__file" multiple="">
                            <label for="input__file" class="input__file-button">
                                <span class="input__file-icon-wrapper"><img class="input__file-icon" src="../image/add.svg" alt="Выбрать файл" width="25"></span>
                                <span class="input__file-button-text">Выберите файл</span>
                            </label>
                        </div>
                    </div>
                        <button type="submit" class="add_order"> Создать заявку</button>
                    </form>
                </div>
    </div>
        <div class="overlay js-overlay-modal"></div>
        <script src="js/modal.js"></script>
        <script src="js/addService"></script>
        <script src="js/button_file.js"></script>
</body>
</html>