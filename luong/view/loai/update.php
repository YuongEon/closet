<?php
if(is_array($one_loai))  { 
  extract($one_loai);
}
?>
<div id="layoutSidenav_content" class="container-fluid">
        <div class="container-fluid mt-3">
        <div>
            <h3 class="alert alert-success">Cập nhật loại điện thoại</h3>
        </div>
    <div class="form-addcate">
        <form action="index.php?act=capnhatloai" method="post">
            <div class="form-group mt-3">
                <label for="formGroupExampleInput" class="font-lb">Mã loại</label>
                <input type="text" class="form-control" value="<?= $id_cate ?>" disabled>
              </div>
              <div class="form-group mt-3">
                <label for="formGroupExampleInput" class="font-lb">Tên loại</label>
                <input type="text" name="name_cate" class="form-control" value="<?= $name_cate ?>">
              </div>
              <div class="wrap-btn">
                <input type="hidden" name="id_cate" value="<?= $id_cate ?>">
                <input type="submit" name="btn_update" class="btn btn-success mt-3" value="Cập nhật">
                <input type="reset" class="btn btn-danger mt-3" value="Nhập lại">
              </div>
        </form>
    </div>
 