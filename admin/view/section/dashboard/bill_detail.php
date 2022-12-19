<section>
  <div class="data__box_detail">
    <ul class="data__list_detail">
      <p style="color: white; background-color:red;" class="data__list__label_detail">Bill #<?= $bill_id ?></p>
      <p class="data__list__label_detail">Thông tin khách hàng</p>
      <?php
      $user_info_arr = explode(",", "$bill_detail[user_info]");
      ?>
      <li class="data__item_detail">
        <p class="data__item__label_detail">Họ và tên:</p>
        <p class="data__item__value_detail"><?= $user_info_arr[0] ?></p>
      </li>
      <li class="data__item_detail">
        <p class="data__item__label_detail">Email:</p>
        <p class="data__item__value_detail"><?= $user_info_arr[1] ?></p>
      </li>
      <li class="data__item_detail">
        <p class="data__item__label_detail">Số điện thoại:</p>
        <p class="data__item__value_detail"><?= $user_info_arr[2] ?></p>
      </li>
      <li class="data__item_detail">
        <p class="data__item__label_detail">Địa chỉ:</p>
        <p class="data__item__value_detail"><?= $user_info_arr[3] ?></p>
      </li>
    </ul>
    <ul class="data__list_detail">
      <p class="data__list__label_detail">Thông tin đơn hàng:</p>
      <li class="data__item_detail">
        <p class="data__item__label_detail">Đơn mua:</p>
        <?php
        $product_list = explode(",", "$bill_detail[san_pham_order]");

        ?>
        <p class="data__item__value_detail">
        <ul>
          <?php $total_bill = 0; ?>
          <?php foreach ($product_list as $key => $value) : ?>
            <?php
            $product_info = explode("/", "$value");
            $sql_select_product_price = "SELECT `gia_sp` FROM `san_pham` WHERE `ten_sp` = '$product_info[0]'";
            $product_price = pdo_query_one($sql_select_product_price);

            $total_each_product = $product_price['gia_sp'] * $product_info[3];
            $total_bill += $total_each_product;
            ?>
            <li class="sub_data_value_item_detail"><?= $product_info[0] ?> - Phân loại: <?= $product_info[1] ?>/<?= $product_info[2] ?> - Số lượng: <?= $product_info[3] ?></li>
          <?php endforeach ?>
        </ul>
        </p>
      </li>
      <li class="data__item_detail">
        <p class="data__item__label_detail">Thời gian đặt hàng:</p>
        <p class="data__item__value_detail"><?= $bill_detail['ngay_mua'] ?></p>
      </li>
      <li class="data__item_detail">
        <p class="data__item__label_detail">Thời gian dự kiến nhận hàng:</p>
        <p class="data__item__value_detail"><?= $bill_detail['ngay_nhan_hang'] ?></p>
      </li>
      <li class="data__item_detail">
        <p class="data__item__label_detail">Phương thức thanh toán:</p>
        <?php
        if ($bill_detail['phuong_thuc_thanh_toan'] == 2) {
          $payment_method = "Thanh toán online";
        } else if ($bill_detail['phuong_thuc_thanh_toan'] == 1) {
          $payment_method = "Thanh toán khi nhận hàng";
        }
        ?>
        <p class="data__item__value_detail"><?= $payment_method ?></p>
      </li>
      <li class="data__item_detail">
        <p class="data__item__label_detail">Tổng số tiền:</p>
        <p class="data__item__value_detail"><?= currency_format($total_bill) ?></p>
      </li>
    </ul>
    <?php if($bill_detail['trang_thai_bill'] == 0){ ?>
    <div class="data__value__btn">
      <a href="index.php?section=control_order&bill_id=<?= $bill_id ?>&confirm_bill" class="data__value__btn--link">
        <button class="btn__update">Xác nhận đơn</button>
      </a>
    </div>
    <div class="data__value__btn">
      <a href="index.php?section=control_order&bill_id=<?= $bill_id ?>&cancel_bill" class="data__value__btn--link">
        <button class="btn__delete">Huỷ đơn</button>
      </a>
    </div>
    <?php } ?>
  </div>
</section>