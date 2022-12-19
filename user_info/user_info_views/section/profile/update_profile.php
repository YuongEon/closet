<div class="data__showing--region">
          <div class="data__showing--region__label--box">
            <p class="data__showing--region__label">Chỉnh sửa thông tin cá nhân</p>
          </div>
          <form action="index.php?section=update_profile" method="post" enctype="multipart/form-data">
            <div class="user__profile__data--wrap">
              <div class="user__profile__data--box">
                  <div class="user__profile__data__control">
                    <div class="user__profile__data__label">
                      <p>Họ và tên</p>
                    </div>
                    <div class="user__profile__data__value update">
                      <input type="text" name="ho_va_ten" value="<?= $user_info['ho_va_ten'] ?>">
                    </div>
                  </div>
                  <div class="user__profile__data__control">
                    <div class="user__profile__data__label">
                      <p>Tên đăng nhập</p>
                    </div>
                    <div class="user__profile__data__value update">
                      <input type="text" disabled name="username" value="<?= $user_info['username'] ?>">
                    </div>
                  </div>
                  <div class="user__profile__data__control">
                    <div class="user__profile__data__label">
                      <p>Email</p>
                    </div>
                    <div class="user__profile__data__value update">
                    <a href="index.php?section=update_email&email=<?= $user_info['email'] ?>">Đổi email</a>
                    </div>
                  </div>
  
                  <div class="user__profile__data__control">
                    <div class="user__profile__data__label">
                      <p>Số điện thoại</p>
                    </div>
                    <div class="user__profile__data__value update">
                      <?php $user_info_phone_number = "0$user_info[sdt]" ?>
                      <input type="text" name="sdt" value="<?= $user_info_phone_number ?>">
                    </div>
                  </div>
                  <div class="user__profile__data__control">
                    <div class="user__profile__data__label">
                      <p>Mật khẩu</p>
                    </div>
                    <div class="user__profile__data__value update">
                      <a href="index.php?section=update_password&">Đổi mật khẩu</a>
                    </div>
                  </div>
                  <div class="user__profile__data__control">
                    <div class="user__profile__data__label">
                      <p>Trạng thái</p>
                    </div>
                    <div class="user__profile__data__value update">
                      <p>Hoạt động</p>
                    </div>
                  </div>
                </div>
                <div class="user__profile__data__img update">
                  <div class="user__profile__data__img--box">
                    <?php 
                      if($user_info['avatar'] == '' || $user_info['avatar'] == NULL){
                        $avatar_img_path = "../views/image/Closet.png";
                      } else {
                        $avatar_img_path = "$user_info[avatar]";
                      }
                    ?>
                    <img src="<?= $avatar_img_path ?>" alt="" class="user__profile__data__img--img">
                  </div>
                  <input class="user_profile__data__update--avatar" type="file" name="avatar">
                </div>
              </div>
              <div class="user__profile__data__btn">
                <button type="submit" name="isUpdateProfile">Lưu</button>
              </div>
            </div>
          </form>
          
        </div>