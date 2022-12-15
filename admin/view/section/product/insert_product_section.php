<section>
  <div class="insert__data__section">
    <div class="insert__data__section--wrap">
      <div class="insert__data_label--box">
        <p class="insert__data__label">Thêm mới sản phẩm</p>
      </div>

      <div class="insert__data__wrap">
        <form method="POST" action="index.php?section=insert_classify_product" class="insert__data__form" enctype="multipart/form-data">
          <div class="form__control">
            <div class="form__control--wrap">
              <label class="form__control--name">Tên sản phẩm</label>
              <input type="text" name="ten_sp" class="form__control--value" placeholder="Nhập tên sản phẩm...">
            </div>
          </div>
          <div class="form__control">
            <div class="form__control--wrap">
              <label class="form__control--name">Ảnh sản phẩm</label>
              <input type="file" name="anh_sp" class="form__control--value form__control--value__img" placeholder="Nhập ảnh sản phẩm...">
            </div>
          </div>
          <div class="form__control">
            <div class="form__control--wrap">
              <label class="form__control--name">Giá sản phẩm</label>
              <input type="text" name="gia_sp" class="form__control--value" placeholder="Nhập giá sản phẩm...">
            </div>
          </div>
          <div class="form__control">
            <div class="form__control--wrap">
              <label class="form__control--name">Giảm giá sản phẩm</label>
              <input type="text" name="giam_gia_sp" class="form__control--value" placeholder="Nhập giảm giá sản phẩm...">
            </div>
          </div>
          <div class="form__control">
            <div class="form__control--wrap">
              <label class="form__control--name">Danh mục sản phẩm</label>
              <?php $product_category_without_id_product = loading_product_category_without_id_product() ?>
              <select name="loai_sp" class="form__control--value form__control--value--select">
                <?php foreach($product_category_without_id_product as $product_category_without_id_product_key => $product_category_without_id_product_value): ?>
                <option value="<?= $product_category_without_id_product_value['id_loai_sp'] ?>" ><?= $product_category_without_id_product_value['ten_loai_sp'] ?></option>
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
                <option value="<?= $product_brand_without_id_product_value['id_brand'] ?>" ><?= $product_brand_without_id_product_value['ten_brand'] ?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>
          <div class="form__control">
            <div class="form__control--wrap">
              <label class="form__control--name">Mô tả ngắn sản phẩm</label>
              <textarea placeholder="Nhập mô tả ngắn sản phẩm..." name="mo_ta_ngan_sp" class="form__control--value form__control__value--textarea form__control__value--sort__desc" rows="3" style="resize:none"></textarea>
            </div>
          </div>
          <div class="form__control">
            <div class="form__control--wrap">
              <label class="form__control--name">Mô tả sản phẩm</label>
              <textarea placeholder="Nhập mô tả sản phẩm..." name="mo_ta_sp" class="form__control--value form__control__value--textarea form__control__value--long__desc" rows="3" style="resize:none"></textarea>
            </div>
          </div>
          <div class="form__submit--box">
            <button class="form__submit--btn" name="form__insert__product__submit--btn">Thêm sản phẩm</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>