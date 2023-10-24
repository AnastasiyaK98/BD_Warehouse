<!DOCTYPE html>
<html>
  <!-- Подключение к базе -->
<?php
$serverName = "DESKTOP-TF4F3AF";
$connectionInfo = array("Database" => "GoodsAccounting", "CharacterSet" => "UTF-8");
$conn = sqlsrv_connect($serverName, $connectionInfo);
if (!$conn) {
  exit('Подключение к БД отсутвует');
}
?>
<style>
  /* Окно */
  content {
    background: url(grey-geometrical-shapes-background.jpg);
    background-attachment: fixed;
    background-size: 100% 100%;
    display: inline;
    width: 100%;
    height: 100%;
    position: fixed;
  }
/* Кнопки */
  .btn {
    position: relative;
    display: table;
    float: left;
    color: white;
    font-size: 14px;
    font-family: 'Caveat', cursive;
    font-size: large;
    text-decoration: none;
    margin: 30px 4px;
    border: 2px solid #5D9B9B;
    padding: 14px 60px;
    top: -80%;
    left: 2%;
    text-transform: uppercase;
    overflow: hidden;
    transition: 1s all ease;
  }

  .btn::before {
    background: #5D9B9B;
    content: "";
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: -1;
    transition: all 0.6s ease;
  }

  /*Ползунок цветной */
  .btn1::before {
    width: 0%;
    height: 100%;
  }

  .btn1:hover::before {
    width: 100%;
  }
</style>

<head>
  <meta charset="utf8">
  <title>Учёт товаров на складе</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Caveat&display=swap" rel="stylesheet">
</head>

<body style="margin: 0">
  <content>
    <div class="middle">
      <a href='http://localhost/domains/products.php?name=PRODUCTS&tab=ТОВАРЫ' class="btn btn1"> Тoвары </a>
      <a href='http://localhost/domains/stocks.php?name=STOCKS&tab=СКЛАДЫ' class="btn btn1">Склады</a>
      <a href='http://localhost/domains/cars.php?name=CARS&tab=МАШИНЫ' class="btn btn1">Машины</a>
      <a href='http://localhost/domains/supply.php?name=SUPPLY&tab=ПОСТАВКИ' class="btn btn1">Поставки</a>
      <a href='http://localhost/domains/orders.php?name=ORDERS&tab=ЗАКАЗЫ' class="btn btn1">Заказы</a>
      <a href='http://localhost/domains/shipments.php?name=SHIPMENTS&tab=ОТГРУЗКИ' class="btn btn1">Отгрузки</a>
      <a href='http://localhost/domains/spisan.php?name=DECOMMISSIONED&tab=СПИСАНО' class="btn btn1">Списанный товар</a>
    </div>
    <br><br><br><br><br>
    <div style="margin-top: 10%; width:100%; text-align:center; font-family:  'Caveat', cursive;color:#FFFFFF; font-weight: 900; font-stretch: expanded; font-style: normal; font-size: 870%"> Учёт товаров на складе </div>
    <br><br><br><br>
  </content>
</body>

</html>