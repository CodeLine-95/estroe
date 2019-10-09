<?php
session_start();
//调用mysqli
include_once 'includes/conn.php';
//接收数据
if (!empty($_POST)){
	$username = trim($_POST['username']);
	$userpwd = trim($_POST['userpwd']);
	$userpwd = md5($userpwd);
	//正则验证
	if (!empty($username)&&!empty($userpwd)){
		$pwd = preg_match("/^.{6,}$/i",$userpwd);
		//验证密码
		if (!$pwd){
			echo "<script>alert('密码必须六位以上！');window.location='login.php';</script>";
		}
		//数据库验证
		$sql = "select user.*,user_rank.name user_rank_name,user_rank.rebate,user_rank.integral from user,user_rank where user_name = '{$username}'";
		$result = $mysqli->query($sql);
		$one = $result->fetch_assoc();
		//用户名验证
		if (empty($one)){
			echo "<script>alert('没有此用户，请注册！');window.location='register.php';</script>";
		}else{
			if($one['user_roleid'] == 3){
				setcookie('admin',json_encode($one),time()+7*24*3600);
				echo "<script>alert('登录成功！');window.location='/admin/';</script>";
			}else{
				if(empty($one['user_roleid'])){
					echo "<script>alert('未分配级别，请联系管理员！');window.location='login.php';</script>";
				}else{
					//密码验证
					$sql .= "and user.user_rank_id=user_rank.id and user_pwd='{$userpwd}'";
					$result = $mysqli->query($sql);
					$one = $result->fetch_assoc();
					if(empty($one)){
						echo "<script>alert('密码输入错误！');window.location='login.php';</script>";
					}else{
						setcookie('user',json_encode($one),time()+7*24*3600);
						echo "<script>alert('登录成功！');window.location='index.php';</script>";
					}
				}
			}
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
<title>登录</title>
</head>
<body>

	<div id="container">
		<?php include 'header.php';?>

		<div id="wrapper">
			<div id="contentCenter">
				<div id="register">
					<div class="reg_title">登&nbsp;&nbsp;&nbsp;&nbsp;录</div>
					<div class="reg_body">
						<!-- 表单名user_register在register.js的换头像中需要用到 -->
						<form method="post" action="login.php" onsubmit="return Validator.checkSubmit(this)">
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
							<!-- <div class="fm_item">
								<label>验证码</label>
								<input name="checkCode" id="code" type="text" style="width:50px">
								<img src="checkcode.php" onclick="this.src='checkcode.php?code='+Math.random()" alt="验证码" style="cursor:pointer">
							</div> -->
							<div class="fm_btn">
								<input type="submit" value="登录" class="btn">
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
