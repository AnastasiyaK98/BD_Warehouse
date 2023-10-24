<!DOCTYPE html>
<html>
<?php
$serverName = "DESKTOP-TF4F3AF";
$connectionInfo = array("Database" => "GoodsAccounting", "CharacterSet" => "UTF-8");
$conn = sqlsrv_connect($serverName, $connectionInfo);
if (!$conn) {
  exit('Подключение к БД отсутвует');
}
?>
<style>
  /* Окно 1 */
  content {
    background: url(grey-geometrical-shapes-background.jpg);
    background-attachment: fixed;
    background-size: 1700px 1000px;
    display: inline;
    width: 100%;
    height: 100%;
    position: fixed;
  }
  /* Окно 2 */
  okno {
    background: #F8F8FF;
    display: block;
    position: fixed;
    width: 90%;
    height: 90%;
    left: 5%;
    top: 5%;
  }
  /* Таблица 1 */
  .scroll-table table {
    width: 1350px;
    table-layout: fixed;
    font-family: 'Philosopher', sans-serif;
    margin-left: 18px;
    border-collapse: collapse;
    position: relative;
  }

  .scroll-table-body {
    
    overflow-x: auto;
    height: 250px;
    position: relative;
    margin-top: 0px;
    border-collapse: collapse;
  }

  .scroll-table tbody td {
    border: 1px solid #316650;
    padding: 3px 7px 2px 7px;
  }

  .scroll-table thead th {
    border: 1px solid #316650;
    padding: 3px 7px 2px 7px;
    text-align: left;
    padding: 5px;
    background-color: #5D9B9B;
    color: #fff;
  }

  .scroll-table tbody tr:hover {
    background-color: #7FB5B5
  }

  * {
    box-sizing: border-box;
  }

  /* Стили для скролла */
  ::-webkit-scrollbar {
    width: 6px;
  }

  ::-webkit-scrollbar-track {
    box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
  }

  ::-webkit-scrollbar-thumb {
    box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
  }
  /* Окно ввода и кнопки поиска */
  input[type=text],
  button[type=submit] {
    outline: none;
    background: transparent;
    
  }

  input[type=text] {
    min-width: 100%;
    
    height: 42px;
    padding-left: 15px;
    border: 3px solid #5D9B9B;
    font-family: 'Caveat', cursive;
    font-size: 30px;
  }

  button[type=submit] {
    border: none;
    height: 42px;
    width: 50px;
    position: absolute;
    top: 0;
    right: 0;
    cursor: pointer;
  }

  button[type=submit]:before {
    content: "\f002";
    font-family: FontAwesome;
    font-size: 16px;
    color: #5D9B9B;
  }

  input[type=text]:focus {
    border-color: #311c24;
  }

  input[type=image] {
    border: none;
    position: absolute;
    top: 0;
    left: 1300px;
    cursor: pointer;
  }
  /* Кнопка "Добавить" */
  .btn {
    width: 200px;
    position: fixed;
    top: 570px;
    cursor: pointer;
    font-size: 20px;
    line-height: 2;
    margin: 20px;
    text-align: center;
    font-family: 'Caveat', cursive;
    font-weight: 700;
  }

  .btn:hover,
  .btn:focus {
    color: #000;
    outline: 0;
  }

  .third {
    border-color: #5D9B9B;
    color: #000;
    box-shadow: 0 0 40px 40px #5D9B9B inset, 0 0 0 0 #5D9B9B;
    -webkit-transition: all 150ms ease-in-out;
    transition: all 150ms ease-in-out;
  }

  .third:hover {
    box-shadow: 0 0 10px 0 #5D9B9B inset, 0 0 10px 4px #5D9B9B;
  }

  /* Всплывающая форма-скрыта по умолчанию */
  .form-popup {
    display: none;
    position: fixed;
    bottom: 170px;
    right: 600px;
    border: 3px solid #f1f1f1;
    font-family: 'Philosopher', sans-serif;
    ;
  }

  /* Контейнер форм */
  .form-container {
    max-width: 300px;
    padding: 10px;
    background-color: white;
  }

  /* Поля ввода полной ширины */
  .form-container input[type=text] {
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    border: none;
    font-size: 20px;
    background: #f1f1f1;
  }

  /* Когда входы получают фокус-измнение цвета */
  .form-container input[type=text]:focus {
    background-color: #ddd;
    outline: none;
  }

