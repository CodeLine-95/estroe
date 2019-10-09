<?php
include_once 'includes/cart.inc.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="css/style.css" rel="stylesheet" type="text/css">
<title>购物车</title>
	<style type="text/css">
		input{
			width:50px;
			text-align: center;
		}
		table tr{
			font-size: 14px;
		}
		.trun{
			margin-top:-22px;
			/*margin-right: 45px;*/
			float: right;
			width: 60px;
		}
	</style>
</head>
<body>
	<div id="container">
		<?php include 'header.php';?>
		<div id="wrapper">
			<div id="contentCenter">
				<div id="register">
					<div id="cart">
						<form method="post" action="includes/cart.inc.php?act=update">
						<table width="530" border="1" cellpadding="0" cellspacing="1">
							<tr>
								<th scope="col">商品ID</th>
								<th scope="col">商品名称</th>
								<th scope="col">商品图片</th>
								<th scope="col">商品单价</th>
								<th scope="col">市场价格</th>
								<th scope="col">商品数量</th>
								<th scope="col">库存量</th>
								<th scope="col">小计</th>
								<th scope="col">操作</th>
							</tr>
							<?php if (!empty($two)){?>
							<?php foreach ($two as $one):?>
							<tr align="center">
								<td><?php echo $one['list_id']?></td>
								<td><?php echo $one['list_name']?></td>
								<td><img src="<?php echo $one['list_face']?>" width="60" height="50"></td>
								<td>￥<?php echo $one['buy_price']?></td>
								<td>￥<?php echo $one['list_onprice']?></td>
								<td><input type="text" name="<?php echo $one['order_id']?>" value="<?php echo $one['buy_num']?>"></td>
								<td><?php echo $one['list_nums']?></td>
								<td>￥<?php echo $one['nums'];?></td>
								<td><a href="cart.php?act=delete&gid=<?php echo $one['order_id']?>">删除</a></td>
							</tr>
							<?php endforeach;?>
							<?php }else{?>
							<tr align="center"><td colspan="9">空</td></tr>
							<?php }?>
						</table>
						<table border="0">
							<tr>
								<?php if (!empty($ones)){?>
								<?php foreach ($ones as $item):?>
									<?php $sum = $item['sum'];$sums=$item['sums'];?>
										<td>总金额：￥<?php echo $sum;?>元，市场价总额：￥<?php echo $sums;?>元，节省了<?php if ($sum>$sums){echo "0";}else{echo $sums-$sum;}?>元</td>
									<?php endforeach;?>
								<?php }else{?>
									<td>总金额：0元，市场价总额：0元，节省了0元</td>
								<?php }?>
								<td align="right">
									<span><input type="submit" value="更新">
								</td>
							</tr>
						</table>
						</form>
						<div class="trun">
							<form action="includes/cart.inc.php?act=truncate" method="post">
								<span><input type="submit" value="清空">
								<input type="hidden" name="act" value="truncate"></span>
							</form>
						</div>
						<div>
							<span class="continue"><a href="index.php" >继续购买</a></span>
							<span class="checkout"><a href="afterOrder.php?act=goods&id=<?php echo $user_arr['user_id']?>" >结算中心</a></span>
							<div class="clear"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="footer"><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<label>『 Right By Christy Lan 』</label></div>
	</div>
</body>
</html>
