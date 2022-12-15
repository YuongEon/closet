<section>
  <div class="data__section__top__ability">
    <div class="data__section__search--box">
      <form method="POST" action="index.php?section=comment_list" class="data__section__search--form">
        <input class="data__section__search--value" type="text" name="comment__section__search--value" placeholder="Nhập tên sản phẩm...">
        <button type="submit" name="comment__section__search--submit" class="data__section__search--submit">Tìm đánh giá</button>
      </form>
    </div>
    <div class="data__section__function__btn__wrap">
      <div class="data__section__function__btn">
        <a href="" class="data__section__function__btn--link">
          <button>Thống kê bình luận</button>
        </a>
      </div>
    </div>

  </div>
  <div class="data__table">
    <div class="data_table--head">
      <ul class="data__list">
        <li class="data__label--box">
          <p class="data__list--label">Tên sản phẩm</p>
        </li>
        <li class="data__label--box">
          <p class="data__list--label">Tên khách hàng</p>
        </li>
        <li class="data__label--box">
          <p class="data__list--label">Số sao đánh giá</p>
        </li>
        <li class="data__label--box">
          <p class="data__list--label">Nội dung bình luận</p>
        </li>
        <li class="data__label--box">
          <p class="data__list--label">Chức năng</p>
        </li>
      </ul>
    </div>
    <div class="data_table--body">
      <?php foreach($comment_detail as $comment_detail_key => $comment_detail_value): ?>
      <ul class="data__list">
        <li class="data__value--box data__value--name--box">
          <?php 
            $sql_loading_product_info = "SELECT * FROM `san_pham` WHERE `id_sp` = '$comment_detail_value[id_sp]'";
            $product_info = pdo_query_one($sql_loading_product_info);
          ?>
          <div class="data__list--value data__value--name"><?= $product_info['ten_sp'] ?></div>
        </li>
        <li class="data__value--box data__value--name--box">
          <?php 
            $user_info = loading_user_info($comment_detail_value['id_tai_khoan']);
          ?>
          <div class="data__list--value data__value--quantity"><?= $user_info['ho_va_ten'] ?></div>
        </li>
        <li class="data__value--box data__value--name--box">
          <div class="data__list--value data__value--quantity"><?= $comment_detail_value['sao_danh_gia'] ?></div>
        </li>
        <li class="data__value--box data__value--name--box">
          <div class="data__list--value data__value--quantity"><?= $comment_detail_value['noi_dung_binh_luan'] ?></div>
        </li>
        <li class="data__value--box">
          <div class="data__list--value data__value--btn--wrap">
            <div class="data__value__btn">
              <a href="index.php?section=comment_list&comment_id_delete=<?= $comment_detail_value['id_binh_luan'] ?>" class="data__value__btn--link">
                <button class="btn__delete">Xoá</button>
              </a>
            </div>
          </div>
        </li>
      </ul>
      <?php endforeach ?>
    </div>
  </div>
</section>