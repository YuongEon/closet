<section>
  <div class="data__section__top__ability">
    <div class="data__section__search--box">
      
    </div>
    <div class="data__section__function__btn__wrap">
      <div class="data__section__function__btn">
        <a href="index.php?section=add_classify&product_id=<?= $product_id ?>" class="data__section__function__btn--link">
          <button>Thêm mới phân loại</button>
        </a>
      </div>
    </div>

  </div>
  <div class="data__table">
    <div class="data_table--head">
      <ul class="data__list">
        <li class="data__label--box">
          <p class="data__list--label">Size</p>
        </li>
        <li class="data__label--box">
          <p class="data__list--label">Màu</p>
        </li>
        <li class="data__label--box">
          <p class="data__list--label">Số sản phẩm loại thuộc phân loại</p>
        </li>
        <li class="data__label--box">
          <p class="data__list--label">Chức năng</p>
        </li>
      </ul>
    </div>
    <div class="data_table--body">
      <?php foreach($classify_of_product as $classify_of_product_key => $classify_of_product_value): ?>
      <ul class="data__list">
        <li class="data__value--box data__value--name--box">
          <div class="data__list--value data__value--name"><?= $classify_of_product_value['size'] ?></div>
        </li>
        <li class="data__value--box data__value--name--box">
          <div class="data__list--value data__value--name"><?= $classify_of_product_value['color'] ?></div>
        </li>
        <li class="data__value--box data__value--name--box">
          <div class="data__list--value data__value--name"><?= $classify_of_product_value['so_luong_sp'] ?></div>
        </li>
        <li class="data__value--box">
          <div class="data__list--value data__value--btn--wrap">
            <div class="data__value__btn">
              <a href="index.php?section=classify_setting&product_id=<?= $classify_of_product_value['id_sp'] ?>&size=<?= $classify_of_product_value['size'] ?>&color=<?= $classify_of_product_value['color'] ?>&isDelete=true" class="data__value__btn--link">
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