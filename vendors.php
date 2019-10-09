<?php
/**
 * Created by PhpStorm.
 * User: qiaoshuai
 * Date: 2016/9/14
 * Time: 10:36
 */
//判断是否登录
if (!empty($_COOKIE['user'])) {
    //调用mysqli
    include_once 'includes/conn.php';
    //取出小分类的值
    $sql = "select small_id,small_name from smalltype";
    $result = $mysqli->query($sql);
    if ($result) {
        while ($one = $result->fetch_assoc()) {
            $small_id = $one['small_id'];
            $two1[] = $one;
        }
    }
    //接收提交的数据
    if (!empty($_POST)) {
        $listname = $_POST['listname'];
        $listprice = $_POST['listprice'];
        $listprice = (float)$listprice;
        $listonprice = $_POST['listonprice'];
        $listonprice = (float)$listonprice;
        $face = $_FILES['face'];
        $smalltype = $_POST['smalltype'];
        $text = $_POST['text'];
        $nums = $_POST['num'];
        $time = date("Y/m/d H:i:s");
        //判断图片
        switch ($face['error']) {
            case 0:
                $type = $face['type'];
                //判断图片的类型
                if ($type == 'image/jpeg' || $type == 'image/ipg' || $type == 'image/png' || $type == 'image/gif') {
                    $tmp = $face['tmp_name'];
                    //重命名图片
                    $t = time();
                    $hou = substr($face['name'], -4, 4);
                    $src = "upload/" . $t . $hou;
                    $bool = move_uploaded_file($tmp, $src);
                    //存入数组
                    if ($bool) {
                        $img['face'] = $src;
                    }
                } else {
                    echo "<script>alert('必须使用图片！');window.locaation='vendors.php';</script>";
                }
                break;
            //图片的错误判断
            case 1:
            case 2:
                echo "<script>alert('文件超出指定大小！');location.href='vendors.php';</script>";
                break;
            case 3:
                echo "<script>alert('网络不稳定，请重新上传！');location.href='vendors.php';</script>";
                break;
            case 4:
                echo "<script>alert('不能是空文件！');location.href='vendors.php';</script>";
                break;
        }
        //写入数据库
        $sql = "insert into list(list_name,list_myprice,list_onprice,list_face,list_nums,list_detail,list_time,small_id) VALUES ('{$listname}','{$listprice}','{$listonprice}','{$img["face"]}','{$nums}','{$text}','{$time}','{$smalltype}')";
        $res = $mysqli->query($sql);
        if ($res) {
            echo "<script>alert('上传成功');window.location='vendors.php';</script>";
        }
    }
    //关闭数据库连接
    $mysqli->close();
}else{
    echo "<script>alert('请登录后才能进入！');window.location='index.php';</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="js/register.js"></script>
    <script type="text/javascript" src="js/checkpwd.js"></script>
    <script type="text/javascript" src="js/utils.js"></script>
    <script type="text/javascript" src="js/validator.js"></script>
    <title>用户中心——上传商品</title>
</head>
<body>
<div id="container">
    <?php include 'header.php';?>
    <div id="wrapper">
        <div id="contentCenter">
            <div id="register">
                <div class="reg_title">上传商品</div>
                <div class="reg_body">
                    <form method="post" action="vendors.php" enctype="multipart/form-data" onsubmit="return Validator.checkSubmit(this)">
                        <div class="fm_item">
                            <label>* 商品名称：</label>
                            <input type="text" name="listname" mode="require" id="username">
                            <label id="ckusername" class="forminfo">请输入你的商品名</label>
                        </div>
                        <div class="fm_item">
                            <label>* 商品价格：</label>
                            <input type="text" name="listprice" mode="require" id="userpwd" onchange="javascript:EvalPwd(this.value);" onkeyup="javascript:EvalPwd(this.value);" size="25">
                            <label id="ckuserpwd" class="forminfo">请输入你的价格</label>
                        </div>
                        <div class="fm_item">
                            <label>* 市场价格：</label>
                            <input type="text" name="listonprice" mode="require" id="userpwd">
                        </div>
                        <div class="fm_item">
                            <label>* 商品图片：</label>
                            <input type="file" name="face">
                        </div>
                        <div class="fm_item">
                            <label>* 类别：</label>
                            <select name="smalltype">
                                <?php foreach ($two1 as $one_arr){?>
                                <option value="<?php echo $one_arr['small_id']?>"><?php echo $one_arr['small_name']?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="fm_item">
                            <label>* 商品简介：</label>
                            <textarea name="text" cols="20" rows="5"></textarea>
                        </div>
                        <div class="fm_item">
                            <label>* 商品库存量：</label>
                            <input type="text" name="num" value="1">
                        </div>
                        <div class="fm_btn">
                            <input type="submit" value="上传" class="btn">
                        </div>
                        <input type="hidden" value="adduser" name="act">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="footer"><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <label>『 Right By Christy Lan 』</label></div>
</div>
</body>
</html>
