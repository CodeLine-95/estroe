<?php
include '../common/admin.inc.php';

$id = $_GET['id'];
$res_obj = $mysqli->query("select * from leases_orders where orderid = '".$id."'");
if($res_obj){
    $one = array();
    $one_arr = $res_obj->fetch_assoc();
    $goods_arr = array();
    $goods_res = $mysqli->query("select * from list where list_id in(".$one_arr['goodsid'].")");
    while ($goods = $goods_res->fetch_assoc()) {
      $goods_arr[] = $goods;
    }
    $one_arr['goods'] = $goods_arr;

    $address_arr = array();
    $address_res = $mysqli->query("select * from adderss where add_id=".$one_arr['add_id']);
    while ($address = $address_res->fetch_assoc()) {
      $address_arr = $address;
    }
    $one = $one_arr;
}
//关闭mysqli
$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>estore管理系统后台——租赁订单表查看</title>
    <style media="screen">
      .card {
        margin-bottom: 15px;
        border-radius: 2px;
        background-color: #fff;
        box-shadow: 0 1px 2px 0 rgba(0,0,0,.05);
      }
      .card-header{
        position: relative;
        height: 42px;
        line-height: 42px;
        padding: 0 15px;
        border-bottom: 1px solid #f6f6f6;
        color: #333;
        border-radius: 2px 2px 0 0;
        font-size: 14px;
      }
      .card-body {
          position: relative;
          padding: 10px 15px;
          line-height: 24px;
      }
      .card-body .table {
          margin: 5px 0;
      }
      .table {
          width: 100%;
          background-color: #fff;
          color: #666;
      }
      table{
          border-collapse: collapse;
          border-spacing: 0;
      }
      .table th{
        min-width: 80px;
      }
      .table th,.table td{
          position: relative;
          padding: 9px 15px;
          min-height: 20px;
          line-height: 20px;
          border-width: 1px;
          border-style: solid;
          border-color: #e6e6e6;
          word-break: break-all;
          text-align: left;
          font-weight: 400;
          font-size: 12px;
      }
      #back{
        height: 40px;
        line-height: 40px;
        width: 60px;
        background-color: #333333;
        text-align: center;
        color:#fff;
        border-radius: 10px;
        margin-top: 40px;
        display: block;
      }
    </style>
  </head>
  <body>
    <?php include '../common/header.php';?>
    <div class="admin_content">
      <div class="card">
        <div class="card-header">订单信息</div>
        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th>订单号</th>
                <th>商品信息</th>
                <th>市场总额</th>
                <th>租赁押金</th>
                <th>租赁数量</th>
                <th>租赁时间</th>
                <th>结束时间</th>
                <th>归还时间</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php echo $one['orderid'];?></td>
                <td>
                  <?php foreach ($one['goods'] as $s):?>
                    <img src="<?php echo '/'.$s['list_face']?>" alt="" style="height:40px;">
                  <?php endforeach;?>
                </td>
                <td><?php echo $one['beforetotalprice'];?></td>
                <td><?php echo $one['aftertotalprice'];?></td>
                <td><?php echo $one['buycount'];?></td>
                <td><?php echo $one['leasetime'];?></td>
                <td><?php echo $one['endtime'];?></td>
                <td><?php echo $one['backtime'];?></td>
              </tr>
            </tbody>
          </table>

          <h2 style="font-size:14px;margin-top:40px;">商品信息</h2>
          <table class="table">
            <thead>
              <tr>
                <th>商品编号</th>
                <th>商品名称</th>
                <th>商品图片</th>
                <th>单价</th>
                <th>市场价</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($one['goods'] as $s):?>
              <tr>
                  <td><?php echo $s['list_id'];?></td>
                  <td><?php echo $s['list_name'];?></td>
                  <td><img src="<?php echo '/'.$s['list_face']?>" alt="" style="height:40px;"></td>
                  <td><?php echo $s['list_myprice'];?></td>
                  <td><?php echo $s['list_onprice'];?></td>
              </tr>
              <?php endforeach;?>
            </tbody>
          </table>

          <h2 style="font-size:14px;margin-top:40px;">收货地址</h2>
          <table class="table">
            <thead>
              <tr>
                <th>收货人姓名</th>
                <th>收货人电话</th>
                <th>收货人地址</th>
                <th>收货人邮箱</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php echo $address_arr['add_name'];?></td>
                <td><?php echo $address_arr['add_tel'];?></td>
                <td><?php echo $address_arr['add_derss'];?></td>
                <td><?php echo $address_arr['add_email'];?></td>
              </tr>
            </tbody>
          </table>

          <a href="javascript:;" id="back" onclick="javascript:window.history.back()">返回</a>
        </div>
      </div>
    </div>
  </body>
</html>
