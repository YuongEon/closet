<div class="content">
  <div class="section section-1 login__section">
  <div class="login__section--wrap">
    <div class="login__label__box">
      <p class="login__label"><span>Đăng nhập</span> trở lại với chúng tôi</p>
    </div>
    <div class="login__form--wrap">
      <form action="index.php?login_method=login" class="login__form" method="POST">
        <div class="form__control">
          <div class="filed__label">Tên đăng nhập / Email</div>
          <input type="text" name="usernameOrEmail" class="filed__value">
        </div>
        <div class="form__control">
          <div class="filed__label">Mật khẩu</div>
          <input type="password" name="password" class="filed__value">
        </div>
        <button class="submit__btn" name="login__btn" type="submit">Đăng nhập</button>
      </form>
    </div>
    <div class="change__method__box">
      <p><a class="change__method__box--link" href="index.php?login_method=forgot_pass">Quên mật khẩu</a></p>
    </div>
    <div class="change__method__box">
      <p>Opps! Bạn chưa có tài khoản? <a class="change__method__box--link" href="index.php?login_method=signup">Đăng ký</a> ngay nào!</p>
    </div>
  </div>
  </div>
</div>