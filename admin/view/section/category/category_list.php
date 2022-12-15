<section>
  <div class="data__section__top__ability">
    <div class="data__section__search--box">
      <form method="POST" action="index.php?section=category_list" class="data__section__search--form">
        <input class="data__section__search--value" type="text" name="category__section__search--value" placeholder="Nhập tên danh mục...">
        <button type="submit" name="category__section__search--submit" class="data__section__search--submit">Tìm danh mục</button>
      </form>
    </div>
    <div class="data__section__function__btn__wrap">
      <div class="data__section__function__btn">
        <a href="index.php?section=insert_category" class="data__section__function__btn--link">
          <button>Thêm mới danh mục</button>
        </a>
      </div>
      <div class="data__section__function__btn">
        <a href="" class="data__section__function__btn--link">
          <button>Thống kê danh mục</button>
        </a>
      </div>
    </div>

  </div>
  <div class="data__table">
    <div class="data_table--head">
      <ul class="data__list">
        <li class="data__label--box">
          <p class="data__list--label">Tên danh mục</p>
        </li>
        <li class="data__label--box">
          <p class="data__list--label">Số lượng danh mục thuộc danh mục</p>
        </li>
        <li class="data__label--box">
          <p class="data__list--label">Chức năng</p>
        </li>
      </ul>
    </div>
    <div class="data_table--body">
      <?php foreach($categories as $category_key => $category_value): ?>
      <ul class="data__list">
        <li class="data__value--box data__value--name--box">
          <div class="data__list--value data__value--name"><?= $category_value['ten_loai_sp'] ?></div>
        </li>
        <li class="data__value--box data__value--name--box">
          <?php 
            $sql_category_quantity_product_arr = "SELECT * FROM `san_pham` WHERE `loai_sp` = $category_value[id_loai_sp]";
            $category_quantity_product_arr = pdo_query($sql_category_quantity_product_arr);
            $total_category_quantity_product = sizeof($category_quantity_product_arr);
          ?>
          <div class="data__list--value data__value--quantity"><?= $total_category_quantity_product ?></div>
        </li>
        <li class="data__value--box">
          <div class="data__list--value data__value--btn--wrap">
            <div class="data__value__btn">
              <a href="index.php?section=update_category&category_id=<?= $category_value['id_loai_sp'] ?>" class="data__value__btn--link">
                <button class="btn__update">Chỉnh sửa</button>
              </a>
            </div>
            <div class="data__value__btn">
              <a href="index.php?section=category_list&category_id_delete=<?= $category_value['id_loai_sp'] ?>" class="data__value__btn--link">
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