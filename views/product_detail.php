<div class="content">
  <div class="section section-1 content__product__detail">
    <div class="row product__info">
      <div class="product__img--box">
        <?php
        $path_product_image = "admin/$product[anh_sp]";
        ?>
        <img src="<?= $path_product_image ?>" alt="" class="product__img">
      </div>
      <div class="product__sort__info--box">
        <div class="product__name--box">
          <p class="product__name"><?= $product['ten_sp'] ?></p>
        </div>
        <div class="product__price--box">
          <p class="product__price"><?= currency_format($product['gia_sp']) ?></p>
        </div>
        <div class="product__sort__desc--box">
          <p class="product__sort__desc"><?= $product['mo_ta_ngan_sp'] ?></p>
        </div>

        <?php
        $sql_get_classify = "SELECT * FROM phan_loai WHERE id_sp = '$product[id_sp]'";
        $classify = pdo_query($sql_get_classify);

        $size_arr = array();
        $color_arr = array();
        $total = 0;
        foreach ($classify as $val) {
          array_push($size_arr, $val['size']);
          array_push($color_arr, $val['color']);
          $total += $val['so_luong_sp'];
        }

        foreach ($size_arr as $k =>  $v) {
          if (!(isset($hold[$v])))
            $hold[$v] = 1;
          else
            unset($size_arr[$k]);
        }

        foreach ($color_arr as $k =>  $v) {
          if (!(isset($hold[$v])))
            $hold[$v] = 1;
          else
            unset($color_arr[$k]);
        }
        ?>
        <div class="product__add__to__cart--box">
          <form action="index.php?page=product_detail&id_product=<?= $product['id_sp'] ?>" class="product__add__to__cart" method="post">
            <div class="product__classify">

              <div class="product__classify__color--box product__classify--box">
                <p class="product__classify__label">Màu sắc</p>
                <div class="product__classify__color">
                  <?php foreach ($color_arr as $color_arr_key => $color_arr_value) : ?>
                    <label for="color-<?= $color_arr_value ?>">
                      <input  id="color-<?= $color_arr_value ?>" class="product__classify__color__value" type="radio" value="<?= $color_arr_value ?>" name="color" />
                      <span><?= $color_arr_value ?></span>
                    </label>
                  <?php endforeach ?>

                </div>
              </div>

              <div class="product__classify__size--box product__classify--box">
                <p class="product__classify__label">Size</p>
                <div class="product__classify__size">
                  <?php foreach ($size_arr as $size_arr_key => $size_arr_value) : ?>
                    <label for="size-<?= $size_arr_value ?>">
                      <input  id="size-<?= $size_arr_value ?>" class="product__classify__size__value" type="radio" value="<?= $size_arr_value ?>" name="size" />
                      <span><?= $size_arr_value ?></span>
                    </label>
                  <?php endforeach ?>
                </div>
              </div>

            </div>

            <?php
            $total = 0;
            foreach ($classify as $get_each_price_classify) {
              $total += $get_each_price_classify['so_luong_sp'];
            }
            ?>
            <div class="product__total__quantity">
              <p class="product__total_quantity--label">Tổng số lượng sản phẩm:</p>
              <p class="product__total__quantity--value"><?= $total ?></p>
            </div>

            <div class="product__add__to__cart__quantity">
              <div class="product__addition__quantity">+</div>
              <input type="hidden" name="user_id" value="<?= $id_user ?>" />
              <input type="hidden" name="product_id" value="<?= $product['id_sp'] ?>" />
              <input type="text" readonly value="1" class="product__quantity" name="product_quantity">
              <div class="product__subtraction__quantity">-</div>
            </div>
            <button type="submit" name="product__add__to__cart__btn" class="product__add__to__cart__btn">Thêm vào giỏ hàng</button>
          </form>
        </div>
      </div>
    </div>
    <div class="row product__long--desc--box">
      <p class="product__long--desc--box"><?= $product['mo_ta_sp'] ?></p>
    </div>
  </div>

  <div class="divide"></div>

  <div class="product__comment__section">
    <div class="product__comment__section__label--box">
      <p>Bình luận - Đánh giá</p>
    </div>
    <div class="product__comment__for__user">
      <?php if(!$create_comment){ ?>
        <div class="product__comment__for__user__label--box">
          <p>Vui lòng mua hàng để được đánh giá</p>
        </div>
      <?php } else if($create_comment){ ?>
        <div class="comment__form--box">
          <div class="comment__form--label">
            <p>Tạo bình luận - đánh giá của bạn</p>
          </div>
          <form action="index.php?page=product_detail&id_product=<?= $product['id_sp'] ?>" method="POST">
            <div class="comment__form__control">
              <label class="comment__form__control--label">Sao đánh giá</label>
              <div class="comment__form__control--value">
                <div class="comment__form__control__star">
                  <span class="comment__star__rating" onclick="rateStar(5)">☆</span>
                  <span class="comment__star__rating" onclick="rateStar(4)">☆</span>
                  <span class="comment__star__rating" onclick="rateStar(3)">☆</span>
                  <span class="comment__star__rating" onclick="rateStar(2)">☆</span>
                  <span class="comment__star__rating" onclick="rateStar(1)">☆</span>
                </div>
                <input type="hidden" name="sao_danh_gia" value="" id="sao_danh_gia">
              </div>
            </div>
            <div class="comment__form__control">
              <label class="comment__form__control--label">Nội dung bình luận</label>
              <div class="comment__form__control--value">
              <textarea name="noi_dung_binh_luan" rows="4" cols="50"></textarea>
              </div>
            </div>
            <input type="hidden" name="id_sp" value="<?= $product['id_sp'] ?>">
            <input type="hidden" name="id_tai_khoan" value="<?= $id_user ?>">
            <button name="isComment" class="comment__form--btn">Gửi</button>
          </form>
        </div>
      <?php } ?>
    </div>

    <div class="product__comment__list">
      <?php
          $sql_loading_product_comments = "SELECT * FROM `binh_luan` WHERE `id_sp` = '$product[id_sp]'";
          $product_comments = pdo_query($sql_loading_product_comments);
        ?>
      <div class="product__comment__item">
        <?php foreach($product_comments as $product_comment_key => $product_comment_value): ?>
        <?php 
          $user_info = loading_user_info($product_comment_value['id_tai_khoan']); 
        ?>
        <div class="product__comment__item--wrap">
          <div class="comment__user__avatar">
            <img src="user_info/<?= $user_info['avatar'] ?>" alt="" class="comment__user__avatar--img">  
          </div>
          <div class="comment__user__info">
            <div class="comment__user__info--box">
              <p class="comment__user__info--value date__comment"><?= $product_comment_value['thoi_gian_binh_luan'] ?></p>
            </div>
            <div class="comment__user__info--box">
              <p class="comment__user__info--value user__name__comment"><?= $user_info['ho_va_ten'] ?></p>
            </div>
            <div class="comment__user__info--box">
              <p class="comment__user__info--value rate_start">
                <?php
                  for($i = 0; $i < (int)$product_comment_value['sao_danh_gia']; $i++){
                    echo "<i class='fa-solid fa-star'></i>";
                  }
                ?>
              </p>
            </div>
            <div class="comment__user__info--box">
              <p class="comment__user__info--value comment__content"><?= $product_comment_value['noi_dung_binh_luan'] ?></p>
            </div>
          </div>
        </div>
        <?php endforeach ?>
      </div>
    </div>
  </div>

  <div class="divide"></div>

  <div class="section section-2 content__product__same--type">
    <div class="content__product__same--type__title--box">
      <p class="content__product__same--type__title">Sản phẩm liên quan</p>
    </div>
    <div class="content__product__same--type--list">
      <?php foreach ($same_products as $same_product_key => $same_product_value) : ?>
        <div class="content__product__card col-4 col-6">
          <a href="index.php?page=product_detail&id_product=<?= $same_product_value['id_sp'] ?>" class="content__product__card--link">
            <div class="product__img--box">
              <?php $same_product_img = "admin/$same_product_value[anh_sp]" ?>
              <img src="<?= $same_product_img ?>" alt="<?= $same_product_value['ten_sp'] ?>" class="product__img--img">
            </div>
            <div class="product__info--box">
              <div class="product__name--box">
                <p class="product__name"><?= $same_product_value['ten_sp'] ?></p>
              </div>
              <div class="product__price--box">
                <p class="product__price"><?= currency_format($same_product_value['gia_sp']) ?></p>
              </div>
            </div>
          </a>
        </div>
      <?php endforeach ?>
    </div>
  </div>

  <div class="divide"></div>

  <div class="section section-3 content__product__same--category">
    <div class="content__product__category--box">
      <div class="content__category__list">
        <?php foreach ($tags as $tag_key => $tag_value) : ?>
          <div class="content__same__category__card">
            <?php
            // convert string to array
            $tag_value_link = explode(" ", $tag_value);
            $tag_value_link = end($tag_value_link);
            ?>
            <a href="index.php?page=product&tag=<?= $tag_value_link ?>" class="content__category__card--link">
              <button class="content__same__category__card--btn"><i class="fa-solid fa-tags content__category__card--btn--icon"></i><?= $tag_value ?></button>
            </a>
          </div>
        <?php endforeach ?>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="js/change_quantity.js"></script>
<script type="text/javascript" src="js/product_detail.js"></script>