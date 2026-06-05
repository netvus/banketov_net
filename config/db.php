<?php
$conn = mysqli_connect("localhost","root","","banketov_net");

if(!$conn){
    die("Ошибка подключения к БД");
}

mysqli_set_charset($conn,"utf8mb4");
?>
