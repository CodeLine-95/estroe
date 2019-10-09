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
			<div id="contentCenter">
				<div id="register">
					<div class="reg_title">购物订单</div>
					<div class="reg_body">
						<?php if (!empty($orders)):?>
		          <?php foreach ($orders as $key => $s):?>
		            <?php if($key > 0):?>
		              <hr />
		            <?php endif;?>
		  					<table id="buylist" border="0" cellpadding="0" cellspacing="3">
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
				</div>
			</div>
		</div>
		<div id="footer"><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<label>『 Right By Christy Lan 』</label></div>
	</div>
</body>
</html>
