<?php
$key = array_key_first($_POST);

$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'testdb';
$link = mysqli_connect($host, $user, $pass, $db_name);

if (!$link) {
  echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
  exit;
}
$sql = mysqli_query($link, 'SELECT * FROM `news`');
$sql = mysqli_query($link, 'DELETE FROM `news` WHERE `id`='.$key.'');

?>
