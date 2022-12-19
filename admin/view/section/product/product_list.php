<?php
    // delete product don't have quantity and classify
    $sql_select_to_product = "SELECT * FROM san_pham";
    $product_invalid = pdo_query($sql_select_to_product);
  
    foreach($product_invalid as $product_invalid_item){
      $sql_select_to_classify = "SELECT * FROM `phan_loai` WHERE `id_sp` = '$product_invalid_item[id_sp]'";
      $product_classify = pdo_query($sql_select_to_classify);
      
      if(sizeof($product_classify) == 0){
        $sql_delete_product_invalid = "DELETE FROM `san_pham` WHERE `id_sp` = '$product_invalid_item[id_sp]'";
        pdo_execute($sql_delete_product_invalid);
        header("location: index.php?section=product_list");
        ob_end_flush();
      }
    }

?>
<section>
  <div class="data__section__top__ability">
    <div class="data__section__search--box">
      <form method="POST" action="index.php?section=product_list" class="data__section__search--form">
        <input class="data__section__search--value" type="text" name="product__section__search--value" placeholder="Nhập tên sản phẩm...">
        <button type="submit" name="product__section__search--submit" class="data__section__search--submit">Tìm sản phẩm</button>
      </form>
    </div>
    <div class="data__section__function__btn__wrap">
      <div class="data__section__function__btn">
        <a href="index.php?section=insert_product" class="data__section__function__btn--link">
          <button>Thêm mới sản phẩm</button>
        </a>
      </div>
      <div class="data__section__function__btn">
        <a href="" class="data__section__function__btn--link">
          <button>Thống kê sản phẩm</button>
        </a>
      </div>
    </div>

  </div>
  <div class="data__table">
    <div class="data_table--head">
      <ul class="data__list">
        <li class="data__label--box">
          <p class="data__list--label">Ảnh sản phẩm</p>
        </li>
        <li class="data__label--box">
          <p class="data__list--label">Tên sản phẩm</p>
        </li>
        <li class="data__label--box">
          <p class="data__list--label">Số lượng sản phẩm</p>
        </li>
        <li class="data__label--box">
          <p class="data__list--label">Giá sản phẩm</p>
        </li>
        <li class="data__label--box">
          <p class="data__list--label">Chức năng</p>
        </li>
      </ul>
    </div>
    <div class="data_table--body">
      <?php foreach($products as $product_key => $product_value): ?>
      <ul class="data__list">
        <li class="data__value--box">
          <div class="data__list--value data__img--box">
            <?php $path_product_img = "$product_value[anh_sp]" ?>
            <img class="data__img" src="<?= $path_product_img ?>" alt="<? $product_value['ten_sp'] ?>">
          </div>
        </li>
        <li class="data__value--box data__value--name--box">
          <div class="data__list--value data__value--name"><?= $product_value['ten_sp'] ?></div>
        </li>
        <li class="data__value--box data__value--name--box">
          <?php 
            $sql_product_quantity_arr = "SELECT `so_luong_sp` FROM `phan_loai` WHERE `id_sp` = $product_value[id_sp]";
            $product_quantity_arr = pdo_query($sql_product_quantity_arr);
            $total_product_quantity = 0;

            foreach($product_quantity_arr as $product_quantity_arr_value){
              $total_product_quantity += $product_quantity_arr_value['so_luong_sp'];
            }
          ?>
          <div class="data__list--value data__value--quantity"><?= $total_product_quantity ?></div>
        </li>
        <li class="data__value--box data__value--price--box">
          <div class="data__list--value data__value--price"><?= currency_format($product_value['gia_sp']) ?></div>
        </li>
        <li class="data__value--box">
          <div class="data__list--value data__value--btn--wrap">
            <div class="data__value__btn">
              <a href="../index.php?page=product_detail&id_product=<?= $product_value['id_sp'] ?>" class="data__value__btn--link">
                <button class="btn__info">Chi Tiết</button>
              </a>
            </div>
            <div class="data__value__btn">
              <a href="index.php?section=product_update_section&product_id=<?= $product_value['id_sp'] ?>" class="data__value__btn--link">
                <button class="btn__update">Chỉnh sửa</button>
              </a>
            </div>
            <div class="data__value__btn">
              <a href="index.php?section=product_update_section&product_id_delete=<?= $product_value['id_sp'] ?>" class="data__value__btn--link">
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