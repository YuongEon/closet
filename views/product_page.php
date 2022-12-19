<div class="content">
  <div class="content__wrap">
    <!-- filter -->
    <section class="section section-1 content__aside__filter--section">
      <div class="content__aside__filter">
        <label for="" class="aside__filter__label">Bộ lọc :</label>
        <div class="aside__filter__table-type aside__filter__categories">
          <label for="" class="filter__table__label filter__categories__label">Danh mục</label>
          <ul class="filter__table-type__list filter__categories__list">
            <?php foreach ($categories as $category_key => $category_value) : ?>
              <li class="filter__table-type__item filter__categories__item">
                <a href="index.php?page=product&category_id=<?= $category_value['id_loai_sp'] ?>" class="filter__table-type__link filter__categories__link"><?= $category_value['ten_loai_sp'] ?></a>
              </li>
            <?php endforeach ?>
          </ul>
        </div>

        <div class="aside__filter__table-type aside__filter__brand">
          <label for="" class="filter__table__label filter__brand__label">Brand</label>
          <ul class="filter__table-type__list filter__brand__list">
            <?php foreach ($brands as $brand_key => $brand_value) : ?>
              <li class="filter__table-type__item filter__brand__item">
                <a href="index.php?page=product&brand_id=<?= $brand_value['id_brand'] ?>" class="filter__table-type__link filter__brand__link"><?= $brand_value['ten_brand'] ?></a>
              </li>
            <?php endforeach ?>
          </ul>
        </div>
      </div>
    </section>

    <!-- product--innerHTML -->
    <section class="section section-2 content__product-inner--section">
      <div class="content__product-inner">
        <div class="content__product-inner__filtered">
          <div class="content__product-inner__filtered__list">
            <?php if (isset($filter_of_loading_product)) { ?>
              <div class="content__product-inner_filtered__item">
                <p class="product-inner__filtered__content">
                  <?php if ($filter_of_loading_product['ten_loai_sp'] != "") {
                    echo "$filter_of_loading_product[ten_loai_sp]";
                  } else if ($filter_of_loading_product['ten_brand'] != "") {
                    echo "$filter_of_loading_product[ten_brand]";
                  } else if (is_string($filter_of_loading_product) == true) {
                    echo "$filter_of_loading_product";
                  }
                  ?>
                </p>
                <a style="display:block; cursor: pointer;" href="index.php?page=product">
                  <button class="product-inner__filtered__delete-content">x</button>
                </a>
              </div>
            <?php } ?>
          </div>
        </div>

        <div class="content__product-inner__product">
          <div class="product-inner__product__list">
            <?php foreach ($products as $product_key => $product_value) : ?>
              <div class="product-inner__product__card">
                <a href="index.php?page=product_detail&id_product=<?= $product_value['id_sp'] ?>" class="product-inner__product--link">
                  <div class="product-inner__product__img--box" style="flex: 3;">
                    <?php $path_product_img_inner = "admin/$product_value[anh_sp]" ?>
                    <img class="product__inner__product__img--img" src="<?= $path_product_img_inner ?>" alt="<?= $product_value['ten_sp'] ?>">
                  </div>
                  <div class="product-inner__product__info">
                    <div class="product-inner__product__name--box">
                      <p class="product-inner__product__name"><?= $product_value['ten_sp'] ?></p>
                    </div>
                    <div class="product-inner__product__price--box">
                      <p class="product-inner__product__price"><?= currency_format($product_value['gia_sp']) ?></p>
                    </div>
                  </div>
                </a>
              </div>
            <?php endforeach ?>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>