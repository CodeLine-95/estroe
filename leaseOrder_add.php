<?php
include 'includes/conn.php';
if (!empty($_POST)) {
  $params = $_POST;
  $fieldStr = '';
  $dataStr = '';
  $params['status'] = 2;
  $time = time();
  $lease_time = $params['lease_time']*86400;
  $endtime = $time+$lease_time;
  $params['leasetime'] = date('Y-m-d H:i:s',$time);
  $params['starttime'] = date('Y-m-d H:i:s',$time);
  $params['endtime'] = date('Y-m-d H:i:s',$endtime);
  // $params['aftertotalprice'] = $params['deposit'];
  $params['lease_days'] = $params['lease_time'];
  unset($params['lease_time']);
  unset($params['deposit']);
  foreach ($params as $key => $value) {
    $fieldStr .= $key.',';
    $dataStr .= '"'.$value.'",';
  }
  $fieldStr = substr($fieldStr,0,-1);
  $dataStr = substr($dataStr,0,-1);
  $sql = "INSERT INTO leases_orders ({$fieldStr}) VALUES({$dataStr})";
  $del_res = $mysqli->query('DELETE FROM cart where user_id='.$params['userid']);
  $result = $mysqli->query($sql);
  if ($result && $del_res) {
    echo "<script>alert('租赁订单创建成功');window.location.href='orders.php';</script>";
  }else{
    echo "<script>alert('租赁订单创建失败');window.location.href='leaseOrders_add.php';</script>";
  }
}

?>
