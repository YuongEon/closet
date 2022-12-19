<div class="content">
  <section class="section section-1 content__banner__box">
    <div class="content__banner">
      <img src="./views/image/Winter.png" alt="" class="content__banner__img">
    </div>
  </section>

  <section class="section section-2 content__best__sale__product--section">
    <div class="content__best_sale_product">
      <p class="content__product__list__title">Sản phẩm bán chạy</p>
      <div class="content__product__list">

        <?php foreach ($best_sale_products as $product_key => $product_value) : ?>
          <div class="content__product__card col-4 col-6">
            <a href="index.php?page=product_detail&id_product=<?= $product_value['id_sp'] ?>" class="content__product__card--link">
              <div class="product__img--box" style="flex: 3;">
                <?php $path_product_img_best_sale = "admin/$product_value[anh_sp]"; ?>
                <img src="<?= $path_product_img_best_sale ?>" alt="<?= $product_value['ten_sp'] ?>" class="product__img--img">
              </div>
              <div class="product__info--box">
                <div class="product__name--box">
                  <p class="product__name"><?= $product_value['ten_sp'] ?></p>
                </div>
                <div class="product__price--box">
                  <p class="product__price"><?= currency_format($product_value['gia_sp']) ?></p>
                </div>
              </div>
            </a>
          </div>
        <?php endforeach ?>

      </div>
    </div>
  </section>

  <section class="section section-3 content__flash__sale__product--section">
    <div class="content__flash_sale_product">
      <p class="content__product__list__title">
        <span>Flash Sale</span>
        <i class="fa-solid fa-bolt-lightning"></i>
      </p>
      <div class="content__product__list">

        <?php foreach ($flash_sale_products as $product_key => $product_value): ?>
          <div class="content__product__card col-4 col-6">
            <a href="index.php?page=product_detail&id_product=<?= $product_value['id_sp'] ?>" class="content__product__card--link">
              <div class="product__img--box" style="flex: 3;">
                <?php $path_product_img_flash_sale = "admin/$product_value[anh_sp]" ?>
                <img src="<?= $path_product_img_flash_sale ?>" alt="<?= $product_value['ten_sp'] ?>" class="product__img--img">
              </div>
              <div class="product__info--box">
                <div class="product__name--box">
                  <p class="product__name"><?= $product_value['ten_sp'] ?></p>
                </div>
                <div class="product__price--box">
                  <p class="product__price"><?= currency_format($product_value['gia_sp']) ?></p>
                </div>
              </div>
            </a>
          </div>
        <?php endforeach ?>
      </div>
    </div>
  </section>

  <section class="section section-4 content__product__category--section">
    <div class="content__product__category">
      <p class="content__product__category__title">
        <span>Danh mục sản phẩm</span>
      </p>

      <div class="content__product__category--box">
        <div class="content__product__category__img--box">
          <img src="./views/image/categories.png" alt="" class="product__category__img--img">
        </div>
        <div class="content__product__category__list--wrap">
          <div class="content__category__list">

            <?php foreach ($categories as $category_key => $category_value) : ?>
              <div class="content__category__card">
                <a href="index.php?page=product&category_id=<?= $category_value['id_loai_sp'] ?>" class="content__category__card--link">
                  <button class="content__category__card--btn"><i class="fa-solid fa-tags content__category__card--btn--icon"></i><?= $category_value['ten_loai_sp'] ?></button>
                </a>
              </div>
            <?php endforeach ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>