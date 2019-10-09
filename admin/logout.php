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
    if (!empty($_COOKIE['admin'])){
        setcookie('admin',$_COOKIE['admin'],time()-1);
    }
    echo "<script>alert('退出成功！');window.location='/admin/index.php';</script>";
}
?>
