<body>
    <header class="header">
        <div class="header_wrap">
            <div class="header_top">
                <div class="header_admin_logo_box">
                    <div class="header_menu_item">
                        <a href="#" class="toggle_nav"><i class="fa-solid fa-bars"></i></a>
                    </div>
                    <div class="header_logo">
                        <a href="#" class="header_logo--link">
                            CLOSET
                        </a>
                    
                    </div>
                </div>

                <div class="header_admin_box">
                    <div class="header_admin">
                        <a href="#" class="header_admin_user--link">
                            <i class="fa-solid fa-user"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="main_nav_warp">
            <nav>
                <div class="nav_warp_menu">
                    <ul class="nav_list">
                        <li>
                            <a href="#" class="nav_link">
                                <i class="fa-solid fa-user"></i>
                                <span class="nav_text">Lê Văn X </span>
                            </a>
                        </li>
                        <li class="nav__heading">
                            SẢN PHẨM
                        </li>
                        <li>
                            <a href="#" class="nav_link">
                                <i class="fa-solid fa-baseball"></i>
                                <span class="nav_text">Thêm Sản Phẩm </span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav_link">
                                <i class="fa-brands fa-product-hunt"></i>
                                <span class="nav_text">DS Sản Phẩm </span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav_link">
                                <i class="fa-solid fa-cart-shopping"></i>
                                <span class="nav_text">Danh Mục SP </span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav_link">
                                <i class="fa-solid fa-list"></i>
                                <span class="nav_text">Thêm Danh Mục </span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav_link">
                                <i class="fa-solid fa-list"></i>
                                <span class="nav_text">Danh Mục SP </span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav_link">
                                <i class="fa-solid fa-chart-simple"></i>
                                <span class="nav_text">Thống kê </span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav_link">
                                <i class="fa-solid fa-star"></i>
                                <span class="nav_text">Đánh giá </span>
                            </a>
                        </li>
                        <li class="nav__heading">
                            Use
                        </li>
                        <li>
                            <a href="#" class="nav_link">
                                <i class="fa-solid fa-users"></i>
                                <span class="nav_text">Danh Sách User </span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav_link">
                                <i class="fa-solid fa-user-secret"></i>
                                <span class="nav_text">Thêm Mới User </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <section>
                <!-- id_binh_luan
        is_sp	
        id_tai_khoan	
        noi_dung_binh_luan	
        sao_danh_gia	 -->

                <section>

                    <div class="row mb10">
                        Danh mục sản phẩm <br>
                    </div>
                    <form action="index.php?act=addsp" enctype="multipart/form-data" method="post">
                        <div class="product_list_wrap">
                            <div class="product_list_wrap__b">
                                <div class="product_list_wrap_box">
                                    Mã Sản Phẩm <br>
                                    <input type="text" name="id_sp" disabled>
                                </div>
                                <div class="product_list_wrap_box">
                                    Tên Sản Phẩm <br>
                                    <input type="text" name="ten_sp">
                                </div>
                                <div class="product_list_wrap_box">
                                    Ảnh Sản Phẩm <br>
                                    <input type="file" name="anh_sp">
                                </div>
                                <div class="product_list_wrap_box">
                                    Mô Tả Sản Phẩm<br>
                                    <textarea name="mo_ta_ngan_sp" cols="40" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="product_list_wrap__b">
                                <div class="product_list_wrap_box">
                                    Giá <br>
                                    <input type="text" name="gia_sp">
                                </div>
                                <div class="product_list_wrap_box">
                                    Số Lượng Sản Phẩm <br>
                                    <input type="number" name="so_luong_sp">
                                </div>
                                <div class="product_list_wrap_box">
                                    so_luong_sp_da_ban <br>
                                    <input type="number" name="so_luong_sp_da_ban">
                                </div>
                                <div class="product_list_wrap_box">
                                    loai_sp<br>
                                    <input type="text" name="tensp">
                                </div>
                                <div class="product_list_wrap_box">
                                    trang_thai_sp<br>
                                    <input type="text" name="tensp">
                                </div>
                                <div class="product_list_wrap_box_function">
                                    <input type="submit" name="themmoi" value="THÊM MỚI">
                                    <input type="reset" value="NHẬP LẠI">
                                    <a href="index.php?act=listsp"> <input type="button" value="DANH SÁCH"></a>
                                </div>

                            </div>
                        </div>

                    </form>
                </section>
        </div>
    </main>
</body>
