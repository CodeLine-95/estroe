<?php
include '../common/admin.inc.php';
include '../common/function.php';
if ($_GET['act']=='del'){
  $id = $_GET['id'];
  $sql = 'DELETE FROM leases_orders where orderid="'.$id.'"';
  $result = $mysqli->query($sql);
  if ($result) {
    echo "<script>alert('删除成功');window.location.href='/admin/orders/leaseOrders.php';</script>";
  }else{
    echo "<script>alert('删除失败');window.location.href='/admin/orders/leaseOrders.php';</script>";
  }
}else{
  echo "<script>alert('请求缺少act参数');window.history.back();</script>";
}
?>
