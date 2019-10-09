<?php
include_once 'conn.php';
$user = json_decode($_COOKIE['user'],true);
$orders = findAll("select * from orders where userid = ".$user['user_id'],$mysqli);
foreach ($orders as $key => $s) {
  $goods = findAll("select * from list where list_id in(".$s['goodsid'].")",$mysqli);
  $orders[$key]['goods'] = $goods;
}
?>
