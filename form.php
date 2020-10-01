<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Form</title>
    <link rel="stylesheet/less" type="text/css" href="styles.less" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.9.0/less.min.js" ></script>
  </head>
  <body>
    <form class="addform" action="" method="post">
      <a href="index.php">Вернуться</a>
      <h2>Добавить новую статью</h2>
      <label for="heading">Введите название статьи:</label><br>
      <input type="text" name="heading" required><br>
      <label for="ad">Введите анонс статьи:</label><br>
      <input type="text" name="ad" value="Подробнее" required><br>
      <label for="about">Введите содержание статьи:</label><br>
      <textarea name="about" rows="8" cols="80"></textarea>
      <button type="submit" name="button">Добавить</button>
    </form>

    <?php
      if ($_POST) {
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

        $heading = $_POST['heading'];
        $ad =$_POST['ad'];
        $about =$_POST['about'];

        $request = "INSERT INTO ".$db_table." (heading, ad, about, imagesrc) VALUES ('$heading', '$ad', '$about', 'news.png')";
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
