<?php
include '../common/admin.inc.php';
include '../common/function.php';
if (isPost()) {
  $params = $_POST;
  $face = $_FILES['list_face'];
  //判断图片
  switch ($face['error']) {
      case 0:
          $type = $face['type'];
          //判断图片的类型
          if ($type == 'image/jpeg' || $type == 'image/ipg' || $type == 'image/png' || $type == 'image/gif') {
              $tmp = $face['tmp_name'];
              //重命名图片
              $path = '../../upload/';
              $t = time();
              $hou = substr($face['name'], -4, 4);
              $src = $path . $t . $hou;
              $bool = move_uploaded_file($tmp, $src);
              //存入数组
              if ($bool) {
                  $params['list_face'] = 'upload/'.$t . $hou;
              }
          } else {
              echo "<script>alert('必须使用图片！');window.location.href='/admin/lists/lists_edit.php?act=edit&id=".$params['list_id']."';</script>";die;
          }
          break;
      //图片的错误判断
      case 1:
      case 2:
          echo "<script>alert('文件超出指定大小！');window.location.href='/admin/lists/lists_edit.php?act=edit&id=".$params['list_id']."';</script>";die;
          break;
      case 3:
          echo "<script>alert('网络不稳定，请重新上传！');window.location.href='/admin/lists/lists_edit.php?act=edit&id=".$params['list_id']."';</script>";die;
          break;
  }
  $fieldStr = '';
  foreach ($params as $key => $value) {
    $fieldStr .= $key . '="'.$value.'",';
  }
  $fieldStr = substr($fieldStr,0,-1);
  $sql = "UPDATE list SET {$fieldStr} WHERE list_id=".$params['list_id'];
  $result = $mysqli->query($sql);
  if ($result) {
    echo "<script>alert('更新成功，更新ID：".$params['list_id']."');window.location.href='/admin/lists/lists.php';</script>";
  }else{
    echo "<script>alert('更新失败，更新ID：".$params['list_id']."');window.location.href='/admin/lists/lists_edit.php?act=edit&id=".$params['list_id']."';</script>";
  }
  die;
}else{
  //接收数据
  if ($_GET['act']=='edit'){
  	$gid = $_GET['id'];
  }
  //取出商品的字段名
  $show = $mysqli->query("show columns from list");
  if ($show){
  	$str = "";
  	while ($one = $show->fetch_row()){
  		$str .= $one[0].",";
  	}
  }
  $str = substr($str,0,-1);

  //取出小分类的值
  $sql = "select small_id,small_name from smalltype";
  $result = $mysqli->query($sql);
  if ($result) {
      while ($one = $result->fetch_assoc()) {
          $small_id = $one['small_id'];
          $two1[] = $one;
      }
  }

  $res = $mysqli->query("select {$str} from list where list_id={$gid} ");
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
    <title>estore管理系统后台——商品表编辑</title>
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
        <div class="card-header">商品信息</div>
        <div class="card-body">
          <form action="lists_edit.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="list_id" value="<?php echo $two_arr['list_id'];?>">
            <div class="form-item">
              <label>商品名称</label>
              <input type="text" name="list_name" value="<?php echo $two_arr['list_name'];?>">
            </div>
            <div class="form-item">
              <label>商品图片</label>
              <div style="float:left;margin-right:10px;">
                <img src="<?php echo '/'.$two_arr['list_face'];?>" style="height:40px;">
              </div>
              <a href="javascript:;" class="a-upload">
                <input type="file" name="list_face">点击这里上传文件
              </a>

            </div>
            <div class="form-item">
              <label>商品价格</label>
              <input type="text" name="list_myprice" value="<?php echo $two_arr['list_myprice'];?>">
            </div>
            <div class="form-item">
              <label>商品市场价</label>
              <input type="text" name="list_onprice" value="<?php echo $two_arr['list_onprice'];?>">
            </div>

            <div class="form-item">
              <label>类别</label>
              <select name="small_id">
                  <?php foreach ($two1 as $one_arr){?>
                  <option value="<?php echo $one_arr['small_id']?>"><?php echo $one_arr['small_name']?></option>
                  <?php }?>
              </select>
            </div>
            <div class="form-item">
              <label>商品简介</label>
              <textarea name="list_detail" rows="8" cols="80" style="height:100px;padding:10px;"><?php echo $two_arr['list_detail'];?></textarea>
            </div>
            <div class="form-item">
              <label>商品库存</label>
              <input type="text" name="list_nums" value="<?php echo $two_arr['list_nums'];?>">
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
