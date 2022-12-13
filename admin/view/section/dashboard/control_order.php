<?php

?>
<section>
  <div class="data__section__top__ability">
    <div class="data__section__search--box">
      <form method="POST" action="index.php?section=product_list" class="data__section__search--form">
        <input class="data__section__search--value" type="text" name="product__section__search--value" placeholder="Nhập mã đơn hàng...">
        <button type="submit" name="product__section__search--submit" class="data__section__search--submit">Tìm đơn hàng</button>
      </form>
    </div>
    <div class="data__section__function__btn__wrap">
    <div class="data__section__function__btn">
        <a href="index.php?section=insert_product" class="data__section__function__btn--link">
          <button>Đơn hàng đã xác nhận</button>
        </a>
      </div>
      <div class="data__section__function__btn">
        <a href="" class="data__section__function__btn--link">
          <button>Đơn hàng bị huỷ</button>
        </a>
      </div>
    </div>

  </div>
  <div class="data__table">
    <div class="data_table--head">
      <ul class="data__list">
        <li class="data__label--box">
          <p class="data__list--label">Mã đơn hàng</p>
        </li>
        <li class="data__label--box">
          <p class="data__list--label">Tên khách hàng</p>
        </li>
        <li class="data__label--box">
          <p class="data__list--label">Email</p>
        </li>
        <li class="data__label--box">
          <p class="data__list--label">Ngày đặt</p>
        </li>
        <li class="data__label--box">
          <p class="data__list--label">Chức năng</p>
        </li>
      </ul>
    </div>
    <div class="data_table--body">
      <?php foreach($bill_list as $bill_list_key => $bill_list_value): ?>
        <?php
                $user_info_string = $bill_list_value['user_info'];
                $user_info_arr_demo = explode("," ,$user_info_string);
                $user_info_arr = array(
                  "ho_va_ten" => "$user_info_arr_demo[0]",
                  "email" => "$user_info_arr_demo[1]",
                  "sdt" => "$user_info_arr_demo[2]",
                  "address" => "$user_info_arr_demo[3]"
                );
        ?>
      <ul class="data__list">
        <li class="data__value--box data__value--name--box">
          <div class="data__list--value data__value--name"><?= $bill_list_value['id_bill'] ?></div>
        </li>
        <!-- get user info -->
        <?php 
          $user_info = loading_user_info($bill_list_value['id_tai_khoan']);
        ?>
        <li class="data__value--box data__value--name--box">
          <div class="data__list--value data__value--name"><?= $user_info_arr['ho_va_ten'] ?></div>
        </li>
        <li class="data__value--box data__value--name--box">
          <div class="data__list--value data__value--name"><?= $user_info_arr['email'] ?></div>
        </li>
        <li class="data__value--box data__value--price--box">
          <div class="data__list--value data__value--price"><?= $bill_list_value['ngay_dat'] ?></div>
        </li>
        <li class="data__value--box">
          <div class="data__list--value data__value--btn--wrap">
            <div class="data__value__btn">
              <a href="" class="data__value__btn--link">
                <button class="btn__info">Chi Tiết đơn</button>
              </a>
            </div>
            <div class="data__value__btn">
              <a href="" class="data__value__btn--link">
                <button class="btn__update">Xác nhận đơn</button>
              </a>
            </div>
            <div class="data__value__btn">
              <a href="" class="data__value__btn--link">
                <button class="btn__delete">Huỷ đơn</button>
              </a>
            </div>
          </div>
        </li>
      </ul>
      <?php endforeach ?>
    </div>
  </div>
</section>