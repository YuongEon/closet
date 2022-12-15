<section>
  <div class="insert__data__section">
    <div class="insert__data__section--wrap">
      <div class="insert__data_label--box">
        <p class="insert__data__label">Chỉnh sửa brand</p>
      </div>

      <div class="insert__data__wrap">
        <form method="POST" action="index.php?section=update_brand&brand_id=<?= $brand_info['id_brand'] ?>" class="insert__data__form" enctype="multipart/form-data">
          <div class="form__control">
            <div class="form__control--wrap">
              <label class="form__control--name">Tên brand</label>
              <input type="text" name="ten_brand" class="form__control--value" placeholder="Nhập tên brand.." value="<?= $brand_info['ten_brand'] ?>">
            </div>
          </div>
          
          <div class="form__submit--box">
            <button class="form__submit--btn" name="form__update__brand__submit--btn">Lưu chỉnh sửa</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>