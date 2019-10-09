<?php
//调用mysqli
include_once 'includes/conn.php';
//执行SQL语句
$res = $mysqli->query("select list_id,list_name,list_face,list_myprice,list_onprice from list ORDER BY list_time DESC limit 6");
if ($res){
	while ($one = $res->fetch_assoc()){
		$two[] = $one;
	}
}
//店主推荐
$cate = $mysqli->query("select list_id,list_name,list_face,list_myprice from list ORDER BY list_myprice asc limit 3 ");
if ($cate) {
	$arr=array();
	while ($one_arrs = $cate->fetch_assoc()) {
		$arr[] = $one_arrs;
	}
}
//关闭链接
$mysqli->close();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/style.css" rel="stylesheet" type="text/css">
<title>我的商店-首页</title>
</head>
<body>
<div id="container">
	<?php include 'header.php';?>
	<div id="wrapper">
		<div id="sidebar">
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<?php if(empty($_COOKIE['user'])){?>
			<div>
				<div class="box_title">会员登录</div>
				<div class="box_list">
					<form action="index.func.php" method="post">
						<div class="login">
							<ul>
								<li>
									<label>账号</label>
									<input name="username" id="useraccount" type="text">
								</li>
								<li>
									<label>密码</label>
									<input name="password" id="userpwd" type="password">
								</li>
								<!-- <li>
									<label>验证码</label>
									<input name="checkCode" id="code" type="text" style="width:50px">
									<img src="checkcode.php" width="50" onclick="this.src='checkcode.php?code='+Math.random()" alt="验证码" style="cursor:pointer">
								</li> -->
								<li class="formbt">
						<input type="submit" value="登录" class="bt">
						<input type="button" value="注册" class="bt" onclick='javascript:window.location.href="register.php"'>
					</li>
							</ul>
						</div>
						<input name="act" type="hidden" value="checkLogin">
					</form>
				</div>
				<div class="box_bottom"><img src="images/0.gif" width="10" height="1" alt=""/></div>
			</div>
			<?php }?>
			<div style="margin-top:10px;"></div>
			<div class="category">
			<div class="box_title">商品分类</div>
			<div class="box_list">
				<?php include_once 'includes/type.inc.php';?>
			</div>
			<div class="box_bottom"><img src="images/0.gif" width="10" height="1" alt=""/></div>
		</div>
		</div>
		<div id="content">
			<div id="showgoods">
				<h4>店主推荐</h4>
				<div class="goodslist"><ul>
					<?php foreach ($arr as $value) {?>
						<li>
							<a href="goodDetail.php?act=detailedgood&gid=<?php echo $value['list_id']?>">
								<img src="<?php echo $value['list_face']?>" width="125" height="120" />
							</a>
							<span>【<?php echo $value['list_name']?>】</span>
							<?php if(empty($_COOKIE['user'])):?>
								<div class="price">￥<?php echo $value['list_myprice']?></div>
							<?php else:?>
								<div class="price">￥<?php echo $user['rebate']*$value['list_myprice']?></div>
							<?php endif;?>

						</li>
						<?php }?>
					</ul>
				</div>
			</div>
			<div id="buylist">
				<h5>☆最新商品<a href="goodsList.php?act=goodslist">.o0更多</a></h5>
				<div class="newgoods">
					<ul>
						<?php foreach ($two as $one_arr){?>
							<li>
								<a href="goodDetail.php?act=detailedgood&gid=<?php echo $one_arr['list_id']?>">
									<img src="<?php echo $one_arr['list_face']?>" width="150" height="150" /></a>
								<p>【<?php echo $one_arr['list_name']?>】</p>
								<p>市场价格￥<label class="quchu"><?php echo $one_arr['list_onprice']?></label></p>
								<?php if(empty($_COOKIE['user'])):?>
								<p class="red">本店价格￥<?php echo $one_arr['list_myprice']?></p>
								<?php else:?>
									<p class="red">本店价格￥<?php echo $user['rebate']*$one_arr['list_myprice']?></p>
								<?php endif;?>
							</li>
						<?php }?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div id="footer"><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<label>『 Right By Christy Lan 』</label></div>

</div>
</body>
</html>
