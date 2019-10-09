<?php
include '../common/admin.inc.php';
$res_obj = $mysqli->query("select smalltype.*,bigtype.big_name from smalltype,bigtype where smalltype.big_id = bigtype.big_id and smalltype.big_id = ".$_GET['big_id']." order by smalltype.small_id desc");
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
    <title>estore管理系统后台——商品小分类</title>
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
        <div class="card-header">小分类信息</div>
        <div class="card-body">
          <a href="/admin/cates/cates_small_add.php">创建小分类</a>
          <table class="table">
            <thead>
              <tr>
                <th>编号</th>
                <th>分类名称</th>
                <th>上级分类</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($two_arr as $key => $one):?>
              <tr>
                <td><?php echo $one['small_id'];?></td>
                <td><?php echo $one['small_name'];?></td>
                <td><?php echo $one['big_name'];?></td>
                <td>
                  <a href="/admin/cates/cates_small_edit.php?act=edit&id=<?php echo $one['small_id'];?>">编辑</a>
                  <a href="/admin/cates/cates_small_del.php?act=del&id=<?php echo $one['small_id'];?>">删除</a>
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
