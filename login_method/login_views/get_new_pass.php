<div class="content">
  <div class="section section-1 login__section">
  <div class="login__section--wrap">
    <div class="login__label__box">
      <p class="login__label">Đổi mật khẩu</p>
    </div>
    <div class="login__form--wrap">
      <form action="index.php?login_method=get_new_pass" class="login__form" method="POST">
        <div class="form__control">
          <div class="filed__label">Mật khẩu</div>
          <input type="text" name="password" class="filed__value" placeholder="Nhập mật khẩu mới của bạn">
        </div>
        <input type="hidden" name="email_request" class="filed__value" placeholder="Nhập mật khẩu mới của bạn" value="<?= $email ?>">
        <button class="submit__btn" name="get__new__pass__btn" type="submit">Thay đổi</button>
      </form>
    </div>
    <div class="change__method__box">
      <p>Ghi nhớ mật khẩu dễ dàng bằng cách đặt mật khẩu gần gũi với bạn!</p>
    </div>
  </div>
  </div>
</div>