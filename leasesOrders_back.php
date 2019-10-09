<?php
include_once 'includes/conn.php';
$id = $_GET['id'];

$sql = 'update leases_orders set backtime = "'.date('Y-m-d H:i:s',time()).'" where orderid = "'.$id.'"';
$update = $mysqli->query($sql);
if ($update) {
    echo "<script>alert('归还成功！');window.location.href='orders_show.php?id=".$id."';</script>";die;
}else {
    echo "<script>alert('归还失败！');window.location.href='orders_show.php?id=".$id."';</script>";die;
}
?>
