<?php
//调用mysqli
if (empty($_COOKIE['user'])) {
	echo "<script>alert('请登陆后访问');window.location='login.php';</script>";die;
}else{
	include_once 'includes/conn.php';
	//接收数据
	if ($_GET['act']=='detailedgood'){
		$act = $_GET['act'];
		$gid = $_GET['gid'];
	}
	//取出商品的字段名
	$show = $mysqli->query("show columns from list");
	if ($show){
		$str = "";
		while ($one = $show->fetch_row()){
			$str .= $one[0].",";
		}
	}
	$str = substr($str,0,-1);
	//点击次数
	$select = $mysqli->query("select list_seetimes from list where list_id={$gid}");
	if ($select) {
		while ($id = $select->fetch_assoc()) {
			$ida = $id;
		}
	}
	$update = $mysqli->query("update list set list_seetimes={$ida['list_seetimes']}+1 where list_id={$gid}");
	//执行SQL语句
	$res = $mysqli->query("select {$str} from list where list_id={$gid}");
	if ($res){
		while ($one_arr = $res->fetch_assoc()){
			$two_arr = $one_arr;
		}
	}

	//评价
	$evaluate = $mysqli->query("select evaluate.*,user.user_name,user.user_face from evaluate,user where evaluate.userid = user.user_id and list_id = ".$gid." order by evaluate.create_t desc");
	if ($evaluate) {
		while ($evaluate_one = $evaluate->fetch_assoc()) {
			$evaluate_arr[] = $evaluate_one;
		}
	}
	//关闭mysqli
	$mysqli->close();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/functions.js"></script>

<title>商品详细信息</title>
</head>
<body>
	<div id="container">
		<?php include 'header.php';?>
		<div id="wrapper">
			<div id="sidebar">
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
				<div id="goodinfo">
					<div class="gdImg">
						<img src="<?php echo $two_arr['list_face']?>" width="250" height="250">
						<span class="buy">
							<a href="cart.php?act=insert&type=list&id=<?php echo $gid;?>">购买</a>
						</span>
						<!-- <span class="fav">
							<a href="#">收藏</a>
						</span> -->
						<div class="clear"></div>
					</div>
					<div class="gdInfo">
						<h4><?php echo $two_arr['list_name']?></h4>
						<?php if(empty($_COOKIE['user'])):?>
						<p class="red">本店价格：<label style="color:red">￥<?php echo $two_arr['list_myprice']?></label></p>
						<?php else:?>
							<p class="red">本店价格：<label style="color:red">￥<?php echo $user['rebate']*$two_arr['list_myprice']?></label></p>
						<?php endif;?>
						<!-- <p>本店价格：<label style="color:red">￥<?php echo $two_arr['list_myprice']?></label></p> -->
						<p>市场价格：<label style="color:red">￥<?php echo $two_arr['list_onprice']?></label></p>
						<p>商品数量：<?php if(!empty($two_arr['list_nums'])){echo $two_arr['list_nums'];}else{echo "无限";}?></p>
						<p>上架时间：<?php echo $two_arr['list_time']?></p>
						<p>商品点击数：<?php echo $two_arr['list_seetimes']?></p>
						<?php if($two_arr['is_lease'] == 1):?>
							<p>租赁天数：<?php echo $two_arr['lease_time']?></p>
						<?php endif;?>
					</div>
					<div class="clear"></div>
				</div>
				<div id="goodtab1">
					<ul>
						<li class="tab1">商品介绍</li>
						<li class="tab2" onclick="changeTab('goodtab1','goodtab2',2)">评价信息</li>
					</ul>
					<div class="tabcontent">
						<p><?php echo $two_arr['list_detail']?></p>
					</div>
				</div>
				<div id="goodtab2">
					<ul>
						<li class="tab2" onclick="changeTab('goodtab1','goodtab2',1)">商品介绍</li>
						<li class="tab1">评价信息</li>
					</ul>
					<div class="tabcontent">
					<!-- 留言 -->
					<?php if(!empty($evaluate_arr)):?>
						<?php foreach ($evaluate_arr as $key => $e):?>
							<?php if($key == count($evaluate_arr)-1){$style='';}else{$style="border-bottom:1px solid #eeeeee;";}?>
							<div style="<?php echo $style?>overflow: hidden;margin:10px auto;">
								<div style="height:35px;width:35px;float:left;padding-right:10px;">
									<img src="images/<?php echo $e['user_face']?>.jpg" alt="<?php echo $e['user_name']?>" style="height:100%;">
								</div>
								<div style="float:left;width:553px;">
									<div style="height:30px;line-height:30px;">
										<div style="height:30px;line-height:30px;float:left;">
											<?php echo $e['user_name']?>
										</div>
										<div style="height:35px;line-height:35px;float:right;">
											<?php echo date('Y-m-d H:i:s',$e['create_t']);?>
										</div>
									</div>
									<div style="height:35px;line-height:35px;">
										<?php echo $e['text']?>
									</div>
								</div>
							</div>
						<?php endforeach;?>
					<?php endif?>
					</div>

					<?php if(!empty($_COOKIE['user'])):?>
					<div style="margin-top:10px;">
						<div style="background:#2975C9;color:#fff;height:30px;line-height:30px;padding-left:5px;">发表评价</div>
						<form class="tabcontent" action="evaluate_add.php" method="post">
							<div class="">
								评价内容： <input type="text" name="text" value="">
								<input type="hidden" name="userid" value="<?php echo $user['user_id'];?>">
								<input type="hidden" name="list_id" value="<?php echo $two_arr['list_id'];?>">
								<input type="hidden" name="act" value="list">
								<input type="submit" value="提交">
							</div>
						</form>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div id="footer"><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<label>『 Right By Christy Lan 』</label></div>
	</div>
</body>
</html>
