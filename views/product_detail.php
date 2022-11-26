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
          <p class="product__price"><?= $product['gia_sp'] ?> ₫</p>
        </div>
        <div class="product__sort__desc--box">
          <p class="product__sort__desc"><?= $product['mo_ta_ngan_sp'] ?></p>
        </div>
        <div class="product__add__to__cart--box">
          <form action="index.php?page=product_detail&id_product=<?= $product['id_sp'] ?>" class="product__add__to__cart" method="post">
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
                <p class="product__price"><?= $same_product_value['gia_sp'] ?> ₫</p>
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