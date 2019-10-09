<?php
include '../common/admin.inc.php';
$res_obj = $mysqli->query("select user.*,user_rank.name user_rank_name,user_rank.rebate,user_rank.integral from user,user_rank where user.user_rank_id=user_rank.id and user.user_roleid != 3");
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
    <title>estore管理系统后台</title>
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
        <div class="card-header">用户信息</div>
        <div class="card-body">
          <a href="/admin/users/users_add.php">创建用户</a>
          <table class="table">
            <thead>
              <tr>
                <th>用户名</th>
                <th>性别</th>
                <th>头像</th>
                <!-- <th>邮箱</th> -->
                <th>等级</th>
                <th>积分</th>
                <th>折扣</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($two_arr as $key => $value):?>
                <tr>
                  <td><?php echo $value['user_name'];?></td>
                  <td>
                    <?php switch ($value['user_sex']) {
                      case '0':
                        echo "男";
                        break;
                      case '1':
                        echo "女";
                        break;
                    }?>
                  </td>
                  <td><img src="../../images/<?php echo $value['user_face'];?>.jpg" style="height:40px;"/></td>
                  <!-- <td><?php echo $value['user_email'];?></td> -->
                  <td><?php echo $value['user_rank_name'];?></td>
                  <td><?php echo $value['integral'];?></td>
                  <td><?php echo $value['rebate'];?></td>
                  <td>
                    <a href="/admin/users/users_edit.php?act=edit&id=<?php echo $value['user_id'];?>">编辑</a>
                    <a href="/admin/users/users_del.php?act=del&id=<?php echo $value['user_id'];?>">删除</a>
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
