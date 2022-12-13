</div>
    </div>
</div>
<footer class="footer">
  <div class="footer__wrap">
    <div class="col-4 footer__logo">
      <div class="footer__logo__box">
        <a href="" class="footer__logo--link">
          <img src="../views/image/Closet (1).png" alt="" class="footer__logo--img">
        </a>
      </div>
    </div>

    <div class="col-4 m-col-2 footer__policy">
      <p class="footer__col-4__title">Chính sách - Điều khoản</p>
      <ul class="footer__policy__list">
        <li class="footer__col-4__item footer__policy__item">
          <a href="" class="footer__col-4__item--link footer__policy--link">Chính sách bảo mật</a>
        </li>
        <li class="footer__col-4__item footer__policy__item">
          <a href="" class="footer__col-4__item--link footer__policy--link">Chính sách bảo mật</a>
        </li>
        <li class="footer__col-4__item footer__policy__item">
          <a href="" class="footer__col-4__item--link footer__policy--link">Chính sách bảo mật</a>
        </li>
        <li class="footer__col-4__item footer__policy__item">
          <a href="" class="footer__col-4__item--link footer__policy--link">Chính sách bảo mật</a>
        </li>
        <li class="footer__col-4__item footer__policy__item">
          <a href="" class="footer__col-4__item--link footer__policy--link">Chính sách bảo mật</a>
        </li>
      </ul>
    </div>

    <div class="col-4 m-col-2 footer__product__category">
      <p class="footer__col-4__title">Danh mục</p>
      <ul class="footer__product__category__list">
        <?php $categories = loading_product_category_without_id_product() ?>
        <?php foreach ($categories as $categories_key => $categories_value) : ?>
          <li class="footer__col-4__item footer__product__category__item">
            <a href="index.php?page=product&category_id=<?= $categories_value['id_loai_sp'] ?>" class="footer__col-4__item--link footer__product__category--link"><?= $categories_value['ten_loai_sp'] ?></a>
          </li>
        <?php endforeach ?>
      </ul>
    </div>

    <div class="col-4 m-col-1 footer__social">
      <p class="footer__col-4__title">Liên kết</p>
      <ul class="footer__social__list">
        <li class="footer__social__item">
          <a href="" class="footer__social--link">
            <button class="footer__social--btn">
              <i class="fa-brands fa-facebook"></i>
              <p>Facebook</p>
            </button>
          </a>
        </li>
        <li class="footer__social__item">
          <a href="" class="footer__social--link">
            <button class="footer__social--btn">
              <i class="fa-brands fa-facebook"></i>
              <p>Facebook</p>
            </button>
          </a>
        </li>
        <li class="footer__social__item">
          <a href="" class="footer__social--link">
            <button class="footer__social--btn">
              <i class="fa-brands fa-facebook"></i>
              <p>Facebook</p>
            </button>
          </a>
        </li>
        <li class="footer__social__item">
          <a href="" class="footer__social--link">
            <button class="footer__social--btn">
              <i class="fa-brands fa-facebook"></i>
              <p>Facebook</p>
            </button>
          </a>
        </li>
        <li class="footer__social__item">
          <a href="" class="footer__social--link">
            <button class="footer__social--btn">
              <i class="fa-brands fa-facebook"></i>
              <p>Facebook</p>
            </button>
          </a>
        </li>
      </ul>
    </div>
  </div>
</footer>

</body>

</html>