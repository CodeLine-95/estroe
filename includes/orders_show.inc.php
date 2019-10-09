<?php
/**
 * Created by PhpStorm.
 * User: qiaoshuai
 * Date: 2016/9/19
 * Time: 14:52
 */
//链接数据库
include_once 'conn.php';
if (!empty($_GET)){
    $user = json_decode($_COOKIE['user'],true);
    //查询订单信息
    $id = $_GET['id'];
    if (substr($id,0,2) == 'ZL') {
      $orders = find("select * from leases_orders where orderid='{$id}'",$mysqli);
      $goods = findAll("select * from lease where list_id in(".$orders['goodsid'].")",$mysqli);
    }elseif (substr($id,0,2) == 'IN') {
      $orders = find("select * from orders where orderid='{$id}'",$mysqli);
      $goods = findAll("select * from list where list_id in(".$orders['goodsid'].")",$mysqli);
    }
    $address = find("select * from adderss where add_id='{$orders['add_id']}'",$mysqli);
    $orders['goods'] = $goods;
    $orders['address'] = $address;
    //关闭链接
    $mysqli->close();
}
?>
