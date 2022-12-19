<section>
  <div class="insert__data__section">
    <div class="insert__data__section--wrap insert__classify__product__section--wrap">
      <div class="insert__data_label--box">
        <p class="insert__data__label">Tạo phân loại cho sản phẩm</p>
        <div class="insert__data__label--product__name--box insert__classify__product__label--product__name--box">
          <p class="insert__data__label--product__name--label">Tên sản phẩm:</p>
          <p class="insert__data__label--product__name--value"><?= $product_info['ten_sp'] ?></p>
        </div>
      </div>

      <div class="insert__data__wrap insert__classify__product__wrap">
        <form method="POST" action="index.php?section=add_classify&product_id=<?= $product_info['id_sp'] ?>" class="insert__data__form" enctype="multipart/form-data">
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
            <button class="form__submit--btn" name="form__add__classify__product__add--btn">Thêm</button>
          </div>
        </form>
      </div>
      <a href="index.php?section=classify_setting&product_id=<?= $product_info['id_sp'] ?>" style="text-decoration: none; display:block; text-align: right; margin-top: 20px">
        <button class="form__submit--btn" style="background-color: #f74d4d;">Thoát</button>
      </a>
    </div>
  </div>
</section>