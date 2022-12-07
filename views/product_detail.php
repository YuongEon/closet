<div class="content">
  <div class="section section-1 content__product__detail">
    <div class="row product__info">
      <div class="product__img--box">
        <img src="<?= $product['anh_sp'] ?>" alt="" class="product__img">
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
          foreach($classify as $val){
            array_push($size_arr, $val['size']);
            array_push($color_arr, $val['color']);
            $total += $val['so_luong_sp'];
          }

          foreach($size_arr as $k =>  $v){
            if(!( isset ($hold[$v])))
                $hold[$v]=1;
            else
                unset($size_arr[$k]);
          }

          foreach($color_arr as $k =>  $v){
            if(!( isset ($hold[$v])))
                $hold[$v]=1;
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
                      <input id="color-<?= $color_arr_value ?>" class="product__classify__color__value" type="radio" value="<?= $color_arr_value ?>" name="color" />
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
                      <input id="size-<?= $size_arr_value ?>" class="product__classify__size__value" type="radio" value="<?= $size_arr_value ?>" name="size" />
                      <span><?= $size_arr_value ?></span>
                    </label>
                  <?php endforeach ?>
                </div>
              </div>

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

  <div class="section section-2 content__product__same--type">
    <div class="content__product__same--type__title--box">
      <p class="content__product__same--type__title">Sản phẩm liên quan</p>
    </div>
    <div class="content__product__same--type--list">
      <?php foreach ($same_products as $same_product_key => $same_product_value) : ?>
        <div class="content__product__card col-4 col-6">
          <a href="index.php?page=product_detail&id_product=<?= $same_product_value['id_sp'] ?>" class="content__product__card--link">
            <div class="product__img--box">
              <img src="<?= $same_product_value['anh_sp'] ?>" alt="<?= $same_product_value['ten_sp'] ?>" class="product__img--img">
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
<script type="text/javascript" src="js/function.js"></script>