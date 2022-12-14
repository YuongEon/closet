<div class="content">
  <div class="section section-1 login__section">
  <div class="login__section--wrap">
    <div class="login__label__box">
      <p class="login__label"><span>Đăng ký</span> tham gia với chúng tôi</p>
    </div>
    <div class="login__form--wrap">
      <form action="index.php?login_method=signup" class="login__form" method="POST">
        <div class="form__control">
          <div class="filed__label">Email</div>
          <input type="text" name="email" class="filed__value">
        </div>
        <div class="form__control">
          <div class="filed__label">Số điện thoại</div>
          <input type="text" name="phone_number" class="filed__value">
        </div>
        <div class="form__control">
          <div class="filed__label">Tên đăng nhập</div>
          <input type="text" name="username" class="filed__value">
        </div>
        <div class="form__control">
          <div class="filed__label">Mật khẩu</div>
          <input type="password" name="password" class="filed__value">
        </div>
        <button class="submit__btn" name="signup__btn" type="submit">Đăng ký</button>
      </form>
    </div>
    <div class="change__method__box">
      <p>Opps! Bạn đã có tài khoản? <a class="change__method__box--link" href="index.php?login_method=login">Đăng nhập</a> ngay nào!</p>
    </div>
  </div>
  </div>
</div>