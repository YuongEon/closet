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
            <p class="product__price"><?= $product['gia_sp'] ?></p>
          </div>
          <div class="product__sort__desc--box">
            <p class="product__sort__desc"><?= $product['mo_ta_ngan_sp'] ?></p>
          </div>
          <div class="product__add__to__cart--box">
            <form action="" class="product__add__to__cart" method="post">
              <div class="product__add__to__cart__quantity">
                <div class="product__addition__quantity">+</div>
                <input type="text" disabled value="1" class="product__quantity">
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

        <div class="content__product__card col-4 col-6">
          <a href="" class="content__product__card--link">
            <div class="product__img--box">
              <img src="./views/image/Closet (1).png" alt="" class="product__img--img">
            </div>
            <div class="product__info--box">
              <div class="product__name--box">
                <p class="product__name">ăefasdfasdf</p>
              </div>
              <div class="product__price--box">
                <p class="product__price">100000000</p>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>

    <div class="divide"></div>

    <div class="section section-3 content__product__same--category">
      <div class="content__product__category--box">
          <div class="content__category__list">

            <div class="content__same__category__card">
              <a href="" class="content__category__card--link">
                <button class="content__same__category__card--btn"><i class="fa-solid fa-tags content__category__card--btn--icon"></i>ádfasdfđàasdfasdfasdfasdfasfasdfasdfasdf</button>
              </a>
            </div>
          </div>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="js/product_function.js"></script>