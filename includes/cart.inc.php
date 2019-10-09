<?php
if(!empty($_COOKIE['user'])){
    $user = json_decode($_COOKIE['user'],true);
    //打开mysqli
    include_once 'conn.php';
    if (!empty($_GET)){
        $act = $_GET['act'];
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
        switch ($act){
            //加入购物车操作
            case 'insert':
            	if (empty($add_arr)) {
		        	echo "<script>alert('请填写收货地址后再添加！');window.location='order.php';</script>";die;
		        }
                $id = $_GET['id'];
                $type = $_GET['type'];
                switch ($type) {
                  case 'lease':
                    $leases_obj = $mysqli->query("select * from lease where list_id = ".$id);
                    if ($leases_obj) {
                        $lease_arr = $leases_obj->fetch_assoc();
                    }
                    $price = $lease_arr['deposit']+$user['rebate']*$lease_arr['list_myprice'];
                    //判断商品是否存在
                    $user =$mysqli->query("select list_id from cart where list_id={$id} and user_id={$one_arr['user_id']}");
                    $ones = $user->fetch_assoc();
                    if (!empty($ones)){
                        echo "<script>alert('该商品已经加入过购物车！');window.location='cart.php?act=show';</script>";
                    }else{
                        $insert = $mysqli->query("insert into cart(user_id,list_id,buy_num,buy_price,status,is_lease,add_id) VALUES ({$one_arr['user_id']},{$id},{$nums},'{$price}',0,1,{$add_arr['add_id']})");
                        if ($insert){
                            echo "<script>alert('加入购物车成功！');window.location='cart.php?act=show';</script>";
                        }
                    }
                    break;

                  case 'list':
                    $lists_obj = $mysqli->query("select * from list where list_id = ".$id);
                    if ($lists_obj) {
                        $list_arr = $lists_obj->fetch_assoc();
                    }
                    $price = $list_arr['list_myprice']*$user['rebate'];
                    //判断商品是否存在
                    $user =$mysqli->query("select list_id from cart where list_id={$id} and user_id={$one_arr['user_id']}");
                    $ones = $user->fetch_assoc();
                    if (!empty($ones)){
                        echo "<script>alert('该商品已经加入过购物车！');window.location='cart.php?act=show';</script>";
                    }else{
                        $insert = $mysqli->query("insert into cart(user_id,list_id,buy_num,buy_price,status,add_id) VALUES ({$one_arr['user_id']},{$id},{$nums},'{$price}',0,{$add_arr['add_id']})");
                        if ($insert){
                            echo "<script>alert('加入购物车成功！');window.location='cart.php?act=show';</script>";
                        }
                    }
                    break;
                }
                break;
            //查看购物车操作
            case 'show':
                $user = $mysqli->query("select user_id from user where user_name='{$user["user_name"]}'");
                if ($user){
                    while ($user_one = $user->fetch_assoc()){
                        $user_arr = $user_one;
                    }
                }
                $sql = "select list.*,cart.order_id,cart.buy_price,cart.buy_num,cart.buy_price*cart.buy_num nums from list,cart where list.list_id=cart.list_id and cart.is_lease=0 and cart.user_id={$user_arr['user_id']}";
                $res = $mysqli->query($sql);
                if ($res){
                    $two = array();
                    while ($one = $res->fetch_assoc()){
                        $two[] = $one;
                    }
                }

                $sum = $mysqli->query("select sum(cart.buy_price*cart.buy_num) sum,sum(list.list_onprice*cart.buy_num) sums from list,cart where list.list_id=cart.list_id and cart.is_lease=0 and cart.user_id={$user_arr['user_id']}");
                if ($sum){
                    while ($one_arr = $sum->fetch_assoc()){
                        $ones[] = $one_arr;
                    }
                }
                break;
            //删除商品操作
            case 'delete':
                $id = $_GET['gid'];
                $sql = "delete from cart WHERE order_id={$id}";
                $res = $mysqli->query($sql);
                if ($res) {
                    echo "<script>alert('删除成功');location.href='cart.php?act=show';</script>";
                }else{
                    echo "<script>alert('删除失败');location.href='cart.php?act=show';</script>";
                }
                break;
            case 'update':
                foreach ($_POST as $key=>$value){
                    $res = $mysqli->query("update cart set buy_num={$value} where order_id={$key}");
                    if ($res){
                        echo "<script>alert('更新成功！');window.location='../cart.php?act=show';</script>";
                    }
                }
                break;
            //清空购物车操作
            case 'truncate':
                if (!empty($_POST)){
                    $act = $_POST['act'];
                    $truncate = $mysqli->query("delete from cart where user_id=(select user_id from user where user_name='{$user["user_name"]}')");
                    if ($truncate){
                        echo "<script>alert('已经清空！');window.location='../cart.php?act=show';</script>";
                    }
                }
                break;
        }
    }
    //关闭数据库
    $mysqli->close();
}else{
    echo "<script>alert('请登录后才能进入！');window.location='index.php';</script>";
}
?>
