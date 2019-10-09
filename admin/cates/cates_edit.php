<?php
include '../common/admin.inc.php';
include '../common/function.php';
if (isPost()) {
  $params = $_POST;
  $fieldStr = '';
  foreach ($params as $key => $value) {
    $fieldStr .= $key . '="'.$value.'",';
  }
  $fieldStr = substr($fieldStr,0,-1);
  $sql = "UPDATE bigtype SET {$fieldStr} WHERE big_id=".$params['big_id'];
  $result = $mysqli->query($sql);
  if ($result) {
    echo "<script>alert('更新成功，更新ID：".$params['big_id']."');window.location.href='/admin/cates/cates.php';</script>";
  }else{
    echo "<script>alert('更新失败，更新ID：".$params['big_id']."');window.location.href='/admin/cates/cates_edit.php?act=edit&id=".$params['big_id']."';</script>";
  }
  die;
}else{
  //接收数据
  if ($_GET['act']=='edit'){
  	$gid = $_GET['id'];
  }
  //取出商品的字段名
  $show = $mysqli->query("show columns from bigtype");
  if ($show){
  	$str = "";
  	while ($one = $show->fetch_row()){
  		$str .= $one[0].",";
  	}
  }
  $str = substr($str,0,-1);

  $res = $mysqli->query("select {$str} from bigtype where big_id={$gid} ");
  if ($res){
  	while ($one_arr = $res->fetch_assoc()){
  		$two_arr = $one_arr;
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
    <title>estore管理系统后台——分类编辑</title>
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
    </style>
  </head>
  <body>
    <?php include '../common/header.php';?>
    <div class="admin_content">
      <div class="card">
        <div class="card-header">分类信息</div>
        <div class="card-body">
          <form action="cates_edit.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="big_id" value="<?php echo $two_arr['big_id'];?>">
            <div class="form-item">
              <label>分类名称</label>
              <input type="text" name="big_name" value="<?php echo $two_arr['big_name'];?>">
            </div>
            <div class="form-item">
              <input type="submit" value="编辑" class="btn">
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
