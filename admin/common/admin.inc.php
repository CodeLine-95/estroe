<?php
include_once 'conn.php';
if(empty($_COOKIE['admin']) || $_COOKIE['admin'] == 'MULL'){
  echo '<script>alert("您未登录！请登录再试！");window.location="login.php?act=login";</script>';die;
}
$admin = json_decode($_COOKIE['admin'],true);
?>
