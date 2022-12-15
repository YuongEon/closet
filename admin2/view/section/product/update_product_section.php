<section>
  <div class="update__data__section">
    <div class="update__data__section--wrap">
      <div class="update__data_label--box">
        <p class="update__data__label">Cập nhập sản phẩm</p>
      </div>
      <div class="update__data__wrap">
        <form>
          <div class="form__control">
            <div class="form__control--wrap">
              <label class="form__control__update--name">Tên sản phẩm</label>
              <input type="text" name="ten_sp" class="form__control__update--value" placeholder="Nhập tên sản phẩm...">
            </div>
          </div>
          <div class="form__control">
            <div class="form__control--wrap">
              <label class="form__control__update--name">Ảnh sản phẩm</label>
              <input type="file" name="anh_sp" class="form__control__update--value form__control__update--value__img" placeholder="Nhập ảnh sản phẩm...">
            </div>
          </div>
          <div class="form__control">
            <div class="form__control--wrap">
              <label class="form__control__update--name">Giá sản phẩm</label>
              <input type="text" name="gia_sp" class="form__control__update--value" placeholder="Nhập giá sản phẩm...">
            </div>
          </div>
          <div class="form__control">
            <div class="form__control--wrap">
              <label class="form__control__update--name">Giảm giá sản phẩm</label>
              <input type="text" name="giam_gia_sp" class="form__control__update--value" placeholder="Nhập giảm giá sản phẩm...">
            </div>
          </div>
          <div class="form__control">
            <div class="form__control--wrap">
              <label class="form__control__update--name">Danh mục sản phẩm</label>
              <select name="loai_sp" class="form__control__update--value form__control__update--value--select">
                <option value="" ></option>
              </select>
            </div>
          </div>
          <div class="form__control">
            <div class="form__control--wrap">
              <label class="form__control__update--name">Danh mục sản phẩm</label>
              <select name="brand" class="form__control__update--value form__control__update--value--select">
              <option value="" ></option>
              </select>
            </div>
          </div>
          <div class="form__control">
            <div class="form__control--wrap">
              <label class="form__control__update--name">Mô tả ngắn sản phẩm</label>
              <textarea placeholder="Nhập mô tả ngắn sản phẩm..." name="mo_ta_ngan_sp" class="form__control__update--value form__control__value--textarea form__control__value--sort__desc" rows="3" style="resize:none"></textarea>
            </div>
          </div>
          <div class="form__control">
            <div class="form__control--wrap">
              <label class="form__control__update--name">Mô tả sản phẩm</label>
              <textarea placeholder="Nhập mô tả sản phẩm..." name="mo_ta_sp" class="form__control__update--value form__control__value--textarea form__control__value--long__desc" rows="3 " style="resize:none"></textarea>
            </div>
          </div>
          <!-- <div class="form__submit--box">
            <button class="form__submit--btn" name="form__update__product__submit--btn">Thêm sản phẩm</button>
          </div> -->
        </form>
      </div>
    </div>
    <div class="update__data__section--wrap">
      <div class="update__data_label--box">
        <p class="update__data__label">Phân loại cho sản phẩm</p>
        <div class="update__data__label--product__name--box update__classify__product__label--product__name--box">
          <p class="update__data__label--product__name--value"></p>
        </div>
      </div>

      <div class="update__data__wrap update__classify__product__wrap">
        <form>
          <div class="form__control">
            <div class="form__control--wrap">
              <label class="form__control__update--name">Phân loại màu</label>
              <input type="text" name="color" class="form__control__update--value" placeholder="Nhập màu sản phẩm...">
            </div>
          </div>
          <div class="form__control">
            <div class="form__control--wrap">
              <label class="form__control__update--name">Phân loại size</label>
              <input type="text" name="size" class="form__control__update--value" placeholder="Nhập size sản phẩm...">
            </div>
          </div>
          <div class="form__control">
            <div class="form__control--wrap">
              <label class="form__control__update--name">Số lượng sản phẩm</label>
              <input type="text" name="so_luong_sp" class="form__control__update--value" placeholder="Nhập số lượng theo phân loại...">
            </div>
          </div>
  
          <div class="form__submit--box">
            <button class="form__submit--btn" name="form__update__product--btn">Cập Nhập</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>