<ul id="right_menu">

    <li id="li_menu_product">
        <a href="<?= url('admin/product') ?>">
            <div class="products"></div>
            <div>محصولات</div>
        </a>
        <ul class="sub_menu" id="sub_product">
            <li><a href="<?= url('admin/product/create') ?>">محصول جدید</a></li>
            <li><a href="<?= url('admin/product') ?>">مدیریت محصولات</a></li>
            <li><a href="<?= url('admin/category/create') ?>">دسته جدید</a></li>
            <li><a href="<?= url('admin/category') ?>">مدیریت دسته های</a></li>
        </ul>
    </li>


    <li  id="li_menu_order">
        <a href="<?= url('admin/order') ?>">
            <div class="orders"></div>
            <div>

                <span>سفارشات</span>
                <?php

                $row=DB::table('order')->where('order_read','no')->count();
                if($row>0)
                {
                    ?><span style="color:#ff0000">(<?= $row ?>)</span><?php
                }
                ?>
            </div>
        </a>
    </li>





    <li>
        <a>
            <div class="froosh"></div>
            <div>آمار فروش کالا</div>
        </a>
    </li>

    <li id="li_menu_comment">
        <a href="<?= url('admin/comment') ?>">
            <div class="comment"></div>
            <span>نظرات</span>
            <?php

            $row=DB::table('comment')->where('state',0)->count();
            if($row>0)
            {
                ?><span style="color:#ff0000">(<?= $row ?>)</span><?php
            }
            ?>
        </a>
    </li>



</ul>