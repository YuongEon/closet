<div class="data__showing--region">
          <div class="data__showing--region__label--box">
            <p class="data__showing--region__label">Hồ sơ của tôi</p>
          </div>
          <div class="user__profile__data--wrap">
            <div class="user__profile__data--box">
                <div class="user__profile__data__control">
                  <div class="user__profile__data__label">
                    <p>Họ và tên</p>
                  </div>
                  <div class="user__profile__data__value">
                    <p><?= $user_info['ho_va_ten'] ?></p>
                  </div>
                </div>
                <div class="user__profile__data__control">
                  <div class="user__profile__data__label">
                    <p>Tên đăng nhập</p>
                  </div>
                  <div class="user__profile__data__value">
                    <p><?= $user_info['username'] ?></p>
                  </div>
                </div>
                <div class="user__profile__data__control">
                  <div class="user__profile__data__label">
                    <p>Email</p>
                  </div>
                  <div class="user__profile__data__value">
                    <p><?= $user_info['email'] ?></p>
                  </div>
                </div>

                <div class="user__profile__data__control">
                  <div class="user__profile__data__label">
                    <p>Số điện thoại</p>
                  </div>
                  <div class="user__profile__data__value">
                    <?php $user_info_phone_number = "0$user_info[sdt]"; ?>
                    <p><?= $user_info_phone_number ?></p>
                  </div>
                </div>
                <div class="user__profile__data__control">
                  <div class="user__profile__data__label">
                    <p>Trạng thái</p>
                  </div>
                  <div class="user__profile__data__value">
                    <p>
                      <?php
                        if($user_info['trang_thai'] == 1){
                          echo "Hoạt động";
                        } else if($user_info['trang_thai'] == 0){
                          echo "Bị chặn";
                        }
                      ?>
                    </p>
                  </div>
                </div>
              </div>
              <div class="user__profile__data__img">
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
              </div>
            </div>
          </div>
        </div>