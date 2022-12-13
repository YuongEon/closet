<div class="content">
    <div class="section section-1 payment_section">
      <div class="payment">
        <div class="payment__label--box">
          <p class="payment__label">Thanh toán</p>
        </div>
        <div class="payment__info">
          <div class="payment__info--wrap">
            <div class="payment__info__user">
              <div class="payment__info__user__label--box">
                <p class="payment__info__user__label">Thông tin khách hàng</p>
              </div>
              <div class="payment__info__user--wrap">
                <div class="payment__info__user--insert">
                  <div class="payment__info__user--insert--card">
                    <div class="user--insert--card--header">
                      <p class="user--insert--card--title">CLOSET Member</p>
                    </div>
                    <div class="user--insert--card__content">
                      <div class="user--insert--card__content--wrap">
                        <div class="user--insert--card__img--box">
                          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTyz-77X11MoGE22xVjjPhbpW6lPj6I0SkcTQ&usqp=CAU" alt="" class="insert--card__img--img">
                        </div>
                        <div class="user--insert--card__info--user--box">
                          <div class="info__user--box--value">
                            <p class="info__user--label">Họ và tên:</p>
                            <p class="info__user--value" id="fullName"><?= $user_info_arr['ho_va_ten'] ?></p>
                          </div>
                          <div class="info__user--box--value">
                            <p class="info__user--label">Email:</p>
                            <p class="info__user--value" id="email"><?= $user_info_arr['email'] ?></p>
                          </div>
                          <div class="info__user--box--value">
                            <p class="info__user--label">Số điện thoại:</p>
                            <?php $user_info_phone = "0$user_info_arr[sdt]" ?>
                            <p class="info__user--value" id="phone"><?= $user_info_phone ?></p>
                          </div>
                          <div class="info__user--box--value">
                            <div class="info__user--label">Địa chỉ:</div>
                            <?php
                            // convert address to array
                            $address_arr = explode(" / ", $user_info_arr['address']);
                            $address_arr = array_reverse($address_arr);
                            ?>
                            <p class="info__user--value"><span id="address3"><?= $address_arr[3] ?></span> / <span id="address2"><?= $address_arr[2] ?></span> / <span id="address1"><?= $address_arr[1] ?></span> / <span id="address0"><?= $address_arr[0] ?></span></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="payment__info__user--change">
                  <div class="payment__info__user--change--btn--wrap">
                    <div class="payment__info__user--change--btn update">Chỉnh sửa thông tin</div>
                    <div class="payment__info__user--change--btn insert">Giao hàng cho người thân</div>
                  </div>
                  <div class="payment__info__user--change--wrap">
                    <div class="user--change--box">
                      <form action="index.php?page=payment" method="post" class="payment__info__user--change__form">
                        <div class="form__control user--change__data--control">
                          <label for="" class="user--change__data--label">Họ và tên</label>
                          <input type="text" class="user--change__data--value" value="<?= $user_info_arr['ho_va_ten'] ?>" name="ho_va_ten" id="fullNameDataUpdate">
                        </div>
                        <div class="form__control user--change__data--control">
                          <label for="" class="user--change__data--label">Email</label>
                          <input type="text" class="user--change__data--value" value="<?= $user_info_arr['email'] ?>" name="email" id="emailDataUpdate">
                        </div>
                        <div class="form__control user--change__data--control">
                          <label for="" class="user--change__data--label">Số điện thoại</label>
                          <input type="text" class="user--change__data--value" name="sdt" value="<?= $user_info_phone ?>" id="phoneDataUpdate">
                        </div>
                        <div class="form__control user--change__data--control">
                          <label for="" class="user--change__data--label">Tỉnh / Thành phố</label>
                          <input type="text" class="user--change__data--value" value="<?= $address_arr[0] ?>" name="tinh__thanh_pho" id="address0DataUpdate">
                        </div>
                        <div class="form__control user--change__data--control">
                          <label for="" class="user--change__data--label">Quận / Huyện</label>
                          <input type="text" class="user--change__data--value" value="<?= $address_arr[1] ?>" name="quan__huyen" id="address1DataUpdate">
                        </div>
                        <div class="form__control user--change__data--control">
                          <label for="" class="user--change__data--label">Xã / Phường</label>
                          <input type="text" class="user--change__data--value" value="<?= $address_arr[2] ?>" name="phuong__xa" id="address2DataUpdate">
                        </div>
                        <div class="form__control user--change__data--control full-width">
                          <label for="" class="user--change__data--label">Địa chỉ chi tiết</label>
                          <input type="text" class="user--change__data--value" value="<?= $address_arr[3] ?>" name="dia_chi_chi_tiet" id="address3DataUpdate">
                        </div>
                        <div class="user--change__data--submit">
                          <button type="submit" name="user--change__data--submit--update">Lưu thông tin</button>
                        </div>
                      </form>
                    </div>
                    
                    <!-- payment__insert -->
                    <div class="user--change--box">
                      <form action="index.php?page=payment" method="post" class="payment__info__user--insert__form">
                        <div class="form__control user--change__data--control">
                          <label for="" class="user--change__data--label">Họ và tên</label>
                          <input type="text" class="user--change__data--value" name="ho_va_ten" id="fullNameDataInsert">
                        </div>
                        <div class="form__control user--change__data--control">
                          <label for="" class="user--change__data--label">Email</label>
                          <input type="text" class="user--change__data--value" name="email" id="emailDataInsert">
                        </div>
                        <div class="form__control user--change__data--control">
                          <label for="" class="user--change__data--label">Số điện thoại</label>
                          <input type="text" class="user--change__data--value" name="sdt" id="phoneDataInsert">
                        </div>
                        <div class="form__control user--change__data--control">
                          <label for="" class="user--change__data--label">Tỉnh / Thành phố</label>
                          <input type="text" class="user--change__data--value" name="tinh__thanh_pho" id="address0DataInsert">
                        </div>
                        <div class="form__control user--change__data--control">
                          <label for="" class="user--change__data--label">Quận / Huyện</label>
                          <input type="text" class="user--change__data--value" name="quan__huyen" id="address1DataInsert">
                        </div>
                        <div class="form__control user--change__data--control">
                          <label for="" class="user--change__data--label">Xã / Phường</label>
                          <input type="text" class="user--change__data--value" name="phuong__xa" id="address2DataInsert">
                        </div>
                        <div class="form__control user--change__data--control full-width">
                          <label for="" class="user--change__data--label">Địa chỉ chi tiết</label>
                          <input type="text" class="user--change__data--value" name="dia_chi_chi_tiet" id="address3DataInsert">
                        </div>
                        <div class="user--change__data--submit">
                          <button type="submit" name="user--change__data--submit--insert">Lưu thông tin</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- info cart -->
            <div class="payment__info__product--order">
              <div class="payment__info_product--order-card">
                <div class="payment__product--order--region">
                  <div class="payment__product--order--region--label--box">
                    <p class="payment__product--order--region--label">Danh sách sản phẩm đặt mua</p>
                  </div>
                  <!-- list product order -->
                  <div class="payment__product--order--region__content">
                    <ul class="payment__product--order--region__list">
                    <?php foreach ($cart_products as $cart_product_key => $cart_product_value) : ?>
                      <?php
                        $product = loading_product($cart_product_value['id_sp']);
                      ?>
                      <li class="payment__product--order--region__item">
                        <div class="product--order--region__img--box">
                          <img src="admin/<?= $product['anh_sp'] ?>" alt="" class="product--order--region__img--img">
                        </div>
                        <div class="product--order--region__content--box">
                          <p class="product--order--region__text--content"><?= $product['ten_sp'] ?></p>
                          <p class="product--order--region__classify"><?= strtoupper($cart_product_value['size']) ?> / <?= ucwords($cart_product_value['color']) ?></p>
                          <div class="product--order--region__price">
                            <p class="product--order--region__quantity">x <?= $cart_product_value['so_luong_sp'] ?></p>
                            <p class="product--order--region__each--price"><?= currency_format($product['gia_sp']) ?></p>
                          </div>
                        </div>
                      </li>
                      <?php endforeach ?>
                    </ul>
                  </div>
                </div>

                <div class="payment__order__total--region">
                  <div class="payment__order--bill--data">
                    <p class="payment__order--bill--data--label">Tiền sản phẩm</p>
                    <p class="payment__order--bill--data--value"><?= currency_format($total) ?></p>
                  </div>
                  <div class="payment__order--bill--data">
                    <p class="payment__order--bill--data--label">Ngày đặt hàng</p>
                    <p class="payment__order--bill--data--value"><?= $take_order_date ?></p>
                  </div>
                  <div class="payment__order--bill--data">
                    <p class="payment__order--bill--data--label">Thời gian nhận hàng</p>
                    <p class="payment__order--bill--data--value">Từ <?= $pick_up_date_soonest ?> đến <?= $pick_up_date_latest ?></p>
                  </div>
                  <div class="payment__order--bill--data">
                    <p class="payment__order--bill--data--label payment__order--bill--data--total">Tổng tiền</p>
                    <p class="payment__order--bill--data--value payment__order--bill--data--total"><?= currency_format($total) ?></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="payment__order">
          <div class="payment__order__pay--method--wrap">
          <?php foreach ($payment_methods as $payment_method_key => $payment_method_value) : ?>
            <div class="payment__order__pay--method--box">
              <input onclick="paymentSelected(<?= $payment_method_value['id_payment_method'] ?>)" name="pay-method-value" type="radio" value="<?= $payment_method_value['id_payment_method'] ?>" id="payment_method--<?= $payment_method_value['id_payment_method'] ?>" class="payment__order__pay--method--value">
              <label for="payment_method--<?= $payment_method_value['id_payment_method'] ?>" class="payment__order__pay--method--label"><?= $payment_method_value['ten_payment_method'] ?></label>
            </div>
            <?php endforeach ?>
          </div>
          <form action="index.php?page=payment" method="post" class="payment__order--form">
            <input type="hidden" name="fullName" value="<?= $user_info_arr['ho_va_ten'] ?>">
            <input type="hidden" name="email" value="<?= $user_info_arr['email'] ?>">
            <input type="hidden" name="phone_number" value="<?= $user_info_phone ?>">
            <input type="hidden" name="address" value="<?= $user_info_arr['address'] ?>">
            <input type="hidden" name="date_order" value="<?= $take_order_date ?>">
            <input type="hidden" name="date_take_order_latest" value="<?= $pick_up_date_latest ?>"/>
            <input type="hidden" name="date_take_order_soonest" value="<?= $pick_up_date_soonest ?>"/>
            <input type="hidden" name="total" value="<?= $total ?>">
            <input id="payment_method--checked" type="hidden" name="payment_method" value="">
            <button type="submit" name="isOrder--btn">Đặt hàng</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="js/new_payment_function.js"></script>