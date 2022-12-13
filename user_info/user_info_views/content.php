<div class="content">
    <div class="section section-1 profile__section">
      <div class="profile">
        <div class="profile__nav">
          <div class="profile__nav__function">
            <a href="index.php?section=profile">
              <div class="profile__nav__function__img--box">
                <?php 
                  if($user_info['avatar'] == '' || $user_info['avatar'] == NULL){
                    $avatar_img_path = "../views/image/Closet.png";
                  } else {
                    $avatar_img_path = "$user_info[avatar]";
                  }
                ?>
                <img src="<?= $avatar_img_path ?>" alt="" class="profile__nav__function__img">
              </div>
              <div class="profile__nav__function__label--box">
                <p class="profile__nav__function__label"><?= $user_info['ho_va_ten'] ?></p>
              </div>
            </a>
          </div>
          <div class="profile__nav__function">
            <a href="index.php?section=update_profile">
              <div class="profile__nav__function__img--box">
                <img src="../views/image/resume.png" alt="" class="profile__nav__function__img">
              </div>
              <div class="profile__nav__function__label--box">
                <p class="profile__nav__function__label">Chỉnh sửa thông tin</p>
              </div>
            </a>
          </div>
          <div class="profile__nav__function">
            <a href="index.php?section=bill_list">
              <div class="profile__nav__function__img--box">
                <img src="../views/image/cart.png" alt="" class="profile__nav__function__img">
              </div>
              <div class="profile__nav__function__label--box">
                <p class="profile__nav__function__label">Đơn mua</p>
              </div>
            </a>
          </div>
          <div class="profile__nav__function">
            <a href="">
              <div class="profile__nav__function__img--box">
                <img src="../views/image/pie-chart.png" alt="" class="profile__nav__function__img">
              </div>
              <div class="profile__nav__function__label--box">
                <p class="profile__nav__function__label">Thống kê</p>
              </div>
            </a>
          </div>
          <div class="profile__nav__function">
            <a href="../login_method/login_views/logout.php">
              <div class="profile__nav__function__img--box">
                <img src="../views/image/logout.png" alt="" class="profile__nav__function__img">
              </div>
              <div class="profile__nav__function__label--box">
                <p class="profile__nav__function__label">Đăng xuất</p>
              </div>
            </a>
          </div>
        </div>

 