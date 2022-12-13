<section>
  <div class="insert__data__section">
    <div class="insert__data__section--wrap">
      <div class="insert__data_label--box">
        <p class="insert__data__label">Thêm mới danh mục</p>
      </div>

      <div class="insert__data__wrap">
        <form method="POST" action="index.php?section=insert_category" class="insert__data__form insert__value__form" enctype="multipart/form-data">
          <div class="form__control">
            <div class="form__control--wrap">
              <label class="form__control--name">Tên danh mục</label>
              <input type="text" name="ten_loai_sp" class="form__control--value" placeholder="Nhập tên danh mục...">
            </div>
          </div>

          <div class="form__submit--box">
            <button class="form__submit--btn" name="form__insert__category__submit--btn">Thêm danh mục</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>