<?php
session_start();
//调用mysqli
include_once '../includes/conn.php';
include_once './common/function.php';
?>
<?php if (isPost()):?>
  <?php
  $params = $_POST;
  $params['admin_name'] = trim($params['admin_name']);//用户名
	$params['admin_pwd'] = md5(trim($params['admin_pwd'])); //密码
  //数据库验证
  $sql = "select * from user where user_name='{$params['admin_name']}'";
  $result = $mysqli->query($sql);
  $one = $result->fetch_assoc();
  //用户名验证
  if (empty($one)){
    echo "<script>alert('用户名错误！');window.location='login.php?act=login';</script>";
  }else{
    //密码验证
    $sql .= "and user_pwd='{$params['admin_pwd']}'";
    $result = $mysqli->query($sql);
    $one = $result->fetch_assoc();
    if(empty($one)){
      echo "<script>alert('密码输入错误！');window.location='login.php?act=login';</script>";
    }else{
      setcookie('admin',json_encode($one),time()+7*24*3600);
      echo "<script>alert('登录成功！');window.location='index.php';</script>";
    }
  }
  $mysqli->close();
  ?>
<?php else:?>
  <?php $params = $_GET;?>
  <?php if (isset($params) && $params['act'] == 'login') :?>
  <!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <title>estore后台登录</title>
      <style>
        *{
          outline: none;
        }
        body{
          background-color:#f6f6f6;
        }
        .admin_form{
          width: 500px;
          height: 300px;
          margin: 15% auto;
          background-color: #fff;
          border-radius: 10px;
          border: 1px solid #eee;
        }
        .admin_form h2{
          text-align: center;
        }
        .form_admin{
          width: 100%;
          height: 30px;
          line-height: 30px;
          padding: 20px 10px;
          text-align: center;
        }
        .form_admin input{
          height: 30px;
          line-height: 30px;
          padding-left: 5px;
          border-radius: 10px;
          border: 1px solid #ccc;
        }
        .btn{
          width: 80px;
          height: 30px;
          background-color: #cdcdcd;
          border-radius: 10px;
          cursor: pointer;
        }
      </style>
    </head>
    <body>
      <div class="admin_form">
        <h2>estore后台</h2>
        <form class="" action="login.php" method="post">
            <div class="form_admin">
              <label>账号：</label>
              <input type="text" name="admin_name" value="">
            </div>
            <div class="form_admin">
              <label>密码：</label>
              <input type="text" name="admin_pwd" value="">
            </div>
            <div class="form_admin">
              <input type="submit" value="登录" class="btn">
            </div>
        </form>
      </div>
    </body>
  </html>

  <?php else:?>
    <?php echo '<script>alert("禁止访问: 链接地址不正确！！")</script>';?>
  <?php endif;?>
<?php endif;?>
