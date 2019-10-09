<?php
include_once 'conn.php';
if(!empty($_COOKIE['user'])){
  $user = json_decode($_COOKIE['user'],true);
  $mysqli->query('DELETE FROM cart where is_lease=1 and user_id='.$user['user_id']);
}
//接收数据
if (!empty($_GET['act'])){
    $act = $_GET['act'];
    switch ($act){
        case 'leaselist':
            $res_obj = $mysqli->query("select * from lease order by list_time desc");
            //商品展示
            if($res_obj){
                $two_arr = array();
                while ($one_arr = $res_obj->fetch_assoc()){
                    $two_arr[] = $one_arr;
                }
            }
            break;
    }
}
//关闭mysqli
$mysqli->close();
?>
