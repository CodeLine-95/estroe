<?php
include_once 'includes/orders_show.inc.php';
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
			<div id="contentCenter" style="margin:0;">
				<div id="register" style="width:auto;">
					<div class="reg_title">购物订单详情</div>
					<div class="reg_body">
						<?php if(substr($orders['orderid'],0,2) == 'IN'):?>
							<table border="0" style="width:100%;">
	              <tr>
	                <th scope="col">订单号</th>
									<th scope="col">购买数量</th>
	              </tr>
	  						<tr>
	  							<td><?php echo $orders['orderid'];?></td>
									<td><?php echo $orders['buycount']?></td>
	  						</tr>
	  					</table>
  						<table id="buylist" border="0" cellpadding="0" cellspacing="3">
  						<tr>
  							<th scope="col">商品ID</th>
  							<th scope="col">商品名称</th>
  							<th scope="col">商品图片</th>
  							<th scope="col">商品单价</th>
  							<th scope="col">市场价格</th>
  						</tr>
  						<?php foreach ($orders['goods'] as $one_arr):?>
  						<tr>
  							<td><?php echo $one_arr['list_id']?></td>
  							<td><?php echo $one_arr['list_name']?></td>
  							<td><img src="/<?php echo $one_arr['list_face']?>" width="50" height="50"></td>
  							<td>￥<?php echo $one_arr['list_myprice']?>元</td>
  							<td>￥<?php echo $one_arr['list_onprice']?>元</td>
  						</tr>
  						<?php endforeach;?>
  					</table>
						<?php else:?>
							<table border="0" style="width:100%;">
	              <tr>
	                <th scope="col">订单号</th>
									<th scope="col">租赁数量</th>
									<th scope="col">租赁时间</th>
									<th scope="col">归还时间</th>
									<?php if(empty($orders['backtime'])){ ?>
										<th scope="col">剩余时间</th>
									<?php }else{ ?>
										<th scope="col">提前归还时间</th>
									<?php }?>
	              </tr>
	  						<tr>
	  							<td><?php echo $orders['orderid'];?></td>
									<td><?php echo $orders['buycount']?></td>
									<td><?php echo $orders['leasetime'];?></td>
									<td><?php echo $orders['endtime'];?></td>
									<?php if(empty($orders['backtime'])):?>
										<td id="show_time"></td>
										<script type="text/javascript">
										TimeDown('show_time',"<?php echo $orders['endtime'];?>");
										function TimeDown(id, endDateStr) {
											//结束时间
											var endDate = new Date(endDateStr);
											//当前时间
											var nowDate = new Date();
											//相差的总秒数
											var totalSeconds = parseInt((endDate - nowDate) / 1000);
											//天数
											var days = Math.floor(totalSeconds / (60 * 60 * 24));
											//取模（余数）
											var modulo = totalSeconds % (60 * 60 * 24);
											//小时数
											var hours = Math.floor(modulo / (60 * 60));
											modulo = modulo % (60 * 60);
											//分钟
											var minutes = Math.floor(modulo / 60);
											//秒
											var seconds = modulo % 60;
											//输出到页面
											document.getElementById(id).innerHTML = "还剩:" + days + "天" + hours + "小时" + minutes + "分钟" + seconds + "秒";
											//延迟一秒执行自己
											setTimeout(function () {
													TimeDown(id, endDateStr);
											}, 1000)
										}
									</script>
									<?php else:?>
										<td><?php echo $orders['backtime'];?></td>
									<?php endif; ?>
	  						</tr>
	  					</table>
							<table id="buylist" border="0" cellpadding="0" cellspacing="3">
	  						<tr>
	  							<th scope="col">商品ID</th>
	  							<th scope="col">商品名称</th>
	  							<th scope="col">商品图片</th>
	  							<th scope="col">商品单价</th>
	  							<th scope="col">市场价格</th>
	  						</tr>
	  						<?php foreach ($orders['goods'] as $one_arr):?>
	  						<tr>
	  							<td><?php echo $one_arr['list_id']?></td>
	  							<td><?php echo $one_arr['list_name']?></td>
	  							<td><img src="/<?php echo $one_arr['list_face']?>" width="50" height="50"></td>
	  							<td>￥<?php echo $one_arr['list_myprice']?>元</td>
	  							<td>￥<?php echo $one_arr['list_onprice']?>元</td>
	  						</tr>
	  						<?php endforeach;?>
	  					</table>
						<?php endif;?>
  					<div id="orderuser">
  						<h4>收货地址</h4>
  					    <ul>
  							<?php if (!empty($orders['address'])){?>
  					        <li>收货人姓名:<label><?php echo $orders['address']['add_name']?></label></li>
  					        <li>收货人地址:<label><?php echo $orders['address']['add_derss']?></label></li>
  					        <li>收货人电话:<label><?php echo $orders['address']['add_tel']?></label></li>
  					        <li>收货人邮箱:<label><?php echo $orders['address']['add_email']?></label></li>
  							<?php }?>
  					    </ul>
  						<div class="clear"></div>
  					</div>
            <table border="0">
  						<tr>
  							<td>购物总金额：￥<?php echo $orders['aftertotalprice']*$orders['lease_days'];?>元，市场价总额：￥<?php echo $user['rebate']*$orders['beforetotalprice'];?>元，节省了<?php if ($orders['aftertotalprice']*$orders['lease_days']>$orders['beforetotalprice']*$user['rebate']){echo "0";}else{echo $orders['beforetotalprice']*$user['rebate']-$orders['aftertotalprice']*$orders['lease_days'];}?>元</td>
								<?php if(substr($orders['orderid'],0,2) == 'ZL' && empty($orders['backtime'])):?>
								<td align="right">
									<span> <a href="leasesOrders_back.php?id=<?php echo $orders['orderid'];?>" class="modifyBtn">立即归还</a> </span>
								</td>
								<?php endif;?>
  						</tr>
  					</table>
					</div>
				</div>
			</div>
		</div>
		<div id="footer"><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<label>『 Right By Christy Lan 』</label></div>
	</div>
</body>
</html>
