<?php
include 'includes/conn.php';
if (!empty($_POST)) {
  $params = $_POST;
  $fieldStr = '';
  $dataStr = '';
  foreach ($params as $key => $value) {
    $fieldStr .= $key.',';
    $dataStr .= '"'.$value.'",';
  }
  $fieldStr = substr($fieldStr,0,-1);
  $dataStr = substr($dataStr,0,-1);

  $result = $mysqli->query("INSERT INTO orders ({$fieldStr}) VALUES({$dataStr})");
  $del_res = $mysqli->query('DELETE FROM cart where user_id='.$params['userid']);
  if ($result && $del_res) {
    echo "<script>alert('订单创建成功');window.location.href='orders.php';</script>";
  }else{
    echo "<script>alert('订单创建失败');window.location.href='orders_add.php';</script>";
  }
}

?>
