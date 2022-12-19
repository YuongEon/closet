<div class="content">
  <?php if(sizeof($cart_products) <= 0){?>
  <div class="section section-1 cart__section">
    <div class="cart__section__label--box">
      <div class="cart__section__label__img--box">
        <img class="cart__section__label__img" src="views/image/sad.png" alt="">
      </div>
      <p class="cart__section__label">Oops! Bạn chưa có sản phẩm nào trong giỏ hàng rồi...</p>
    </div>
  </div>
  <?php } else { ?>
  <div class="section section-1 cart__section">
    <div class="cart__section__table--box">
      <ul class="cart__section__table table__head">
        <li class="table__head__label">Ảnh sản phẩm</li>
        <li class="table__head__label">Tên sản phẩm</li>
        <li class="table__head__label">Phân loại</li>
        <li class="table__head__label">Đơn giá</li>
        <li class="table__head__label">Số lượng</li>
        <li class="table__head__label">Chức năng</li>
      </ul>
      <!-- body -->
      <?php foreach ($cart_products as $cart_product_key => $cart_product_value) : ?>
        <?php
        $product = loading_product($cart_product_value['id_sp']);
        ?>
        <ul class="cart__section__table table__body">
          <li class="table__body__value">
            <div class="table__body__value--img--box">
              <?php $path_product_img =  "admin/$product[anh_sp]"?>
              <img src="<?= $path_product_img ?>" alt="<?= $product['ten_sp'] ?>">
            </div>
          </li>
          <li class="table__body__value"><?= $product['ten_sp'] ?></li>
          <?php
            $classify_arr = array('size' => $cart_product_value['size'], 'color' => $cart_product_value['color']);
            $product_classify_of_product_arr = array('size' => strtoupper($cart_product_value['size']), 'color' => ucwords($cart_product_value['color']));
            $product_classify_of_product = implode(" / ", $product_classify_of_product_arr);
          ?>
          <li class="table__body__value"><?= $product_classify_of_product ?></li>
          <li class="table__body__value"><?= currency_format($product['gia_sp']) ?></li>
          <li class="table__body__value">
            <form class="table__change__quantity__form" action="index.php?page=cart&id_product=<?= $product['id_sp'] ?>&size=<?= $classify_arr['size'] ?>&color=<?= $classify_arr['color'] ?>" method="POST">
              <button type="submit" class="table__body__value__addition__quantity" name="table__body__value__addition__quantity">+</button>
              <input type="text" readonly name="table__body__value__quantity" class="table__body__value__quantity" value="<?= $cart_product_value['so_luong_sp'] ?>">
              <button type="submit" class="table__body__value__subtraction__quantity" name="table__body__value__subtraction__quantity">-</button>
            </form>
          </li>
          <li class="table__body__value">
            <a href="index.php?page=cart&id_delete_product=<?= $product['id_sp'] ?>&size=<?= $classify_arr['size'] ?>&color=<?= $classify_arr['color'] ?>" class="table__body__value__delete--btn">
              <button>Xoá</button>
            </a>
          </li>
        </ul>
      <?php endforeach ?>
    </div>

    <div class="cart__section__total--box">
      <div class="cart__section__total">
        <div class="total__label--box">
          <p class="total__label">Tổng số tiền :</p>
        </div>
        <div class="total__price--box">
          <p class="total__price"><?= currency_format($total) ?></p>
        </div>
      </div>

      <div class="cart__section__submit--btn">
        <a href="index.php?page=payment" class="cart__section__submit--link">
          <button>Thanh toán</button>
        </a>
      </div>
    </div>
  </div>
  <?php } ?>
</div>