/* Кнопки Добавить/Сохранить/Закрыть */
  .form-container .btn_dob {
    width: 100%;
    cursor: pointer;
    font-size: 20px;
    line-height: 2;
    text-align: center;
    font-family: 'Caveat', cursive;
    font-weight: 700;
    margin-bottom:10px;
    background-color: #20B2AA;
    opacity: 0.8;
  }
/* Кнопка закрыть */
  .form-container .close {
    background: #B32851;  
  }
  /* Эффект увеличения прозрачности наведения на кнопки */
  .form-container .btn_dob:hover {
    opacity: 1;
  }

  /*Уведомление*/
  .alert {
    position: fixed;
    padding: 20px;
    color: white;
    width: 350px;
    left: 670px;
    top: 170px;
  }
  .closebtn {
    margin-left: 15px;
    color: white;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
  }
  .closebtn:hover {
    color: black;
  }
</style>

<head>
  <meta charset="Cyrillic_General_CI_AS" name="viewport" content="width=device-width, initial-scale=1">
  <title>Учёт товаров на складе</title>
  <link rel="stylesheet" href="http://localhost/domains//css/font-awesome.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Caveat&family=Philosopher&display=swap" rel="stylesheet">
</head>

<body style="margin: 0">
  <content>
    <a href="http://localhost/domains/index.php"><img src="icons8-home-60.png" title="Вернуться на главную страницу"> </a>
    <okno>
      <div>
        <p style="width:100%; background:#5D9B9B; text-align: center;  text-transform: uppercase;  font-family: 'Caveat', cursive; font-size: 50px;"> <?php print $_REQUEST["tab"] ?></p>
      </div>
      <br>
      <br>
      <form action="http://localhost/domains/products.php?name=PRODUCTS&tab=Товары" method="POST" style="position: relative; width: 300px; height: 40px; margin: 10px auto; right:525px">
        <input type="text" name="poisk" autocomplete="off" placeholder="Поиск">
        <button type="submit"></button>
        <input type="image" src="icons8-доступные-обновления-40.png" id="clear" name="clear" title="Обновить таблицу" >
      </form>
      <!-- Удаление из базы -->
      <?php if (isset($_GET['del'])) {
        $id = $_GET['del'];
        $sql = "DELETE FROM $_REQUEST[name] WHERE Articul=$id";
        if (sqlsrv_query($conn, $sql)) { ?>
          <div class="alert" style="background-color: #89AC76">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">×</span>
            Удаление прошло успешно!
          </div>
        <?php } else { ?>
          <div class="alert" style=" background-color: #B03F35">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">×</span>
            Ошибка! Удаление не выполнено!
          </div>
        <?php }
      }
      /*Добавление в базу*/
      if (isset($_POST['dob'])) {
        $conn = sqlsrv_connect($serverName, $connectionInfo);
        $articul = $_POST['Articul'];
        $name = $_POST['Name'];
        $price = $_POST['Price'];
        $kol = $_POST['Kolichestvo'];
        $srock = $_POST['Srock'];
        $sql = "INSERT INTO $_REQUEST[name] (Articul, Name, Price, KolichestvoTons, SrockKhraneniya) VALUES ('{$articul}','{$name}','{$price}' ,'{$kol}','{$srock}' )";
        if (sqlsrv_query($conn, $sql)) { ?>
          <div class="alert" style="background-color: #89AC76">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">×</span>
            Добавление прошло успешно!
          </div>
        <?php  } else {  ?>
          <div class="alert" style=" background-color: #B03F35">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">×</span>
            Ошибка! Добавление не выполнено!
          </div>
      <?php }
      } ?>
      <!-- Печать таблицы -->
      <div class="scroll-table">
        <table>
          <!-- Печать названия столбцов -->
          <thead>
            <?php
            $sql =  "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$_REQUEST[name]' ORDER BY ORDINAL_POSITION";
            $result1 = sqlsrv_query($conn, $sql);
            print '<tr>';
            while (($row = sqlsrv_fetch_array($result1,  SQLSRV_FETCH_ASSOC))) {
              foreach ($row as $val) {
                print '<th >';
                print $val;
                print '</th >';
              }
            } ?>
            <th></th>
            </tr>
          </thead>
        </table>
        <div class="scroll-table-body">
          <table>
            <!-- Печать содержимого таблицы -->
            <tbody>
              <!-- Если выполнен поиск -->
              <?php if (!empty($_POST['poisk'])) {
               
                /*Поиск по всем столбцам*/
                $sql = "SELECT * FROM $_REQUEST[name] WHERE Articul LIKE '%$_POST[poisk]%' OR Name LIKE '%$_POST[poisk]%'
                OR Price LIKE '%$_POST[poisk]%' OR KolichestvoTons LIKE '%$_POST[poisk]%' OR 	SrockKhraneniya LIKE '%$_POST[poisk]%'";
                $result = sqlsrv_query($conn, $sql);
                if ($result != null) {
                  print '<tr>';
                  while ($row = sqlsrv_fetch_array($result,  SQLSRV_FETCH_ASSOC)) {              
                    foreach ($row as $val) {
                      print '<td>';
                      print $val;
                      print '</td>';
                    }
                    print '<td>';
                    print '<a href="http://localhost/domains/products.php?name=PRODUCTS&tab=Товары&del=' . $row['Articul'] . '"><img src="icons8-удалить-20.png" title="Удалить"></a>';
                    print("&nbsp &nbsp &nbsp");
                    print '<a href="http://localhost/domains/products.php?name=PRODUCTS&tab=Товары&red=' . $row['Articul'] . '" onclick="openForm(); return false;"><img src="icons8-редактировать-20.png" title="Редактировать"></a>';
                    print '</td>';
                    print '</tr>';
                  }
                }
                /*Если поиск не выполнен или нажата кнопка "Обновить таблицу"*/
              } elseif (empty($_POST['poisk']) or isset($_POST['clear_x'])) {
               
          
                $sql = "SELECT * FROM $_REQUEST[name]";
                $result = sqlsrv_query($conn, $sql);
                if ($result != null) {
                  print '<tr>';
                  while ($row = sqlsrv_fetch_array($result,  SQLSRV_FETCH_ASSOC)) {                  
                    foreach ($row as $val) {
                      print '<td>';
                      print $val;
                      print '</td>';
                    }
                    print '<td>';
                    print '<a href="http://localhost/domains/products.php?name=PRODUCTS&tab=Товары&del=' . $row['Articul'] . '"><img src="icons8-удалить-20.png" title="Удалить"></a>';
                    print("&nbsp &nbsp &nbsp");
                    print '<a  href="http://localhost/domains/products.php?name=PRODUCTS&tab=Товары&red=' . $row['Articul'] . '" onmouseout="openForm(); return false""><img src="icons8-редактировать-20.png" title="Редактировать"></a>';
                    print '</td>';
                    print '</tr>';
                  }
                }
              } else echo "Ошибка!";
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- Если нажата кнопка "Редактировать" -->
      <?php
      if (isset($_GET['red'])) {
        $id = $_GET['red'];
        $conn = sqlsrv_connect($serverName, $connectionInfo);
        $sql = "SELECT * FROM $_REQUEST[name] WHERE Articul=$id";
        $result = sqlsrv_query($conn, $sql);
        $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
        $articul = $row['Articul'];
        $name = $row['Name'];
        $price = $row['Price'];
        $kol = $row['KolichestvoTons'];
        $srock = $row['SrockKhraneniya'];
      ?>
        <!-- Форма для редактирования -->
        <div class="form-popup" id="myForm_">
          <form action="" method="post" class="form-container">
            <label for="Articul_"><b>Артикул</b></label>
            <input type="text" value="<?php echo ($articul) ?>" name="Articul_" required>
            <label for="Name_"><b>Название</b></label>
            <input type="text" value="<?php echo ($name) ?>" name="Name_" required>
            <label for="Price_"><b>Стоимость (руб)</b></label>
            <input type="text" name="Price_" value="<?php echo ($price) ?>" required>
            <label for="Kolichestvo_"><b>Количество (тонны)</b></label>
            <input type="text" value="<?php echo ($kol) ?>" name="Kolichestvo_" required>
            <label for="Srock_"><b>Срок хранения (дни)</b></label>
            <input type="text" value="<?php echo ($srock) ?>" name="Srock_" required>
            <input type="submit" class="btn_dob" name="soxr" value="Сохранить"></input>
            <button type="button" class="btn_dob close" onclick="closeForm()">Закрыть</button>
          </form>
        </div>
        <?php }
      /*Если нажата кнопка "Сохранить"*/
      if (isset($_POST['soxr'])) {
        $id = $_GET['red'];
        $conn = sqlsrv_connect($serverName, $connectionInfo);
        $articul_ = $_POST['Articul_'];
        $name_ = $_POST['Name_'];
        $price_ = $_POST['Price_'];
        $kol_ = $_POST['Kolichestvo_'];
        $srock_ = $_POST['Srock_'];
        $sql = "UPDATE $_REQUEST[name] SET Articul='{$articul_}', Name='{$name_}', Price='{$price_}', KolichestvoTons='{$kol_}', SrockKhraneniya='{$srock_}'WHERE Articul=$id ";
        /*Если изменение прошло успешно*/
        if (sqlsrv_query($conn, $sql)) {
        ?>
          <!-- Уведомление -->
          <div class="alert" style="background-color: #89AC76">
            <span class="closebtn" ; onclick=this.parentElement.style.display='none' ; ">×</span> 
            Редактирование прошло успешно! 
          </div>
          <?php
        } else {  ?>
            <div class=" alert" style=" background-color: #B03F35">
              <span class="closebtn" onclick="this.parentElement.style.display='none';">×</span>
              Ошибка! Редактирование не выполнено!
          </div>
      <?php }
      } ?>
      <!-- Форма для добавления      -->
      <button class="btn third" onclick="openForm_()">ДОБАВИТЬ</button>
      <div class="form-popup" id="myForm">
        <form action="" method="post" class="form-container">
          <label for="Articul"><b>Артикул</b></label>
          <input type="text" placeholder="Пример: 023457" name="Articul" required>
          <label for="Name"><b>Название</b></label>
          <input type="text" placeholder="Пример: Картофель" name="Name" required>
          <label for="Price"><b>Стоимость (руб)</b></label>
          <input type="text" placeholder="Пример: 36" name="Price" required>
          <label for="Kolichestvo"><b>Количество (тонны)</b></label>
          <input type="text" placeholder="Пример: 0.5" name="Kolichestvo" required>
          <label for="Srock"><b>Срок хранения (дни)</b></label>
          <input type="text" placeholder="Пример: 30" name="Srock" required>
          <input type="submit" class="btn_dob" name="dob" value="Добавить"></input>
          <button type="button" class="btn_dob close" onclick="closeForm_()">Закрыть</button>
        </form>
      </div>
      <!-- Функции открытия/закрытия формы редактирования элемента -->
      <script>
        function openForm() {
          document.getElementById("myForm_").style.display = "block";
        }

        function closeForm() {
          document.getElementById("myForm_").style.display = "none";
        }
      </script>
      <!-- Функции открытия/закрытия формы добавления элемента -->
      <script>
        function openForm_() {
          document.getElementById("myForm").style.display = "block";
        }

        function closeForm_() {
          document.getElementById("myForm").style.display = "none";
        }
      </script>
    </okno>
  </content>
</body>
</html>