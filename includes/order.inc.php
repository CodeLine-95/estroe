<?php
/**
 * Created by PhpStorm.
 * User: qiaoshuai
 * Date: 2016/9/19
 * Time: 10:32
 */
session_start();
include_once 'conn.php';
if (!empty($_POST)){
    $act = $_POST['act'];
    $username = trim($_POST['username']);
    $useraddr = trim($_POST['useraddr']);
    $userphone = trim($_POST['userphone']);
    $email = trim($_POST['email']);
    $time = date("Y/m/d H:i:s");
    $user = json_decode($_COOKIE['user'],true);
    var_dump($user['user_id']);
    switch ($act){
        case 'addorder':
            if (!empty($username)&&!empty($useraddr)&&!empty($userphone)){
                $phone = preg_match("/^[1][0-9]{10}$/",$userphone);
                if (!$phone){
                    echo "<script>alert('电话必须是11位的纯数字！');window.location='../order.php?act=writeOrder';</script>";
                }
                if (!empty($email)){
                    $bool = preg_match("/^\w+@\w+(\.com||\.cn)$/i",$email);
                    if (!$bool){
                        echo "<script>alert('邮箱格式不正确！');window.location='../order.php?act=writeOrder';</script>";
                    }
                }
                $sql = "insert into adderss(add_name,add_derss,add_tel,add_email,user_id,add_time) VALUES ('{$username}','{$useraddr}','{$userphone}','{$email}','".$user["user_id"]."','{$time}')";
                $add = $mysqli->query($sql);
                if ($add){
                    echo "<script>alert('填写收货地址成功！');window.history.back();</script>";
                }
            }
            break;
    }
}
//关闭数据库
$mysqli->close();
?>
