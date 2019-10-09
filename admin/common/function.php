<?php
/*
* 判断是否POST请求
*/
function isPost(){
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    return true;
  }
  return false;
}
/*
* 判断是否GET请求
*/
function isGet(){
  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    return true;
  }
  return false;
}

?>
