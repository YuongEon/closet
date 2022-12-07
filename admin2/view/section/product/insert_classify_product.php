<section>
  <div class="insert__product__section">
    <div class="insert__product__section--wrap insert__classify__product__section--wrap">
      <div class="insert__product_label--box">
        <p class="insert__product__label">Tạo phân loại cho sản phẩm</p>
        <div class="insert__product__label--product__name--box insert__classify__product__label--product__name--box">
          <p class="insert__product__label--product__name--label">Tên sản phẩm:</p>
          <p class="insert__product__label--product__name--value"><?= $product_name_add_classify ?></p>
        </div>
      </div>

      <div class="insert__product__wrap insert__classify__product__wrap">
        <form method="POST" action="index.php?section=insert_classify_product" class="insert__product__form" enctype="multipart/form-data">
          <div class="form__control">
            <div class="form__control--wrap">
              <label class="form__control--name">Phân loại màu</label>
              <input type="text" name="color" class="form__control--value" placeholder="Nhập màu sản phẩm...">
            </div>
          </div>
          <div class="form__control">
            <div class="form__control--wrap">
              <label class="form__control--name">Phân loại size</label>
              <input type="text" name="size" class="form__control--value" placeholder="Nhập size sản phẩm...">
            </div>
          </div>
          <div class="form__control">
            <div class="form__control--wrap">
              <label class="form__control--name">Số lượng sản phẩm</label>
              <input type="text" name="so_luong_sp" class="form__control--value" placeholder="Nhập số lượng theo phân loại...">
            </div>
          </div>
  
          <div class="form__submit--box">
            <button class="form__submit--btn" name="form__insert__classify__product__add--btn">Thêm</button>
            <button class="form__submit--btn" name="form__insert__classify__product__out--btn">Thoát</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>