<?php include 'common/admin.inc.php';?>
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
    <?php include './common/header.php';?>
    <div class="admin_content">
      <div class="card">
        <div class="card-header">系统信息</div>
        <div class="card-body">
          <table class="table">
            <tbody>
              <tr>
                <th>当前域名</th>
                <td><?php echo $_SERVER['HTTP_HOST'];?></td>
              </tr>
              <tr>
                <th>操作系统</th>
                <td><?php echo PHP_OS;?></td>
              </tr>
              <tr>
                <th>运行环境</th>
                <td><?php echo $_SERVER['SERVER_SOFTWARE'];?></td>
              </tr>
              <tr>
                <th>php运行方式</th>
                <td><?php echo php_sapi_name();?></td>
              </tr>
              <tr>
                <th>php版本</th>
                <td><?php echo phpversion();?></td>
              </tr>
              <tr>
                <th>NYSQL版本</th>
                <td><?php echo $mysqli->server_info;?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>
