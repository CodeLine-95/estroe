<?php
/**
 * Created by PhpStorm.
 * User: qiaoshuai
 * Date: 2016/9/13
 * Time: 9:01
 */
//注销登录
header('content-type:text/html;charset=utf-8');
//判断数据是否存在
if (isset($_GET['act'])){
    //判断$_COOKIE是否有值
    if (!empty($_COOKIE['user'])){
        setcookie('user',NULL);
    }
    echo "<script>alert('注销成功！');window.location='index.php';</script>";
}
?>
