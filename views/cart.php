<div class="content">
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
              <img src="<?= $product['anh_sp'] ?>" alt="<?= $product['ten_sp'] ?>">
            </div>
          </li>
          <li class="table__body__value"><?= $product['ten_sp'] ?></li>
          <li class="table__body__value"><?= $product['gia_sp'] ?> đ</li>
          <li class="table__body__value">
            <form action="index.php?page=cart&id_product=<?= $product['id_sp'] ?>" method="POST">
              <button type="submit" class="table__body__value__addition__quantity" name="table__body__value__addition__quantity">+</button>
              <input type="text" readonly name="table__body__value__quantity" class="table__body__value__quantity" value="<?= $cart_product_value['so_luong_sp'] ?>">
              <button type="submit" class="table__body__value__subtraction__quantity" name="table__body__value__subtraction__quantity">-</button>
            </form>
          </li>
          <li class="table__body__value">
            <a href="index.php?page=cart&id_delete_product=<?= $product['id_sp'] ?>" class="table__body__value__delete--btn">
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
          <p class="total__price"><?= $total ?> ₫</p>
        </div>
      </div>

      <div class="cart__section__submit--btn">
        <a href="index.php?page=payment_page" class="cart__section__submit--link">
          <button>Thanh toán</button>
        </a>
      </div>
    </div>
  </div>
</div>