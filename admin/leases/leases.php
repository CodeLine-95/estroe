<?php
include '../common/admin.inc.php';
$res_obj = $mysqli->query("select * from lease");
if($res_obj){
    $two_arr = array();
    while ($one_arr = $res_obj->fetch_assoc()){
        $two_arr[] = $one_arr;
    }
}
//关闭mysqli
$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>estore管理系统后台——租赁表</title>
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
        <div class="card-header">租赁专区</div>
        <div class="card-body">
          <a href="/admin/leases/leases_add.php">创建租赁商品</a>
          <table class="table">
            <thead>
              <tr>
                <th>编号</th>
                <th>名称</th>
                <th>图片</th>
                <th>价格(元)</th>
                <th>市场价(元)</th>
                <th>库存量</th>
                <th>押金(元)</th>
                <th>租赁天数</th>
                <th>上架时间</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($two_arr as $key => $one):?>
              <tr>
                <td><?php echo $one['list_id'];?></td>
                <td><?php echo $one['list_name'];?></td>
                <td><img src="/<?php echo $one['list_face'];?>" style="height:40px;"/></td>
                <td><?php echo $one['list_myprice'];?></td>
                <td><?php echo $one['list_onprice'];?></td>
                <td><?php echo $one['list_nums'];?></td>
                <td><?php echo $one['deposit'];?></td>
                <td><?php echo $one['lease_time'];?></td>
                <td><?php echo $one['list_time'];?></td>
                <td>
                  <a href="/admin/leases/leases_edit.php?act=edit&id=<?php echo $one['list_id'];?>">编辑</a>
                  <a href="/admin/leases/leases_del.php?act=del&id=<?php echo $one['list_id'];?>">删除</a>
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
