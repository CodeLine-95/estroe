<?php
include_once 'includes/orders.inc.php';
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
				<div id="register" style="background:none;height:auto;width:100%;">
					<div class="reg_title">普通订单</div>
					<div class="reg_body">
						<?php if (!empty($orders)):?>
		          <?php foreach ($orders as $key => $s):?>
		            <?php if($key > 0):?>
		              <hr />
		            <?php endif;?>
		  					<table id="buylist" border="0" cellpadding="0" cellspacing="3" style="width: 100%;">
		                <tr>
		                  <th scope="col">订单号</th>
		                  <th scope="col">市场总额</th>
		    							<th scope="col">实付总额</th>
		    							<th scope="col">购买数量</th>
		                  <th scope="col">创建时间</th>
		                </tr>
		                <tr>
		                  <td><?php echo $s['orderid'];?></td>
		                  <td><?php echo $s['beforetotalprice'];?></td>
		                  <td><?php echo $s['aftertotalprice'];?></td>
		                  <td><?php echo $s['buycount'];?></td>
		                  <td><?php echo $s['createtime'];?></td>
		                </tr>
		                <tr>
		                  <th colspan="6">商品信息</th>
		                </tr>
		                <tr>
		                  <td colspan="5">
		                  <?php foreach ($s['goods'] as $g):?>
		                      <a href="/goodDetail.php?act=detailedgood&gid=<?php echo $g['list_id'];?>"><img src="<?php echo '/'.$g['list_face'];?>" style="height:60px;"></a>
		                  <?php endforeach;?>
		                  </td>
		                  <td> <a href="/orders_show.php?id=<?php echo $s['orderid']?>">查看</a> </td>
		                </tr>
		  					</table>
		          <?php endforeach;?>
						<?php else:?>
							<span style="text-align: center;display:block;">暂无订单</span>
						<?php endif;?>
					</div>
					<?php if (!empty($leases_orders)):?>
					<div class="reg_title">租赁订单</div>
					<div class="reg_body">
		          <?php foreach ($leases_orders as $key => $s):?>
		            <?php if($key > 0):?>
		              <hr />
		            <?php endif;?>
		  					<table id="buylist" border="0" cellpadding="0" cellspacing="3" style="width: 100%;">
		                <tr>
		                  <th scope="col">订单号</th>
		                  <th scope="col">市场总额</th>
		    							<th scope="col">押金</th>
		    							<th scope="col">租赁数量</th>
		                  <th scope="col">租赁时间</th>
											<th scope="col">结束时间</th>
											<?php if(!empty($s['backtime'])):?>
											<th scope="col">归还时间</th>
											<?php endif;?>
		                </tr>
		                <tr>
		                  <td><?php echo $s['orderid'];?></td>
		                  <td><?php echo $s['beforetotalprice'];?></td>
		                  <td><?php echo $s['aftertotalprice'];?></td>
		                  <td><?php echo $s['buycount'];?></td>
		                  <td><?php echo $s['leasetime'];?></td>
											<td><?php echo $s['endtime'];?></td>
											<?php if(!empty($s['backtime'])):?>
											<td><?php echo $s['backtime'];?></td>
											<?php endif;?>
		                </tr>
		                <tr>
		                  <th colspan="6">商品信息</th>
		                </tr>
		                <tr>
											<?php if(empty($s['backtime'])):?>
												<?php $col = 6;?>
											<?php else:?>
												<?php $col = 7;?>
											<?php endif;?>
		                  <td colspan="<?php echo $col;?>">
		                  <?php foreach ($s['goods'] as $g):?>
		                      <a href="/leaseDetail.php?act=detailedlease&gid=<?php echo $g['list_id'];?>"><img src="<?php echo '/'.$g['list_face'];?>" style="height:60px;"></a>
		                  <?php endforeach;?>
		                  </td>
		                  <td> <a href="/orders_show.php?id=<?php echo $s['orderid']?>">查看</a> </td>
		                </tr>
		  					</table>
		          <?php endforeach;?>
					</div>
					<?php endif;?>
				</div>
			</div>
		</div>
		<div id="footer"><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<label>『 Right By Christy Lan 』</label></div>
	</div>
</body>
</html>
