<?php
include '../common/admin.inc.php';

// $res_obj = $mysqli->query("select * from leases_orders");
$two_arr = findAll("select * from leases_orders",$mysqli);
foreach ($two_arr as $key => $t) {
  $goods_arr = findAll("select * from list where list_id in(".$t['goodsid'].")",$mysqli);
  $two_arr[$key]['goods'] = $goods_arr;
}
//关闭mysqli
$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>estore管理系统后台——租赁订单表</title>
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
    </style>
  </head>
  <body>
    <?php include '../common/header.php';?>
    <div class="admin_content">
      <div class="card">
        <div class="card-header">租赁订单信息</div>
        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th>订单号</th>
                <th>商品信息</th>
                <th>商品总额</th>
                <th>押金</th>
                <th>租赁数量</th>
                <th>租赁时间</th>
                <th>结束时间</th>
                <th>归还时间</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($two_arr as $key => $one):?>
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
                <td>
                  <a href="/admin/orders/leaseOrders_edit.php?act=edit&id=<?php echo $one['orderid'];?>">查看</a>
                  <a href="/admin/orders/leaseOrders_del.php?act=del&id=<?php echo $one['orderid'];?>">删除</a>
                </td>
              </tr>
              <?php endforeach;?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>
