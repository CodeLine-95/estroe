<?php
include_once 'conn.php';
$user = json_decode($_COOKIE['user'],true);

//商品订单
$orders = findAll("select * from orders where userid = ".$user['user_id'].' order by createtime desc',$mysqli);
foreach ($orders as $key => $s) {
  $goods = findAll("select * from list where list_id in(".$s['goodsid'].")",$mysqli);
  $orders[$key]['goods'] = $goods;
}

//租赁订单
$leases_orders = findAll("select * from leases_orders where userid = ".$user['user_id'].' order by createtime desc',$mysqli);
foreach ($leases_orders as $k => $l) {
  $lease_goods = findAll("select * from lease where list_id in(".$l['goodsid'].")",$mysqli);
  $leases_orders[$k]['goods'] = $lease_goods;
}

?>
