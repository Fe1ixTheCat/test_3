<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Edit</title>
    <link rel="stylesheet/css" type="text/css" href="styles.css" />
  </head>
  <body>
    <?php
      $host = 'localhost';
      $user = 'root';
      $pass = '';
      $db_name = 'testdb';
      $db_table = 'news';
      $link = mysqli_connect($host, $user, $pass, $db_name);

      if (!$link) {
      echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
      exit;
      }

      $key = $_GET['id'];
      $sql = mysqli_query($link, 'SELECT * FROM `news` WHERE  `id`='.$key.'');
      $result = mysqli_fetch_array($sql);

      echo "
      <form class='addform' action='' method='post'>
        <a href='../index.php'>Вернуться</a>
        <h2>Редактировать статью</h2>
        <label for='heading'>Введите название статьи:</label><br>
        <input type='text' name='heading' value='{$result['heading']}' required><br>
        <label for='ad'>Введите анонс статьи:</label><br>
        <input type='text' name='ad' value='{$result['ad']}' required><br>
        <label for='about'>Введите содержание статьи:</label><br>
        <textarea name='about' rows='8' cols='80'>{$result['about']}</textarea><br>
        <button type='submit' name='button'>Редактировать</button>
      </form>
      ";

        if ($_POST) {
          $heading = $_POST['heading'];
          $ad =$_POST['ad'];
          $about =$_POST['about'];

          $request = "UPDATE ".$db_table." SET heading='$heading', ad='$ad', about='$about' WHERE id='$key'";
          $sql = mysqli_query($link, $request);

          if ($sql) {
            print_r("Операция выполнена успешно");
          } else {
            print_r("Что то пошло не так");
          }
        }
     ?>
  </body>
</html>
