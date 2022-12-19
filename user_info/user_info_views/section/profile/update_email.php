<div class="data__showing--region">
  <div class="data__update--region__label">
    <p class="data__update--region__label--data">Đổi Email</p>
  </div>
  <div class="data__update--region__box">
    <form action="" method="post">
      <div class="data__update--form--control">
        <p class="data__update--label">Email hiện tại</p>
        <input class="data__update--value" name="old_data_value" value="<?= $old_email ?>"/>
      </div>
      <div class="data__update--form--control">
        <p class="data__update--label">Email mới</p>
        <input class="data__update--value" name="new_data_value" value=""/>
      </div>
      <button type="submit" name="data__update--btn">Cập nhật email</button>
    </form>
  </div>
</div>