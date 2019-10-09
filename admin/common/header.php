<style media="screen">
    ul{
      list-style: none;
    }
    blockquote, body, button, dd, div, dl, dt, form, h1, h2, h3, h4, h5, h6, input, li, ol, p, pre, td, textarea, th, ul {
      margin: 0;
      padding: 0;
      -webkit-tap-highlight-color: rgba(0,0,0,0);
  }
  a{
    text-decoration: none;
  }
  .admin_header{
    width: 100%;
    height: 45px;
    background-color: #222;
  }
  .admin_header .logo a{
    float: left;
    font-size: 18px;
    padding-left: 20px;
    line-height: 45px;
    width: 200px;
    background-color: rgba(0,0,0,0);
    color: #fff;
  }
  .admin_header_right{
    position: relative;
    display: inline-block;
    line-height: 45px;
    vertical-align: middle;
    font-size: 12px;
    background-color: rgba(0,0,0,0);
    float: right;
    padding: 0 20px;
    color: #fff;
  }
  .admin_header_right a{
    color: #fff;
    display: block;
    padding: 0 20px;
    transition: all .3s;
    -webkit-transition: all .3s;
    float: left;
  }
  .admin_nav{
    position: absolute;
    top: 45px;
    bottom: 0px;
    left: 0;
    z-index: 2;
    padding-top: 10px;
    background-color: #EEEEEE;
    width: 100px;
    max-width: 100px;
    overflow: auto;
    overflow-x: hidden;
    overflow: hidden;
  }
  .admin_nav_side{
    width: 100px;
  }
  .admin_nav_side #nav li a {
    font-size: 14px;
    padding: 10px 15px 10px 15px;
    display: block;
    cursor: pointer;
    border-left: 4px solid transparent;
    transition: all 0.3s;
    color: #333;
  }
  .admin_content {
    position: absolute;
    top: 45px;
    right: 0;
    bottom: 0px;
    left: 100px;
    overflow: hidden;
    z-index: 1;
    overflow-y: scroll;
  }
</style>
<div class="admin_header">
  <div class="logo">
    <a href="/admin">estore管理系统后台</a>
  </div>
  <div class="admin_header_right">
    <a><?php echo $admin['user_name'];?></a>
    <a href="/" target="_blank">前台首页</a>
    <a href="/admin/logout.php?act=del">退出</a>
  </div>
</div>
<div class="admin_nav">
  <div class="admin_nav_side">
    <ul id="nav">
      <li><a href="/admin/cates/cates.php">分类管理</a></li>
      <li><a href="/admin/lists/lists.php">商品管理</a></li>
      <li><a href="/admin/leases/leases.php">租赁管理</a></li>
      <li><a href="/admin/orders/orders.php">订单管理</a></li>
      <li><a href="/admin/orders/leaseOrders.php">租赁订单</a></li>
      <li><a href="/admin/users/users.php">用户管理</a></li>
    </ul>
  </div>
</div>
