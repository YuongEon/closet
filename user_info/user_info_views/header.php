<?php
ob_start();
session_start();
?>
<?php
$id_user = $_SESSION['tai_khoan']['id_tai_khoan'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CLOSET</title>
  <link rel="icon" type="image/x-icon" href="../views/image/Closet.png" style="border-radius: 50%">
  <!-- css -->
  <link rel="stylesheet" href="user_info_views/user_info_css/header.css">
  <link rel="stylesheet" href="user_info_views/user_info_css/footer.css">
  <link rel="stylesheet" href="user_info_views/user_info_css/content.css">
  <link rel="stylesheet" href="user_info_views/user_info_css/profile.css">
  <link rel="stylesheet" href="user_info_views/user_info_css/update_profile.css">
  <link rel="stylesheet" href="user_info_views/user_info_css/bill_list.css">
  <link rel="stylesheet" href="../views/css/global_style.css">

  <!-- reset css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css" integrity="sha512-NmLkDIU1C/C88wi324HBc+S2kLhi08PN5GDeUVVVC/BVt/9Izdsc9SVeVfA1UZbY3sHUlDSyRXhCzHfr6hmPPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="preconnect" href="https://fonts.googleapis.com">

  <!-- nunito font -->
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Anton&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:wght@300;400;500;600;700;800;900&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

  <!-- font awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
  <header class="header">
    <div class="header__wrap">
      <div class="header__top">
        <div class="header__logo__box">
          <div class="header__logo">
            <a href="../index.php?page=homepage" class="header__logo--link">
              CLOSET
            </a>
          </div>
        </div>

        <div class="header__nav__box">
          <nav class="header__nav">
            <ul class="header__nav__list">
              <li class="header__nav__item">
                <a href="../index.php?page=homepage" class="header__nav__item--link">Trang chủ</a>
              </li>
              <li class="header__nav__item">
                <a href="../index.php?page=product" class="header__nav__item--link">Sản phẩm</a>
              </li>
              <li class="header__nav__item">
                <a href="" class="header__nav__item--link">Liên hệ</a>
              </li>
              <li class="header__nav__item">
                <a href="" class="header__nav__item--link">Về chúng tôi</a>
              </li>
            </ul>
          </nav>
        </div>

        <div class="header__user__info">
          <div class="header__cart__box">
            <div class="header__cart__quantity__product">

              <p class="header__cart__quantity--content"><?= $cart_products_length ?></p>
            </div>
            <div class="header__cart">
              <a href="../index.php?page=cart  " class="header__cart--link">
                <i class="fa-solid fa-cart-shopping"></i>
              </a>
            </div>
          </div>

          <div class="header__user__box">
            <div class="header__user">
              <?php if(!isset($_SESSION['tai_khoan'])){ ?>
              <a href="login_method/index.php" class="header__user--link">
                <i class="fa-solid fa-user"></i>
              </a>
              <?php } else { ?>
                <a href="index.php" class="header__user--link">
                <i class="fa-solid fa-user"></i>
              </a>
              <?php } ?>
            </div>
          </div>

          <div class="header__tablet-mobile__menu__box">
            <div class="header__tablet-mobile__menu">
              <a href="" class="header__tablet-mobile__menu--link">
                <i class="fa-solid fa-bars"></i>
              </a>
            </div>
          </div>
        </div>
      </div>

      <div class="header__bottom">
        <div class="header__bottom__wrap">
          <!-- <div class="header__slogan">
            <p class="header__slogan__content">Make your style</p>
          </div> -->

          <div class="header__search">
            <form action="../index.php?page=product" class="header__search__form" method="POST">
              <div class="header__search__form--control">
                <input name="search_keyword" class="header__search__form__field" type="text" placeholder="Nhập sản phẩm bạn muốn tìm kiếm">
              </div>
              <button type="submit" name="header_search_product" class="header__search__form__submit">Tìm kiếm</button>
            </form>
          </div>

          <!-- <div class="header__hello-username__box">
            <div class="header__hello-username">
              <p class="header__hello-username--hello">Welcome,</p>
              <p class="header__hello-username--username">Lê Tuấn Dương</p>
            </div>
          </div> -->
        </div>
      </div>

    </div>
  </header>