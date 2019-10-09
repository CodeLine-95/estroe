<?php
include_once 'conn.php';
//接收数据
if (!empty($_GET['act'])){
    $act = $_GET['act'];
    switch ($act){
        case 'listgoods':
            $id = $_GET['cateid'];
            //商品展示
            $res_obj = $mysqli->query("select list_id,list_name,list_face,list_onprice,list_myprice,list_nums from list WHERE small_id={$id}");
            if ($res_obj){
                $two_arr = array();
                while ($one_arr = $res_obj->fetch_assoc()){
                    $two_arr[] = $one_arr;
                }
            }
            break;
        case 'goodslist':
            $id = $_GET['cateid'];
            if ($id) {
              $res_obj = $mysqli->query("select list.list_id,list.list_name,list.list_face,list.list_onprice,list.list_myprice,list.list_nums from list,smalltype s,bigtype b WHERE list.small_id=s.small_id and s.big_id=b.big_id and b.big_id={$id}");
            }else{
              $res_obj = $mysqli->query("select list.list_id,list.list_name,list.list_face,list.list_onprice,list.list_myprice,list.list_nums from list,smalltype s,bigtype b WHERE list.small_id=s.small_id and s.big_id=b.big_id");
            }
            //商品展示
            if($res_obj){
                $two_arr = array();
                while ($one_arr = $res_obj->fetch_assoc()){
                    $two_arr[] = $one_arr;
                }
            }
    }
}
//关闭mysqli
$mysqli->close();
?>
