<?php
/**
 * Created by PhpStorm.
 * User: qiaoshuai
 * Date: 2016/9/12
 * Time: 18:10
 */
header('content-type:text/html;charset=utf-8');
//建立MySQLi链接
$mysqli = new mysqli('127.0.0.1','estroe_im','5DEzc3p3fX6TyKRz','estroe_im');
//得到链接产生的错误信息
if ($mysqli->connect_errno){
    die("错误信息：".$mysqli->connect_error);
}
//设置数据库的字符编码
$mysqli->set_charset('utf8');

function findAll($sql,$mysqli){
  $result = $mysqli->query($sql);
  $twos = array();
  if ($result){
  	while ($ones = $result->fetch_assoc()){
  		$twos[] = $ones;
  	}
  }
  return $twos;
}

?>
