<section>
  <div class="data__section__top__ability">
    <div class="data__section__search--box">
      <form method="POST" action="index.php?section=user_list" class="data__section__search--form">
        <input class="data__section__search--value" type="text" name="user__section__search--value" placeholder="Nhập tên khách hàng...">
        <button type="submit" name="user__section__search--submit" class="data__section__search--submit">Tìm khách hàng</button>
      </form>
    </div>
    <div class="data__section__function__btn__wrap">
      <div class="data__section__function__btn">
        <a href="index.php?section=insert_user" class="data__section__function__btn--link">
          <button>Thêm mới khách hàng</button>
        </a>
      </div>
      <div class="data__section__function__btn">
        <a href="" class="data__section__function__btn--link">
          <button>Thống kê khách hàng</button>
        </a>
      </div>
    </div>

  </div>
  <div class="data__table">
    <div class="data_table--head">
      <ul class="data__list">
        <li class="data__label--box">
          <p class="data__list--label">Tên khách hàng</p>
        </li>
        <li class="data__label--box">
          <p class="data__list--label">Email</p>
        </li>
        <li class="data__label--box">
          <p class="data__list--label">Số điện thoại</p>
        </li>
        <li class="data__label--box">
          <p class="data__list--label">Trạng thái</p>
        </li>
      </ul>
    </div>
    <div class="data_table--body">
      <?php foreach($users as $user_key => $user_value): ?>
      <ul class="data__list">
        <li class="data__value--box data__value--name--box">
          <div class="data__list--value data__value--name"><?= $user_value['ho_va_ten'] ?></div>
        </li>
        <li class="data__value--box data__value--name--box">
          <div class="data__list--value data__value--quantity"><?= $user_value['email'] ?></div>
        </li>
        <li class="data__value--box data__value--price--box">
          <div class="data__list--value data__value--price">0<?= $user_value['sdt'] ?></div>
        </li>
        <li class="data__value--box data__value--price--box">
          <?php
            if($user_value['trang_thai'] == 1){
              $account_status = "Hoạt động";
            } else if($user_value['trang_thai'] == 2){
              $account_status = "Bị chặn";
            }
          ?>
          <div class="data__list--value data__value--price"><?= $account_status ?></div>
        </li>
      </ul>
      <?php endforeach ?>
    </div>
  </div>
</section>