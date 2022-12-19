<section>
  <div class="insert__data__section">
    <div class="insert__data__section--wrap">
      <div class="insert__data_label--box">
        <p class="insert__data__label">Chỉnh sửa danh mục</p>
      </div>

      <div class="insert__data__wrap">
        <form method="POST" action="index.php?section=update_category&category_id=<?= $category_info['id_loai_sp'] ?>" class="insert__data__form" enctype="multipart/form-data">
          <div class="form__control">
            <div class="form__control--wrap">
              <label class="form__control--name">Tên danh mục</label>
              <input type="text" name="ten_loai_sp" class="form__control--value" placeholder="Nhập tên danh mục.." value="<?= $category_info['ten_loai_sp'] ?>">
            </div>
          </div>
          
          <div class="form__submit--box">
            <button class="form__submit--btn" name="form__update__category__submit--btn">Lưu chỉnh sửa</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>