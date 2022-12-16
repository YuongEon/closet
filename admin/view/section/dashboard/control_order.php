<section>
  <div class="data__section__top__ability">
    <div class="data__section__search--box">
      <form method="POST" action="index.php?section=control_order" class="data__section__search--form">
        <input class="data__section__search--value" type="text" name="order__section__search--value" placeholder="Nhập mã đơn hàng...">
        <button type="submit" name="order__section__search--submit" class="data__section__search--submit">Tìm đơn hàng</button>
      </form>
    </div>
    <div class="data__section__function__btn__wrap">
    <div class="data__section__function__btn">
        <a href="index.php?section=control_order&bill_status=0" class="data__section__function__btn--link">
          <button>Đơn hàng chờ xác nhận</button>
        </a>
      </div>
      <div class="data__section__function__btn">
        <a href="index.php?section=control_order&bill_status=1" class="data__section__function__btn--link">
          <button>Đơn hàng đã xác nhận</button>
        </a>
      </div>
      <div class="data__section__function__btn">
        <a href="index.php?section=control_order&bill_status=3" class="data__section__function__btn--link">
          <button>Đơn hàng đã huỷ</button>
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
          <p class="data__list--label">Trạng thái bill</p>
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
          <?php
            switch($bill_list_value['trang_thai_bill']){
              case 0:
                $bill_status = "Chờ xác nhận";
                break;
              case 1:
                $bill_status = "Đang giao";
                break;
              case 2:
                $bill_status = "Đã giao";
                break;
              case 3:
                $bill_status = "Đã huỷ";
            }
          ?>
          <div class="data__list--value data__value--price"><?=  $bill_status ?></div>
        </li>
        <li class="data__value--box">
          <div class="data__list--value data__value--btn--wrap">
            <div class="data__value__btn">
              <a href="index.php?section=bill_detail&bill_id=<?= $bill_list_value['id_bill'] ?>" class="data__value__btn--link">
                <button class="btn__info">Chi Tiết đơn</button>
              </a>
            </div>
          </div>
        </li>
      </ul>
      <?php endforeach ?>
    </div>
  </div>
</section>