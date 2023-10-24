<!DOCTYPE html>
<html>
<?php
$serverName = "DESKTOP-TF4F3AF";
$connectionInfo = array("Database" => "GoodsAccounting", "CharacterSet" => "UTF-8",'ReturnDatesAsStrings'=> true);
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
  /* Всплывающая форма-скрыта по умолчанию */
  .form-popup {
    display: none;
    position: fixed;
    bottom: 50px;
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
    margin-top:10px;
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
    <?php $IDS=$_REQUEST['ids'];?>
      <div>
        <p style="width:100%; background:#5D9B9B; text-align: center;  text-transform: uppercase;  font-family: 'Caveat', cursive; font-size: 50px;">Товары на складе</p>
      </div>
      <br>
      <br>
      <form href="" method="POST" style="position: relative; width: 300px; height: 60px; margin: 10px auto; right:525px">
        <input type="text" name="poisk" autocomplete="off" placeholder="Поиск">
        <button type="submit"></button>
        <input type="image" src="icons8-доступные-обновления-40.png" id="clear" name="clear" title="Обновить таблицу">   
      </form>     
     
         <!-- Удаление из базы/Списание -->
         <?php if (isset($_GET['idt'])) {
        $id = $_GET['idt'];
        $sql= "INSERT INTO DECOMMISSIONED (Articul, KolichestvoTons)
        SELECT Articul, KolichestvoTons FROM TovarSklad WHERE IDT=$id";
        sqlsrv_query($conn, $sql);
        $sql="DELETE FROM $_REQUEST[name] WHERE IDT=$id";
        sqlsrv_query($conn, $sql);
         }
        ?>
 <!-- Удаление из базы -->
 <?php if (isset($_GET['del'])) {
        $id = $_GET['del'];
        $sql = "DELETE FROM $_REQUEST[name] WHERE IDT=$id";
        sqlsrv_query($conn, $sql);
      }
 ?>
          
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
                $sql = "SELECT * FROM $_REQUEST[name] WHERE IDT LIKE '%$_POST[poisk]%' OR IDS LIKE '%$_POST[poisk]%'OR IDP LIKE '%$_POST[poisk]%'
                OR Articul LIKE '%$_POST[poisk]%'  OR KolichestvoTons LIKE '%$_POST[poisk]%' OR VremyaKhraneniya LIKE '%$_POST[poisk]%'OR DatePos LIKE '%$_POST[poisk]%'";
                $result = sqlsrv_query($conn, $sql);
                if ($result != null) {
                  print '<tr>';
                  while ($row = sqlsrv_fetch_array($result,  SQLSRV_FETCH_ASSOC)) {
                    $sql1="UPDATE $_REQUEST[name] SET VremyaKhraneniya=VremyaKhraneniya WHERE IDT=$row[IDT]";
                    sqlsrv_query($conn, $sql1);    
                    foreach ($row as $val) {
                      print '<td>';
                      print $val;
                      print '</td>';
                    }    
                    print '<td>';              
                    print '<a href="http://localhost/domains/TovarSklad.php?name=TovarSklad&tab=Товары&ids='.$IDS.'&del=' . $row['IDT'] . '"><img src="icons8-удалить-20.png" title="Удалить"></a>';
                    print("&nbsp &nbsp &nbsp");
                    print '<a href="http://localhost/domains/TovarSklad.php?name=TovarSklad&tab=Товары&ids='.$IDS.'&red=' . $row['IDT'] .'" onclick="openForm(); return false;"><img src="icons8-редактировать-20.png" title="Редактировать"></a>';   
                    print("&nbsp &nbsp &nbsp");
                    $s=$row['VremyaKhraneniya'];               
                    $srock= "SELECT SrockKhraneniya FROM PRODUCTS WHERE Articul=$row[Articul]";  
                    $result_ = sqlsrv_query($conn, $srock);
                    if ($result_ != null) 
                      $row_ = sqlsrv_fetch_array($result_,  SQLSRV_FETCH_ASSOC);                                                   
                    if($s>=$row_['SrockKhraneniya'])     {                             
                      print '<a href="http://localhost/domains/TovarSklad.php?name=TovarSklad&tab=Товары&ids='.$IDS.'&idt=' . $row['IDT'] . '" style=color:#000>Списать</a>';
                    }                      
                    print '</td>';                                                      
                    print '</tr>';
                  }
                }
                /*Если поиск не выполнен или нажата кнопка "Обновить таблицу"*/
              } elseif (empty($_POST['poisk']) or isset($_POST['clear_x'])) {  
                $IDS=$_REQUEST['ids'];        
                $sql = "SELECT * FROM $_REQUEST[name] WHERE IDS=$IDS";              
                $result = sqlsrv_query($conn, $sql);
                if ($result != null) {
                  print '<tr>';
                  
                  while ($row = sqlsrv_fetch_array($result,  SQLSRV_FETCH_ASSOC)) { 
                    $sql1="UPDATE $_REQUEST[name] SET VremyaKhraneniya=VremyaKhraneniya WHERE IDT=$row[IDT]";
                    sqlsrv_query($conn, $sql1);                       
                    foreach ($row as $val) {
                      
                      print '<td>';                                      
                      print $val;
                      print '</td>';
                    }     
                    print '<td>';
                    $IDS=$_REQUEST['ids'];
                    print '<a href="http://localhost/domains/TovarSklad.php?name=TovarSklad&tab=Товары&ids='.$IDS.'&del=' . $row['IDT'] . '"><img src="icons8-удалить-20.png" title="Удалить"></a>';
                    print("&nbsp &nbsp &nbsp");
                    print '<a href="http://localhost/domains/TovarSklad.php?name=TovarSklad&tab=Товары&ids='.$IDS.'&red=' . $row['IDT'] .'" onclick="openForm(); return false;"><img src="icons8-редактировать-20.png" title="Редактировать"></a>';   
                    print("&nbsp &nbsp &nbsp");
                    $s=$row['VremyaKhraneniya'];               
                    $srock= "SELECT SrockKhraneniya FROM PRODUCTS WHERE Articul=$row[Articul]";  
                    $result_ = sqlsrv_query($conn, $srock);
                    if ($result_ != null) 
                      $row_ = sqlsrv_fetch_array($result_,  SQLSRV_FETCH_ASSOC);                                                   
                    if($s>=$row_['SrockKhraneniya'])     {  
                      $IDS=$_REQUEST['ids'];                  
                      print '<a href="http://localhost/domains/TovarSklad.php?name=TovarSklad&tab=Товары&ids='.$IDS.'&idt=' . $row['IDT'] . '" style=color:#000>Списать</a>';
                    }                      
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
        $sql = "SELECT * FROM $_REQUEST[name] WHERE IDT=$id";
        $result = sqlsrv_query($conn, $sql);
        $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);                  
        $kol= $row['KolichestvoTons'];
        $vremya = $row['VremyaKhraneniya'];      
        $date = $row['DatePos'];  
      ?>
        <!-- Форма для редактирования -->
        <div class="form-popup" id="myForm_">
          <form action="" method="post" class="form-container" id="myForm_">          
            <label for="KolichestvoTons_"><b>Количество (тонны)</b></label>
            <input type="text" value="<?php echo ($kol) ?>" name="KolichestvoTons_" required>
            <label for="VremyaKhraneniya_"><b>Время хранения (месяцы)</b></label>
            <input type="text" name="VremyaKhraneniya_" value="<?php echo ($vremya) ?>" required>
            <label for="DatePos_"><b>Дата поступления</b></label>
            <input type="text" name="DatePos_" value="<?php echo ($date) ?>" required>
            <input type="submit" class="btn_dob" name="soxr" value="Сохранить"></input>
            <button type="button" class="btn_dob close" onclick="closeForm()">Закрыть</button>
          </form>
        </div>
        <?php }
      /*Если нажата кнопка "Сохранить"*/
      if (isset($_POST['soxr'])) {
        $id = $_GET['red'];
        $conn = sqlsrv_connect($serverName, $connectionInfo);    
        $kol_= $_POST['KolichestvoTons_'];
        $vremya_ =$_POST['VremyaKhraneniya_'];   
        $date_ =$_POST['DatePos_'];          
        $sql = "UPDATE $_REQUEST[name] SET KolichestvoTons='{$kol_}', 
       VremyaKhraneniya='{$vremya_}',  DatePos='{$date_}' WHERE IDT=$id ";
        /*Если изменение прошло успешно*/
        sqlsrv_query($conn, $sql);
      }
    ?>
     <!-- Функции открытия/закрытия формы редактирования элемента -->
     <script>
        function openForm() {
          document.getElementById("myForm_").style.display = "block";
        }

        function closeForm() {
          document.getElementById("myForm_").style.display = "none";
        }
        </script>
    </okno>
  </content>
</body>
</html>