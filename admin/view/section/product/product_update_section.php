<section>
  <div class="insert__data__section">
    <div class="insert__data__section--wrap">
      <div class="insert__data_label--box">
        <p class="insert__data__label"><?=  $product_id_selected_info['ten_sp'] ?></p>
      </div>

      <div class="insert__data__wrap">
        <form method="POST" action="index.php?section=product_update_section&product_id=<?= $product_id_selected_info['id_sp'] ?>" class="insert__data__form" enctype="multipart/form-data">
          <div class="form__control">
            <div class="form__control--wrap">
              <label class="form__control--name">Tên sản phẩm</label>
              <input type="text" name="ten_sp" class="form__control--value" placeholder="Nhập tên sản phẩm..." value="<?=  $product_id_selected_info['ten_sp'] ?>">
            </div>
          </div>
          <div class="form__control">
            <div class="form__control--wrap">
              <label class="form__control--name">Ảnh sản phẩm</label>
              <div class="product_selected_img--box" style="width: 140px; height: 140px; overflow: hidden; padding-top: 10px">
                <img style="width: 100%; height: 100%; object-fit: cover;" src="<?=  $product_id_selected_info['anh_sp'] ?>" alt="<?=  $product_id_selected_info['ten_sp'] ?>"/>
              </div>
              <input type="file" name="anh_sp" class="form__control--value form__control--value__img" placeholder="Nhập ảnh sản phẩm...">
            </div>
          </div>
          <div class="form__control">
            <div class="form__control--wrap">
              <label class="form__control--name">Giá sản phẩm</label>
              <input type="text" name="gia_sp" class="form__control--value" placeholder="Nhập giá sản phẩm..." value="<?=  $product_id_selected_info['gia_sp'] ?>">
            </div>
          </div>
          <div class="form__control">
            <div class="form__control--wrap">
              <label class="form__control--name">Giảm giá sản phẩm</label>
              <input type="text" name="giam_gia_sp" class="form__control--value" placeholder="Nhập giảm giá sản phẩm..." value="<?=  $product_id_selected_info['giam_gia_sp'] ?>">
            </div>
          </div>
          <div class="form__control">
            <div class="form__control--wrap">
              <label class="form__control--name">Danh mục sản phẩm</label>
              <?php $product_category_without_id_product = loading_product_category_without_id_product() ?>
              <select name="loai_sp" class="form__control--value form__control--value--select">
                <?php foreach($product_category_without_id_product as $product_category_without_id_product_key => $product_category_without_id_product_value): ?>
                <option <?php  echo ($product_category_without_id_product_value['id_loai_sp'] == $product_id_selected_info['loai_sp'])? 'selected' : ''; ?> value="<?= $product_category_without_id_product_value['id_loai_sp'] ?>" ><?= $product_category_without_id_product_value['ten_loai_sp'] ?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>
          <div class="form__control">
            <div class="form__control--wrap">
              <label class="form__control--name">Danh mục sản phẩm</label>
              <?php $product_brand_without_id_product = loading_product_brand_without_id_product() ?>
              <select name="brand" class="form__control--value form__control--value--select">
                <?php foreach($product_brand_without_id_product as $product_brand_without_id_product_key => $product_brand_without_id_product_value): ?>
                <option <?php  echo ($product_brand_without_id_product_value['id_brand'] == $product_id_selected_info['brand'])? 'selected' : ''; ?>  value="<?= $product_brand_without_id_product_value['id_brand'] ?>" ><?= $product_brand_without_id_product_value['ten_brand'] ?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>
          <div class="form__control">
            <div class="form__control--wrap">
              <label class="form__control--name">Mô tả ngắn sản phẩm</label>
              <textarea placeholder="Nhập mô tả ngắn sản phẩm..." name="mo_ta_ngan_sp" class="form__control--value form__control__value--textarea form__control__value--sort__desc" rows="3" style="resize:none"><?= $product_id_selected_info['mo_ta_ngan_sp'] ?></textarea>
            </div>
          </div>
          <div class="form__control">
            <div class="form__control--wrap">
              <label class="form__control--name">Mô tả sản phẩm</label>
              <textarea placeholder="Nhập mô tả sản phẩm..." name="mo_ta_sp" class="form__control--value form__control__value--textarea form__control__value--long__desc" rows="3" style="resize:none"><?= $product_id_selected_info['mo_ta_sp'] ?></textarea>
            </div>
          </div>
          <!-- phân loại -->
          <?php
            $sql_loading_product_classifys = "SELECT * FROM `phan_loai` WHERE `id_sp` = '$product_id_selected_info[id_sp]'";
            $product__id_classify_selected = pdo_query($sql_loading_product_classifys);
          ?>
          <?php foreach( $product__id_classify_selected as $product_classify_key => $product_classify_value): ?>
          <div class="form__control">
            <div class="form__control--wrap">
              <label class="form__control--name">Phân loại <?= $product_classify_value['size'] ?> / <?= $product_classify_value['color'] ?></label>
              <input type="text" name="<?= $product_classify_value['size'] ?>/<?= $product_classify_value['color'] ?>" class="form__control--value" placeholder="Nhập số lượng sản phẩm..." value="<?=  $product_classify_value['so_luong_sp'] ?>">
            </div>
          </div>
          <?php endforeach ?>
          <input type="hidden" name="id_sp" value="<?= $product_id_selected_info['id_sp'] ?>"/>
          <div class="form__submit--box">
            <button class="form__submit--btn" name="form__update__product__submit--btn">Lưu thay đổi</button>
          </div>
        </form>
        <div>
              <a href="index.php?section=classify_setting&product_id=<?= $product_id_selected_info['id_sp'] ?>" style="display:block">
                <button style="background-color: var(--main-color-lighter-v2); border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer;">Phân loại</button>
              </a>
            </div>
      </div>
    </div>
  </div>
</section>