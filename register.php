<?php
//调用mysqli
include_once 'includes/conn.php';
//接收数据
if(!empty($_POST)){
	$username = trim($_POST['username']);//用户名
	$userpwd = trim($_POST['userpwd']); //密码
	$userpwd = md5($userpwd);
	$userrepwd = trim($_POST['userrepwd']);
	$userrepwd = md5($userrepwd);
	$sex = $_POST['sex'];
	$selectpics = $_POST['selectpics']; //头像
	$time = date("Y/m/d H:i:s"); //注册时间
	$user_roleid = $_POST['user_roleid'];
	$user_rank_id = $_POST['user_rank_id'];
	//验证合法性
	if(!empty($username)&&!empty($userpwd)){
		//正则验证
		$pwd = preg_match("/^.{6,}$/i",$userpwd);
		//验证密码
		if (!$pwd){
			echo "<script>alert('密码必须由6位以上的任意字符组成！');window.location='register.php';</script>";
		}
		//验证确认密码
		if ($userpwd!=$userrepwd){
			echo "<script>alert('两次密码输入要一致！');window.location='register.php';</script>";
		}
		//取出user表中的字段名
		$sql = "show columns from user";
		$res = $mysqli->query($sql);
		if ($res){
			$str = "";
			while ($one = $res->fetch_row()){
				$str .= $one[0].",";
			}
		}
		$str = substr($str,0,-1);
		$str = substr($str,8);
		//数据库验证
		$select = $mysqli->query("select user_id from user where user_name='{$username}'");
		$one = $select->fetch_assoc();
		if (!empty($one)){
			echo "<script>alert('该用户已存在！请重新输入！');window.location='register.php';</script>";
			exit();
		}
		//执行核心SQL
		$sql = "insert into user(user_name,user_pwd,user_sex,user_face,user_time,user_roleid,user_rank_id) VALUES ('{$username}','{$userpwd}','{$sex}','{$selectpics}','{$time}',{$user_roleid},{$user_rank_id})";
		$result = $mysqli->query($sql);
		if ($result){
			// setcookie("user",$username,time()+7*24*3600);
			echo "<script>alert('注册成功！');window.location='index.php';</script>";
		}else{
			echo "<script>alert('注册失败！');window.location='register.php';</script>";
		}
	}
}
$mysqli->close();
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
<title>注册</title>
</head>
<body>
	<div id="container">
		<?php include 'header.php';?>
		<div id="wrapper">
			<div id="contentCenter">
				<div id="register">
					<div class="reg_title">注&nbsp;&nbsp;&nbsp;&nbsp;册</div>
					<div class="reg_body">
						<!-- 表单名user_register在register.js的换头像中需要用到 -->
						<form name="user_register" method="post" action="register.php" onsubmit="return Validator.checkSubmit(this)">
							<div class="fm_item">
								<label>* 账号：</label>
								<input type="text" name="username" mode="require" id="username">
								<label id="ckusername" class="forminfo">请输入你的账号</label>
							</div>
							<div class="fm_item">
								<label>* 密码：</label>
								<input type="password" name="userpwd" mode="require" id="userpwd" onchange="javascript:EvalPwd(this.value);" onkeyup="javascript:EvalPwd(this.value);" size="25">
								<label id="ckuserpwd" class="forminfo">请输入你的密码</label>
							</div>
							<div class="fm_item">
								<label>&nbsp;</label>
								<table cellpadding="0" cellspacing="0" border="0" id="pwdpower">
									<tr>
										<td id="pweak" style="">弱</td>
										<td id="pmedium" style="">中</td>
										<td id="pstrong" style="">强</td>
									</tr>
								</table>
							</div>
							<div class="fm_item">
								<label>* 密码确认：</label>
								<input type="password" name="userrepwd" id="userrepwd">
								<label class="forminfo">2次密码不一致</label>
							</div>
							<div class="fm_item">
								<label>* 性别：</label>
								<select name="sex">
									<option value="0" selected>男</option>
									<option value="1">女</option>
								</select>
							</div>
							<div class="fm_item">
								<label>* 头像：</label>
								<select size="1" name="selectpics" onchange="chgpic()">
		             	<option value='t1' selected>默认</option>
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
	           		<img src="images/t1.jpg" name="userimg" class="r_pt">
							</div>
							<!-- <div class="fm_item">
								<label>邮件：</label>
								<input type="text" name="email">
							</div> -->
							<!-- <div class="fm_item">
								<label>身份证：</label>
								<input type="text" name="idcard">
							</div> -->
							<input type="hidden" name="user_roleid" value="1">
							<input type="hidden" name="user_rank_id" value="1">
							<div class="fm_btn">
								<input type="submit" value="注册" class="btn">
								<input type="reset" value="重填" class="btn">
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
