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