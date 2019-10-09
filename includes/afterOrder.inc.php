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
    $act = $_GET['act'];
    //查询商品信息
    $id = $_GET['id'];
    //订单人信息
    $add = $mysqli->query("select add_id,add_name,add_derss,add_tel,add_email from adderss WHERE user_id={$user['user_id']} order by add_time desc limit 1");
    if ($add){
        while ($users = $add->fetch_assoc()){
            $user_arr = $users;
        }
    }
    switch ($act) {
      case 'leases':
        $form_url = 'leaseOrder_add.php';
        $obj = $mysqli->query("select user_id from user where user_name='{$user["user_name"]}'");
        if ($obj){
            while ($arr = $obj->fetch_assoc()){
                $one_arr = $arr;
            }
        }
        $add = $mysqli->query("select * from adderss where user_id = ".$one_arr['user_id']);
        if ($add){
            while ($arr = $add->fetch_assoc()){
                $add_arr = $arr;
            }
        }
        if (!empty($_POST)) {
          $nums = $_POST['buycount'];
        }else{
          $nums = 1;
        }
        $leases_obj = $mysqli->query("select * from lease where list_id = ".$id);
        if ($leases_obj) {
            $lease_arr = $leases_obj->fetch_assoc();
        }
        $price = $lease_arr['deposit']+$user['rebate']*$lease_arr['list_myprice'];
        //判断商品是否存在
        $user_res =$mysqli->query("select list_id from cart where list_id={$id} and user_id={$one_arr['user_id']}");
        $ones = $user_res->fetch_assoc();
        if (empty($ones)){
          $insert = $mysqli->query("insert into cart(user_id,list_id,buy_num,buy_price,status,is_lease,add_id) VALUES ({$one_arr['user_id']},{$id},{$nums},'{$price}',0,1,{$add_arr['add_id']})");
        }

        $sql = "select lease.*,cart.buy_num,cart.buy_price*cart.buy_num nums from lease,cart where lease.list_id=cart.list_id and is_lease = 1 and cart.list_id={$id} and cart.user_id={$user['user_id']}";
        // var_dump($sql);die;
        $res = $mysqli->query($sql);
        if ($res){
            $arr = array();
            while ($one = $res->fetch_assoc()){
                $one['list_myprice'] = $user['rebate']*$one['list_myprice'];
                $arr[] = $one;
            }
        }
        //商品金额计算
        $sum = $mysqli->query("select cart.buy_price sum,lease.list_onprice sums from lease,cart where cart.list_id = lease.list_id and  cart.list_id={$id} and cart.is_lease = 1 and cart.user_id={$user['user_id']}");
        if ($sum){
            $ones = $sum->fetch_assoc();
        }
        $order_arr = [];
        $buy_num_count = 0;
        $goodsid = '';
        foreach ($arr as $key => $value) {
          $buy_num_count = $buy_num_count+$value['buy_num'];
          $goodsid .= $value['list_id'].',';
        }
        $goodsid = substr($goodsid,0,-1);
        $order_arr['orderid'] = 'ZL'.date('YmdHis',time()).rand(1000,9999);
        $order_arr['beforetotalprice'] = $ones['sums'];
        $order_arr['aftertotalprice'] = $ones['sum'];
        $order_arr['buycount'] = $buy_num_count;
        $order_arr['createtime'] = date('Y-m-d H:i:s',time());
        $order_arr['userid'] = $user['user_id'];
        $order_arr['goodsid'] = $goodsid;
        $order_arr['add_id'] = $user_arr['add_id'];
        $order_arr['lease_time'] = $arr[0]['lease_time'];
        $order_arr['deposit'] = $arr[0]['deposit'];

        break;
      case 'goods':
        $form_url = 'order_add.php';
        $sql = "select list.*,cart.buy_num,cart.buy_price*cart.buy_num nums from list,cart where list.list_id=cart.list_id and cart.user_id={$id}";
        $res = $mysqli->query($sql);
        if ($res){
            $arr = array();
            while ($one = $res->fetch_assoc()){
                $one['list_myprice'] = $user['rebate']*$one['list_myprice'];
                $arr[] = $one;
            }
        }
        //商品金额计算
        $sum = $mysqli->query("select sum(cart.buy_price*cart.buy_num) sum,sum(list.list_onprice*cart.buy_num) sums from list,cart where list.list_id=cart.list_id and cart.user_id=(select user_id from user where user_name='{$user['user_name']}')");
        if ($sum){
            $ones = $sum->fetch_assoc();
        }
        $order_arr = [];
        $buy_num_count = 0;
        $goodsid = '';
        foreach ($arr as $key => $value) {
          $buy_num_count = $buy_num_count+$value['buy_num'];
          $goodsid .= $value['list_id'].',';
        }
        $goodsid = substr($goodsid,0,-1);
        $order_arr['orderid'] = 'IN'.date('YmdHis',time()).rand(1000,9999);
        $order_arr['beforetotalprice'] = $ones['sums'];
        $order_arr['aftertotalprice'] = $ones['sum'];
        $order_arr['buycount'] = $buy_num_count;
        $order_arr['createtime'] = date('Y-m-d H:i:s',time());
        $order_arr['userid'] = $id;
        $order_arr['goodsid'] = $goodsid;
        $order_arr['add_id'] = $user_arr['add_id'];
        break;
    }
}
//关闭链接
$mysqli->close();
?>
