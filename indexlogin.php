<?php
/**
 * Created by PhpStorm.
 * User: qiaoshuai
 * Date: 2016/9/14
 * Time: 9:42
 */
session_start();
//调用mysqli
include_once 'includes/conn.php';
//接收数据
if (!empty($_POST)){
    $username = $_POST['username'];
    $userpwd = $_POST['password'];
    $userpwd = md5($userpwd);
    //正则验证
    if (!empty($username)&&!empty($userpwd)){
        $pwd = preg_match("/^.{6,}$/i",$userpwd);
        //验证密码
        if (!$pwd){
            echo "<script>alert('密码必须六位以上！');window.location='index.php';</script>";
        }
        //数据库验证
        $sql = "select user.*,user_rank.name user_rank_name,user_rank.rebate,user_rank.integral from user,user_rank where user.user_rank_id=user_rank.id and user.user_roleid != 3 and user_name = '{$username}'";
        // $sql = "select user_id from user where user_name='{$username}'";
        $result = $mysqli->query($sql);
        $one = $result->fetch_assoc();
        //用户名验证
        if (empty($one)){
            echo "<script>alert('没有此用户，请注册！');window.location='register.php';</script>";
        }else{
            //密码验证
            $sql .= "and user_pwd='{$userpwd}'";
            $result = $mysqli->query($sql);
            $one = $result->fetch_assoc();
            if(empty($one)){
                echo "<script>alert('密码输入错误！');window.location='index.php';</script>";
            }else{
                setcookie('user',json_encode($one),time()+7*24*3600);
                echo "<script>alert('登录成功！');window.location='index.php';</script>";
            }
        }
    }
}
$mysqli->close();
?>
