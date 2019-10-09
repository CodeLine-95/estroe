
<div id="header">
  <style media="screen">
    #nav li a.active{
      color: #ff0000;
    }
  </style>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <div id="nav_user">
    <span style="color:yellow">
      <?php if(!empty($_COOKIE['user'])){?>
        <?php $user = json_decode($_COOKIE['user'],true);?>
        您好,<?php echo $user['user_name'];?>
      <?php }else{ ?>
      <a href="login.php">你还没登录！</a>
      <a href="register.php">注册</a>
      <?php }?>
      </span>
    <?php if (!empty($_COOKIE['user'])){?>
      <a href="cart.php?act=show">购物车</a>
    <?php }?>
    <a href="orders.php">结帐中心</a>
    <!-- <a href="vendors.php">用户管理</a> -->
    <?php if (!empty($_COOKIE['user'])){?>
      <?php $user = json_decode($_COOKIE['user'],true);?>
      <?php if($user['user_roleid'] == 3):?>
      <a href="/admin/">后台管理</a>
      <?php endif;?>
      <a href="logout.php?act=del">注销</a>
    <?php }?>
  </div>
</div>
<div id="nav">
  <ul>
    <li><span><a href="index.php">首页</a></span></li>
    <li><span><a href="goodsList.php?act=goodslist" <?php if($act == 'goodslist' || $act=="detailedgood"){echo 'class="active"';}?>>商品专区</a></span></li>
    <li><span><a href="leaseList.php?act=leaselist" <?php if($act == 'leaselist' || $act=="detailedlease"){echo 'class="active"';}?>>租赁专区</a></span></li>
    <!-- <li><span><a href="vendors.php">用户中心</a></span></li> -->
    <?php if (!empty($_COOKIE['user'])){?>
      <?php $user = json_decode($_COOKIE['user'],true);?>
      <?php if($user['user_roleid'] == 3):?>
      <li><span><a href="/admin/">后台管理</a></span></li>
      <?php endif;?>
    <?php }?>
  </ul>
</div>
