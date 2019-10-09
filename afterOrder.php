<?php
include_once 'includes/afterOrder.inc.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="css/style.css" rel="stylesheet" type="text/css">
<title>订单</title>
</head>
<body>
	<div id="container">
		<?php include 'header.php';?>
		<div id="wrapper">
			<div id="contentCenter">
				<div id="register">
					<div class="reg_title">购物订单</div>
					<div class="reg_body">
					<table id="buylist" border="0" cellpadding="0" cellspacing="3">
						<tr>
							<th scope="col">商品ID</th>
							<th scope="col">商品名称</th>
							<th scope="col">商品图片</th>
							<th scope="col">商品单价</th>
							<th scope="col">市场价格</th>
							<th scope="col">购买数量</th>
							<th scope="col">商品数量</th>
							<th scope="col">小计</th>
						</tr>
						<?php foreach ($arr as $one_arr):?>
						<tr align="center">
							<td><?php echo $one_arr['list_id']?></td>
							<td><?php echo $one_arr['list_name']?></td>
							<td><img src="<?php echo $one_arr['list_face']?>" width="50" height="50"></td>
							<td>￥<?php echo $one_arr['list_myprice']?>元</td>
							<td>￥<?php echo $one_arr['list_onprice']?>元</td>
							<td><?php echo $one_arr['buy_num']?>件</td>
							<td><?php echo $one_arr['list_nums']?>件</td>
							<td>￥<?php echo $one_arr['nums']?></td>
						</tr>
						<?php endforeach;?>
					</table>
					<table border="0">
						<tr>
							<td>购物总金额：￥<?php echo $ones['sum'];?>元，市场价总额：￥<?php echo $ones['sums'];?>元，节省了<?php if ($ones['sum']>$ones['sums']){echo "0";}else{echo $ones['sums']-$ones['sum'];}?>元</td>
							<td align="right">
								<span><input type="button" value="返回" onclick='javascript:window.history.back();' class="modifyBtn"/></span>
							</td>
						</tr>
					</table>
					<div id="orderuser">
						<h4>收货地址</h4>
					    <ul>
							<?php if (!empty($user_arr)):?>
					        <li>收货人姓名:<label><?php echo $user_arr['add_name']?></label></li>
					        <li>收货人地址:<label><?php echo $user_arr['add_derss']?></label></li>
					        <li>收货人电话:<label><?php echo $user_arr['add_tel']?></label></li>
					        <li>收货人邮箱:<label><?php echo $user_arr['add_email']?></label></li>
							<?php else:?>
									<li><span><input type="button" value="添加收货地址" onclick='javascript:window.location.href="order.php"' class="modifyBtn"/></span></li>
							<?php endif;?>
					    </ul>
						<div class="clear"></div>
					</div>
					<form action="<?php echo $form_url;?>" method="post">
						<input type="hidden" name="orderid" value="<?php echo $order_arr['orderid'];?>">
						<input type="hidden" name="beforetotalprice" value="<?php echo $order_arr['beforetotalprice'];?>">
						<input type="hidden" name="aftertotalprice" value="<?php echo $order_arr['aftertotalprice'];?>">
						<input type="hidden" name="buycount" value="<?php echo $order_arr['buycount'];?>">
						<input type="hidden" name="userid" value="<?php echo $order_arr['userid'];?>">
						<input type="hidden" name="createtime" value="<?php echo $order_arr['createtime'];?>">
						<input type="hidden" name="goodsid" value="<?php echo $order_arr['goodsid'];?>">
						<input type="hidden" name="add_id" value="<?php echo $order_arr['add_id'];?>">
						<?php if(isset($order_arr['lease_time'])):?>
							租赁天数：<input type="text" name="lease_time" value="<?php echo $order_arr['lease_time']?>">
						<?php endif;?>
						<?php if(isset($order_arr['deposit'])):?>
							<input type="hidden" name="deposit" value="<?php echo $order_arr['deposit']?>">
						<?php endif;?>
						<input type="submit" value="提交订单" class="orderBtn">
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
