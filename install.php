<?php
  $servername = "localhost";
  $username = "root";
  $password = "";

  $conn = new mysqli($servername, $username, $password);

  if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "CREATE DATABASE testDB";

  if ($conn->query($sql)===TRUE) {
    echo "База данных успешно создана<br>";
  } else {
    echo "Ошибка: " . $conn->error;
  }

  $sqlTable = "CREATE TABLE testdb.news(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    heading VARCHAR (50) NOT NULL,
    imagesrc VARCHAR (30),
    ad VARCHAR (30),
    about VARCHAR (100)
  )";

  if ($conn->query($sqlTable)===TRUE) {
    echo "Таблица успешно создана";
  } else {
    echo "Ошибка: " . $conn->error;
  }
 ?>
