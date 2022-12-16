<section>
    <div class="nav_warp_change">
        <div class="nav_warp_change-boxes">
            <div class="box box1">
                <i class="fa-solid fa-shirt"></i>
                <span class="text">Tổng sản phẩm</span>
                <span class="number"><?= sizeof($product_without_id) ?></span>
            </div>
            <div class="box box2">
                <i class="fa-solid fa-user"></i>
                <span class="text">Tổng tài khoản</span>
                <span class="number"><?= sizeof($account_without_id) ?></span>
            </div>
            <div class="box box3">
                <i class="fa-brands fa-dropbox"></i>
                <span class="text">Tổng đơn hàng đã bán</span>
                <span class="number"><?= sizeof($bill_without_id) ?></span>
            </div>
        </div>
    </div>
    <div class="category_add">

    </div>

</section>
</div>
</main>