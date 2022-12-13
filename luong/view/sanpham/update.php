<?php
if (is_array($pro)) {
  extract($pro);
}
$img_path = './uploads/' . $img_pro;
if (is_file($img_path)) {
  $img_pro = '<img src=' . $img_path . ' alt="Ảnh sản phẩm" style="border: 1px solid #f55442; width: 100px;">';
} else {
  $img_pro = 'No photo !';
}
?>

<div id="layoutSidenav_content" class="container-fluid">
    <div class="container-fluid mt-3">
        <div>
            <h3 class="alert alert-success">Cập nhật sản phẩm</h3>
        </div>
        <div class="form-addcate">
            <form action="./index.php?act=updatepro" method="post" enctype="multipart/form-data">
                <div class="form-group mt-3">
                    <label for="formGroupExampleInput" class="font-lb">Mã sản phẩm</label>
                    <input type="text" name="id_pro" class="form-control" value="<?= $id_pro ?>" disabled>
                </div>
                <div class="form-group mt-3">
                    <label for="formGroupExampleInput" class="font-lb">Tên sản phẩm</label>
                    <input type="text" name="name_pro" class="form-control" placeholder="Tên sản phẩm"
                        value="<?= $name_pro ?>">
                </div>
                <div class="form-group mt-3">
                    <label for="formGroupExampleInput" class="font-lb">Giá</label>
                    <input type="text" name="price" class="form-control" placeholder="Giá sản phẩm"
                        value="<?= $price ?>">
                </div>
                <div class="form-group mt-3">
                    <label for="formGroupExampleInput" class="font-lb">Giảm giá</label>
                    <input type="text" name="discount" class="form-control"
                        placeholder="Nhập số % mà sản phẩm được giảm giá" value="<?= $discount ?>">
                </div>
                <div class="form-group mt-3">
                    <label for="formGroupExampleInput" class="font-lb">Mô tả ngắn</label>
                    <input type="text" name="short_des" class="form-control" placeholder="Mô tả tóm tắt sản phẩm"
                        value="<?= $short_des ?>">
                </div>
                <div class="form-group mt-3">
                    <label for="comment" class="font-lb">Mô tả chi tiết</label>
                    <textarea class="form-control" rows="5" name="detail_des"
                        placeholder="Mô tả đầy đủ chi tiết sản phẩm" id="detail_des"><?= $detail_des ?></textarea>
                </div>
                <div class="form-group mt-3 ">
                    <label for="formGroupExampleInput" class="font-lb">Hình ảnh</label> <br>
                    <input type="file" name="img_pro" class="form-control-file mt-3"> <?= $img_pro ?>
                </div>
                <div class="form-group mt-3">
                    <label for="exampleFormControlSelect1" class="font-lb">Loại điện thoại</label>
                    <select class="form-control" name="idcate" id="exampleFormControlSelect1">
                        <option value="0">Chọn loại</option>
                        <?php
            foreach ($ds_loai as $loai) {
              extract($loai);

              if ($idcate == $id_cate) {
                echo '<option value="' . $id_cate . '" selected>' . $name_cate . '</option>';
              } else {
                echo '<option value="' . $id_cate . '">' . $name_cate . '</option>';
              }
            }
            ?>
                    </select>
                </div>

                <div class="wrap-btn">
                    <input type="hidden" name="id_pro" class="form-control" value="<?= $id_pro ?>">
                    <input type="submit" name="btn_update" class="btn btn-success mt-3" value="Cập nhật">
                    <input type="reset" class="btn btn-danger mt-3" value="Nhập lại">
                </div>
            </form>
        </div>
        <div class="pb-70"></div>