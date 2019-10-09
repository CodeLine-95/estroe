<dl>
    <style media="screen">
      .box_list dd .active,.box_list dt .active{
        color: #ff0000;
      }
    </style>
    <?php foreach ($big as $item){?>
        <dt>
            <a <?php if($id == $item['big_id'] && $act=="goodslist"){echo 'class="active"';}?> href="goodsList.php?act=goodslist&cateid=<?php echo $item['big_id'];?>">『<?php echo $item['big_name'];?>』</a>
        </dt>
        <?php foreach ($twos as $ones){?>
            <?php if ($item['big_id']==$ones['big_id']){?>
                <dd>
                    |__ <a <?php if($id == $ones['small_id'] && $act=="listgoods"){echo 'class="active"';}?> href="goodsList.php?act=listgoods&cateid=<?php echo $ones['small_id'];?>"><?php echo $ones['small_name'];?></a>
                </dd>
            <?php }?>
        <?php }?>
    <?php }?>
</dl>
