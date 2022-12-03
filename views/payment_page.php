<div class="content">
  <div class="section section-1 payment_section">
    <div class="payment">
      <div class="payment__product__selected">
        <div class="product__selected__title">
          <p>Danh sách sản phẩm chọn mua :</p>
        </div>
        <ul class="product__selected__list">
          <?php foreach ($cart_products as $cart_product_key => $cart_product_value) : ?>
            <?php
            $product = loading_product($cart_product_value['id_sp']);
            ?>
            <li class="product__selected__item"><?= $product['ten_sp'] ?> ✖ SL: <?= $cart_product_value['so_luong_sp'] ?> | PL: <?= strtoupper($cart_product_value['size']) ?>, <?= ucwords($cart_product_value['color']) ?></li>
          <?php endforeach ?>
        </ul>
      </div>
      <div class="payment__buying__info">
        <div class="payment__user__info">
          <div class="payment__user__info__insert">
            <p class="payment__user__info__insert__title">Thông tin khách hàng :</p>
            <div class="payment__user__info__insert__wrap">
              <div class="payment__user__info__insert__value__wrap">
                <p class="payment__user__info__insert__value__name">Họ và tên:</p>
                <p class="payment__user__info__insert__value"><?= $user_info_arr['ho_va_ten'] ?></p>
              </div>
              <div class="payment__user__info__insert__value__wrap">
                <p class="payment__user__info__insert__value__name">Email:</p>
                <p class="payment__user__info__insert__value"><?= $user_info_arr['email'] ?></p>
              </div>
              <div class="payment__user__info__insert__value__wrap">
                <p class="payment__user__info__insert__value__name">Số điện thoại:</p>
                <?php $user_info_phone = "0$user_info_arr[sdt]" ?>
                <p class="payment__user__info__insert__value"><?= $user_info_phone ?></p>
              </div>
              <div class="payment__user__info__insert__value__wrap">
                <p class="payment__user__info__insert__value__name">Địa chỉ:</p>
                <?php

                ?>
                <p class="payment__user__info__insert__value"><?= $user_info_arr['address'] ?></p>
              </div>
            </div>
          </div>
          <div class="payment__user__info__update">
            <?php
            // convert address to array
            $address_arr = explode(" / ", $user_info_arr['address']);
            $address_arr = array_reverse($address_arr);
            ?>
            <div class="payment__user__info__update__function">
              <button class="payment__info__update__submit">Chỉnh sửa thông tin, địa chỉ nhận hàng</button>
              <form action="index.php?page=payment_page" method="POST" class="payment__info__update__form">
                <div class="payment__form__control">
                  <label class="payment__form__filed__name" for="">Email</label>
                  <input type="text" name="email" value="<?= $user_info_arr['email'] ?>">
                </div>
                <div class="payment__form__control">
                  <label class="payment__form__filed__name" for="">Số điện thoại</label>
                  <input type="text" name="sdt" value="<?= $user_info_phone ?>">
                </div>
                <div class="payment__form__control">
                  <label class="payment__form__filed__name" for="">Tỉnh / Thành phố</label>
                  <input type="text" name="tinh__thanh_pho" value="<?= $address_arr[0] ?>">
                </div>
                <div class="payment__form__control">
                  <label class="payment__form__filed__name" for="">Quận / Huyện</label>
                  <input type="text" name="quan__huyen" value="<?= $address_arr[1] ?>">
                </div>
                <div class="payment__form__control">
                  <label class="payment__form__filed__name" for="">Xã / Phường</label>
                  <input type="text" name="phuong__xa" value="<?= $address_arr[2] ?>">
                </div>
                <div class="payment__form__control">
                  <label class="payment__form__filed__name" for="">Địa chỉ chi tiết</label>
                  <input type="text" name="dia_chi_chi_tiet" value="<?= $address_arr[3] ?>">
                </div>
                <button class="payment__info__submit--btn" type="submit" name="payment__info__update__submit--btn">Lưu thông tin</button>
              </form>
            </div>

            <div class="payment__user__info__insert__function">
              <button class="payment__info__insert__submit">Giao hàng cho người nhận khác</button>
              <form action="index.php?page=payment_page" method="POST" class="payment__info__insert__form">
                <div class="payment__form__control">
                  <label class="payment__form__filed__name" for="">Tên người nhận</label>
                  <input type="text" name="ho_va_ten">
                </div>
                <div class="payment__form__control">
                  <label class="payment__form__filed__name" for="">Số điện thoại</label>
                  <input type="text" name="sdt">
                </div>
                <div class="payment__form__control">
                  <label class="payment__form__filed__name" for="">Email</label>
                  <input type="text" name="email">
                </div>
                <div class="payment__form__control">
                  <label class="payment__form__filed__name" for="">Tỉnh / Thành phố</label>
                  <input type="text" name="tinh__thanh_pho">
                </div>
                <div class="payment__form__control">
                  <label class="payment__form__filed__name" for="">Quận / Huyện</label>
                  <input type="text" name="quan__huyen">
                </div>
                <div class="payment__form__control">
                  <label class="payment__form__filed__name" for="">Xã / Phường</label>
                  <input type="text" name="phuong__xa">
                </div>
                <div class="payment__form__control">
                  <label class="payment__form__filed__name" for="">Địa chỉ chi tiết</label>
                  <input type="text" name="dia_chi_chi_tiet">
                </div>
                <button class="payment__info__submit--btn" type="submit" name="payment__info__insert__submit--btn">Lưu thông tin</button>
              </form>
            </div>
          </div>
        </div>
        <div class="payment__buying__method">
          <p class="payment__buying__method__title">Lựa chọn phương thức thanh toán</p>
          <div class="payment__buying__method__wrap">
            <?php foreach ($payment_methods as $payment_method_key => $payment_method_value) : ?>
              <div class="payment__buying__method__value">
                <input <?php echo ($payment_method_value['id_payment_method'] == 1) ? 'checked' : '' ?> type="radio" name="payment__method" value="<?= $payment_method_value['id_payment_method'] ?>">
                <p class="payment__buying__method__value__name"><?= $payment_method_value['ten_payment_method'] ?></p>
              </div>
            <?php endforeach ?>
          </div>
        </div>
        <div class="payment__buying_date--box">
          <p>Ngày đặt hàng: <?= $take_order_date ?></p>
          <p>Nhận hàng từ <?= $pick_up_date_soonest ?> đến <?= $pick_up_date_latest ?></p>
        </div>
        <div class="payment__buying__pay">
          <div class="pay__total__box">
            <p class="pay__total__title">Tổng thành tiền :</p>
            <p class="pay__total__price"><?= $total ?> đ</p>
          </div>
          <div class="pay__btn">
            <a href="" class="pay__btn--link">
              <button class="pay__btn--btn">Đặt hàng</button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="js/payment.js"></script>