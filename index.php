<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet/less" type="text/css" href="styles.less" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.9.0/less.min.js" ></script>
  </head>
  <body>
    <header>
      <div class="container">
        <section class="authorization">
          <p id="username" onclick="setUser()"></p>
          <input id="nameinput" type="text" name="name" placeholder="Введите ваше имя:">
          <input id="addform" type="button" name="" value="+" onclick="formLocation()">
        </section>
      </div>
    </header>
    <main>
      <div class="container">
        <section class="news">
          <?php
            $host = 'localhost';
            $user = 'root';
            $pass = '';
            $db_name = 'testdb';
            $link = mysqli_connect($host, $user, $pass, $db_name);

            if (!$link) {
            echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
            exit;
            }

            $limit = 5;
            $offset = isset($_GET['page']) ? $_GET['page'] : 1;
            $page = $limit * ($offset - 1);
            $request = 'SELECT * FROM `news` LIMIT '.$limit.' OFFSET '.($page);
            $sql = mysqli_query($link, $request);

            while ($result = mysqli_fetch_array($sql)) {
            echo "<article class='news-item'>
                    <img class='news-item__img' src='{$result['imagesrc']}' alt='image'>
                    <div class='news-item__content'>
                      <h2>{$result['heading']}</h2>
                      <p class='news-item__date'></p>
                      <details><summary>{$result['ad']}</summary>{$result['about']}</details>
                      <div class='news-item__interface'>
                        <button onclick='deleteItem({$result['id']})'>Удалить</button>
                        <button onclick='editItem({$result['id']})'>Редактировать</button>
                      </div>
                    </div>
                    <hr>
                  </article>";
          };

          mysqli_close($link);
          ?>
        </section>

        <ul class="pagination">
          <?php
          $host = 'localhost';
          $user = 'root';
          $pass = '';
          $db_name = 'testdb';
          $link = mysqli_connect($host, $user, $pass, $db_name);

          if (!$link) {
          echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
          exit;
          }

          $request = 'SELECT COUNT(*) FROM news';
          $sql = mysqli_query($link, $request);
          $count = mysqli_fetch_row($sql);

          if ($count >= 6) {
            PaginationDetecter($count[0]);
          }

          function PaginationDetecter($value)
          {
            $pages = $value / 5;
            for ($i=1; $i <= $pages; $i++) {
              echo "
              <li class='pagination-item'><a href='?page={$i}'>{$i}</a></li>
              ";
            }
          }
          mysqli_close($link);
           ?>
        </ul>
      </div>
    </main>
    <script src="script.js"></script>
  </body>
</html>
