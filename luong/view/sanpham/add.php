<div id="layoutSidenav_content" class="container-fluid">
        <div class="container-fluid mt-3">
        <div>
            <h3 class="alert alert-success">Thêm sản phẩm</h3>
        </div>
    <div class="form-addcate">
        <form action="index.php?act=addpro" method="post" enctype="multipart/form-data">
            <div class="form-group mt-3">
                <label for="formGroupExampleInput" class="font-lb">Mã sản phẩm</label>
                <input type="text" name="id_pro" class="form-control" placeholder="Mã loại (auto)" disabled>
              </div>
              <div class="form-group mt-3">
                <label for="formGroupExampleInput" class="font-lb">Tên sản phẩm</label>
                <input type="text" name="name_pro" class="form-control" placeholder="Tên sản phẩm">
              </div>
              <div class="form-group mt-3">
                <label for="formGroupExampleInput" class="font-lb">Giá</label>
                <input type="text" name="price" class="form-control" placeholder="Giá sản phẩm">
              </div>
              <div class="form-group mt-3">
                <label for="formGroupExampleInput" class="font-lb">Giảm giá(nếu có)</label>
                <input type="text" name="discount" class="form-control" placeholder="Nhập số % mà sản phẩm được giảm giá">
              </div>
              <div class="form-group mt-3">
                <label for="formGroupExampleInput" class="font-lb">Mô tả ngắn</label>
                <input type="text" name="short_des" class="form-control" placeholder="Mô tả tóm tắt sản phẩm">
              </div>
          <div class="form-group mt-3">
          <label for="comment" class="font-lb">Mô tả chi tiết</label>
          <textarea class="form-control" rows="5" name="detail_des" id="detail_des" placeholder="Mô tả đầy đủ chi tiết sản phẩm"></textarea>
        </div>
        <div class="form-group mt-3">
                <label for="formGroupExampleInput" class="font-lb">Hình ảnh</label>
                <input type="file" name="img_pro" class="form-control">
              </div>
        <div class="form-group mt-3">
          <label for="exampleFormControlSelect1" class="font-lb">Loại điện thoại</label>
          <select class="form-control" name="idcate" id="exampleFormControlSelect1">
            <option value="0">Chọn loại</option>
            <?php
            foreach ($ds_loai as $loai) {
              extract($loai);
              echo '<option value=' . $id_cate . '>' . $name_cate . '</option>';
            }
            ?>
          </select>
        </div>
          
              <div class="wrap-btn">
                <input type="submit" name="btn_add" class="btn btn-success mt-3" value="Thêm">
                <input type="reset" class="btn btn-danger mt-3" value="Nhập lại">
              </div>
        </form>
        <h3 class="text-success fs-6 mt-3 fw-bolder">
        <?php
        if (isset($noticepro) && $noticepro != "") {
          echo $noticepro;
        }
        ?>
      </h3>
    </div>
    <div class="pb-70"></div>