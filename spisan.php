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
    width: 100%;
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
      <form action="http://localhost/domains/spisan.php?name=DECOMMISSIONED&tab=СПИСАНО" method="POST" style="position: relative; width: 300px; height: 40px; margin: 10px auto; right:525px">
        <input type="text" name="poisk" autocomplete="off" placeholder="Поиск">
        <button type="submit"></button>
        <input type="image" src="icons8-доступные-обновления-40.png" id="clear" name="clear" title="Обновить таблицу" >
      </form>
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
                print $val . " ";
                print '</th >';
              }
            } ?>        
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
                $sql = "SELECT * FROM $_REQUEST[name] WHERE ID LIKE '%$_POST[poisk]%' OR Articul LIKE '%$_POST[poisk]%' 
             OR KolichestvoTons LIKE '%$_POST[poisk]%'";
                $result = sqlsrv_query($conn, $sql);
                if ($result != null) {
                  print '<tr>';
                  while ($row = sqlsrv_fetch_array($result,  SQLSRV_FETCH_ASSOC)) {
                    foreach ($row as $val) {
                      print '<td>';
                      print $val;
                      print '</td>';
                    }                  
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
                    print '</tr>';
                  }
                }
              } else echo "Ошибка!";
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </okno>
  </content>
</body>
</html>