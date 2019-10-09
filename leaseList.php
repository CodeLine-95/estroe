<?php
include_once 'includes/lease.inc.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/functions.js"></script>
<title>租赁专区</title>
</head>
<body>
	<div id="container">
		<?php include 'header.php';?>
		<div id="wrapper">
				<div id="content" style="margin:0;overflow: hidden;">
				<div class="glist" style="width:auto;">
          <ul>
						<?php foreach ($two_arr as $one){?>
							<li>
								<a href="leaseDetail.php?act=detailedlease&gid=<?php echo $one['list_id'];?>">
									<img src="<?php echo $one['list_face'];?>" width="150" height="150" /></a>
								<p>【<?php echo $one['list_name'];?>】</p>
								<p>市场价格：￥<label class="quchu"><?php echo $one['list_onprice'];?></label></p>
								<?php if(empty($_COOKIE['user'])):?>
								<p class="red">本店价格：￥<?php echo $one['list_myprice']?></p>
								<?php else:?>
									<p class="red">本店价格：￥<?php echo $user['rebate']*$one['list_myprice']?></p>
								<?php endif;?>
								<p>库存量：<?php echo $one['list_nums'];?></p>
								<?php if(!empty($_COOKIE['user'])):?>
								<form action="afterOrder.php?act=leases&id=<?php echo $one['list_id'];?>" method="post">
								<p>购买数量：<input type="text" value="1" class="goodcount" name="buycount" id="6"/></p>
									<p><input type="submit" name="btn" class="bt" value="购买"/></p>
								</form>
								<?php endif;?>
							</li>
						<?php }?>
					</ul>
				</div>
			</div>
		</div>
		<div id="footer"><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<label>『 Right By Christy Lan 』</label></div>
	</div>
</body>
</html>
