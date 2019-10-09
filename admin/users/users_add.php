<?php
include '../common/admin.inc.php';
include '../common/function.php';
if (isPost()) {
  $params = $_POST;
  if (empty($params['user_pwd'])) {
    unset($params['user_pwd']);
  }else{
    $params['user_pwd'] = md5($params['user_pwd']);
  }
  $params['user_time'] = date('Y-m-d H:i:s',time());
  $fieldStr = '';
  $dataStr = '';
  foreach ($params as $key => $value) {
    $fieldStr .= $key.',';
    $dataStr .= '"'.$value.'",';
  }
  $fieldStr = substr($fieldStr,0,-1);
  $dataStr = substr($dataStr,0,-1);
  $sql = "INSERT INTO user ({$fieldStr}) VALUES({$dataStr})";
  $result = $mysqli->query($sql);
  if ($result) {
    echo "<script>alert('更新成功');window.location.href='/admin/users/users.php';</script>";
  }else{
    echo "<script>alert('更新失败');window.location.href='/admin/users/users_add.php';</script>";
  }
  die;
}else{
  //取出商品的字段名
  $show = $mysqli->query("show columns from user");
  if ($show){
  	$str = "";
  	while ($one = $show->fetch_row()){
  		$str .= $one[0].",";
  	}
  }
  $str = substr($str,0,-1);

  //等级
  $result = $mysqli->query('select * from user_rank');
  if ($result) {
      while ($one = $result->fetch_assoc()) {
          $user_rank[] = $one;
      }
  }

  //管理员
  $result = $mysqli->query('select * from user_role');
  if ($result) {
      while ($one = $result->fetch_assoc()) {
          $user_role[] = $one;
      }
  }

  //关闭mysqli
  $mysqli->close();
}
?>
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>estore管理系统后台——用户表添加</title>
    <style media="screen">
      *{
        outline: none;
      }
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
      .form-item{
        margin-bottom: 15px;
        clear: both;
        overflow: hidden;
      }
      .form-item label{
        float: left;
        display: block;
        padding: 9px 15px;
        width: 80px;
        font-weight: 400;
        line-height: 20px;
        /* text-align: right; */
      }
      .form-item input{
        float: left;
        width: 190px;
        margin-right: 10px;
      }
      .form-item input, .form-item select, .form-item textarea {
        height: 38px;
        line-height: 1.3;
        line-height: 38px\9;
        border-width: 1px;
        border-style: solid;
        background-color: #fff;
        border-radius: 5px;
        display: block;
        width: 100%;
        padding: 0 10px;
        border:1px solid #000;
    }
    .form-item select option{
      width: 100%;
    }
    .form-item .btn{
      width: 80px;
      border:1px solid #000;
    }
    /*样式1*/
    .a-upload {
        padding: 4px 10px;
        height: 30px;
        line-height: 30px;
        position: relative;
        cursor: pointer;
        color: #888;
        background: #fafafa;
        border: 1px solid #ddd;
        border-radius: 4px;
        overflow: hidden;
        display: inline-block;
        *display: inline;
        *zoom: 1
    }
    .a-upload  input {
        position: absolute;
        font-size: 100px;
        right: 0;
        top: 0;
        opacity: 0;
        filter: alpha(opacity=0);
        cursor: pointer
    }
    .a-upload:hover {
        color: #444;
        background: #eee;
        border-color: #ccc;
        text-decoration: none
    }
    #pwdpower
    {
    	width:175px;
    	border:0px none;
    	background-color:#f1f1f1;
    	float:left;
    	margin-left:7px;
    }
    #pwdpower td
    {
    	text-align:center;
    	vertical-align:middle;
    	padding:1px;
    	color:#adadac;
    }
    #pwdpower #pweak
    {
    	border-right:1px solid #dedede;
    }
    #pwdpower #pmedium
    {
    	border-right:1px solid #dedede;
    }
    #pwdpower #pstrong
    {

    }
    </style>
  </head>
  <body>
    <?php include '../common/header.php';?>
    <div class="admin_content">
      <div class="card">
        <div class="card-header">用户信息</div>
        <div class="card-body">
          <form action="users_add.php" name="users_add" method="post" enctype="multipart/form-data">
            <div class="form-item">
              <label>用户名</label>
              <input type="text" name="user_name" value="">
            </div>
            <div class="form-item">
              <label>密码：</label>
              <input type="password" name="user_pwd" placeholder="更改密码必填，不更改的请勿填写" mode="require" id="user_pwd" onchange="javascript:EvalPwd(this.value);" onkeyup="javascript:EvalPwd(this.value);" size="25">
            </div>
            <div class="form-item">
              <table cellpadding="0" cellspacing="0" border="0" id="pwdpower">
                <tr>
                  <td id="pweak" style="">弱</td>
                  <td id="pmedium" style="">中</td>
                  <td id="pstrong" style="">强</td>
                </tr>
              </table>
            </div>
            <div class="form-item">
              <label>头像</label>
              <select size="1" name="user_face" onchange="chgpic()">
                <option value='t1'>默认</option>
                <option value='t2'>头像一</option>
                <option value='t3'>头像二</option>
                <option value='t4'>头像三</option>
                <option value='t5'>头像四</option>
                <option value='t6'>头像五</option>
                <option value='t7'>头像六</option>
                <option value='t8'>头像七</option>
                <option value='t9'>头像八</option>
                <option value='t10'>头像九</option>
                <option value='t11'>头像十</option>
              </select>
              <img src="../../images/t1.jpg" name="userimg" class="r_pt">
            </div>
            <div class="form-item">
              <label>性别</label>
              <select name="user_sex">
                  <option value="0" selected>男</option>
                  <option value="1">女</option>
              </select>
            </div>
            <!-- <div class="form-item">
              <label>邮箱</label>
              <input type="text" name="user_email" value="">
            </div> -->

            <div class="form-item">
              <label>等级</label>
              <select name="user_rank_id">
                  <?php foreach ($user_rank as $one_arr){?>
                  <option value="<?php echo $one_arr['id']?>"><?php echo $one_arr['name']?></option>
                  <?php }?>
              </select>
            </div>

            <div class="form-item">
              <label>权限</label>
              <select name="user_roleid">
                  <?php foreach ($user_role as $one_arr){?>
                  <option value="<?php echo $one_arr['role_id']?>"><?php echo $one_arr['role_name']?></option>
                  <?php }?>
              </select>
            </div>
            <div class="form-item">
              <input type="submit" value="创建" class="btn">
            </div>
          </form>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="../../js/checkpwd.js"></script>
    <script type="text/javascript">
    //换图片函数
    function chgpic()
    {
      document.userimg.src='../../images/'+document.users_add.user_face.value+'.jpg';
    }
    </script>
  </body>
</html>
