<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/utils.js"></script>
<script type="text/javascript" src="js/validator.js"></script>
<title>填写配送地址</title>
</head>
<body>
	<div id="container">
		<?php include 'header.php';?>
		<div id="wrapper">
			<div id="contentCenter">
				<div id="register">
					<div class="reg_title">填写送货地址</div>
					<div class="reg_body">
						<form action="includes/order.inc.php" method="post" onsubmit="return Validator.checkSubmit(this)">
							<div class="fm_item">
								<label>* 收货人姓名：</label>
								<input type="text" name="username" mode="require" id="username">
								<label id="ckusername" class="forminfo">请输入收货人姓名!</label>
							</div>
							<div class="fm_item">
								<label>* 收货人地址：</label>
								<input type="text" name="useraddr" mode="require" id="address">
								<label id="ckaddress" class="forminfo">请输入收货人地址!</label>
							</div>
							<div class="fm_item">
								<label>* 电话：</label>
								<input type="text" name="userphone" mode="require" id="phone">
								<label id="ckphone" class="forminfo">请输入收货人电话!</label>
							</div>
							<div class="fm_item">
								<label>邮箱：</label>
								<input type="text" name="email">
							</div>
							<div class="fm_btn">
								<input type="submit" value="确认" class="btn">
								<input type="reset" value="重填" class="btn">
							</div>
							<input type="hidden" value="addorder" name="act">
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
