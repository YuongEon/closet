<main>
  <div class="main_nav_warp">
    <nav>
      <div class="nav_warp_menu">
        <ul class="nav_list">
          <div class="nav__label--box">
            <p class="nav__label">Bảng điều khiển</p>
          </div>
          <li>
            <a href="../user_info/index.php" class="nav_link">
              <div class="admin__avatar--box">
                <img class="admin__avatar--img" src="view/image/admin_avatar.jpeg" alt="" />
              </div>
              <span class="nav_text"><?= $user_info_global['ho_va_ten'] ?></span>
            </a>
          </li>
          <li>
            <a href="index.php?section=statistical" class="nav_link">
              <i class="fa-solid fa-chart-simple"></i>
              <span class="nav_text">Thống kê</span>
            </a>
          </li>
          <li>
            <a href="index.php?section=control_order" class="nav_link">
              <i class="fa-solid fa-chart-simple"></i>
              <span class="nav_text">Quản lý đơn hàng</span>
            </a>
          </li>
          <div class="nav__label--box">
            <p class="nav__label">Sản phẩm</p>
          </div>
          <li>
            <a href="index.php?section=product_list" class="nav_link">
              <i class="fa-brands fa-product-hunt"></i>
              <span class="nav_text">Quản lý sản phẩm</span>
            </a>
          </li>
          <li>
            <a href="index.php?section=category_list" class="nav_link">
              <i class="fa-solid fa-inbox"></i>
              <span class="nav_text">Quản lý danh mục</span>
            </a>
          </li>
          <li>
            <a href="index.php?section=brand_list" class="nav_link">
              <i class="fa-solid fa-copyright"></i>
              <span class="nav_text">Quản lý brand</span>
            </a>
          </li>
            <a href="index.php?section=comment_list" class="nav_link">
              <i class="fa-solid fa-star"></i>
              <span class="nav_text">Bình luận - Đánh giá</span>
            </a>
          </li>
          <div class="nav__label--box">
            <p class="nav__label">Khách hàng</p>
          </div>
          <li>
            <a href="index.php?section=user_list" class="nav_link">
              <i class="fa-solid fa-user"></i>
              <span class="nav_text">Quản lý khách hàng</span>
            </a>
          </li>
          
      </div>
    </nav>