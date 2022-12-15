<section>
  <div class="data__section__top__ability">
    <div class="data__section__search--box">
      <form method="POST" action="index.php?section=brand_list" class="data__section__search--form">
        <input class="data__section__search--value" type="text" name="brand__section__search--value" placeholder="Nhập tên brand...">
        <button type="submit" name="brand__section__search--submit" class="data__section__search--submit">Tìm brand</button>
      </form>
    </div>
    <div class="data__section__function__btn__wrap">
      <div class="data__section__function__btn">
        <a href="index.php?section=insert_brand" class="data__section__function__btn--link">
          <button>Thêm mới brand</button>
        </a>
      </div>
      <div class="data__section__function__btn">
        <a href="" class="data__section__function__btn--link">
          <button>Thống kê brand</button>
        </a>
      </div>
    </div>

  </div>
  <div class="data__table">
    <div class="data_table--head">
      <ul class="data__list">
        <li class="data__label--box">
          <p class="data__list--label">Tên brand</p>
        </li>
        <li class="data__label--box">
          <p class="data__list--label">Số lượng sản phẩm thuộc brand</p>
        </li>
        <li class="data__label--box">
          <p class="data__list--label">Chức năng</p>
        </li>
      </ul>
    </div>
    <div class="data_table--body">
      <?php foreach($brands as $brand_key => $brand_value): ?>
      <ul class="data__list">
        <li class="data__value--box data__value--name--box">
          <div class="data__list--value data__value--name"><?= $brand_value['ten_brand'] ?></div>
        </li>
        <li class="data__value--box data__value--name--box">
          <?php 
            $sql_brand_quantity_product_arr = "SELECT * FROM `san_pham` WHERE `brand` = $brand_value[id_brand]";
            $brand_quantity_product_arr = pdo_query($sql_brand_quantity_product_arr);
            $total_brand_quantity_product = sizeof($brand_quantity_product_arr);
          ?>
          <div class="data__list--value data__value--quantity"><?= $total_brand_quantity_product ?></div>
        </li>
        <li class="data__value--box">
          <div class="data__list--value data__value--btn--wrap">
            <div class="data__value__btn">
              <a href="index.php?section=update_brand&brand_id=<?= $brand_value['id_brand'] ?>" class="data__value__btn--link">
                <button class="btn__update">Chỉnh sửa</button>
              </a>
            </div>
            <div class="data__value__btn">
              <a href="index.php?section=brand_list&brand_id_delete=<?= $brand_value['id_brand'] ?>" class="data__value__btn--link">
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