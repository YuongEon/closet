<div id="layoutSidenav_content">
    <div class="container-fluid px-4">
        <div class="card mb-4 mt-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Danh sách sản phẩm
            </div>
            <div class="card-body">
                <div class="filter">
                    <form action="./index.php?act=listpro" method="POST" enctype="multipart/form-data">
                        <select name="idcate" class="sel-filter">
                            <option value="0">Tất cả</option>
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
                        <input type="submit" value="Filter" name="btn_filter" class="btn-filter">
                    </form>
                </div>
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Giảm giá</th>
                            <th>Hình ảnh</th>
                            <th>Mô tả ngắn</th>
                            <th>Mô tả chi tiết</th>
                            <th>Lượt xem</th>
                            <th>Thao Tác</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Giảm giá</th>
                            <th>Hình ảnh</th>
                            <th>Mô tả ngắn</th>
                            <th>Mô tả chi tiết</th>
                            <th>Lượt xem</th>
                            <th>Thao Tác</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($listpro as $pro) : ?>
                             <tr>
                                    <td><?= $pro['id_pro'] ?></td>
                                    <td><?= $pro['name_pro'] ?></td>
                                    <td><?= number_format($pro['price']) ?></td>
                                    <td><?= $pro['discount'] ?>%</td>
                                    <td><img src="./uploads/<?= $pro['img_pro']?>" alt="No photo!" width="50px"></td>
                                    <td><?= $pro['short_des'] ?></td>
                                    <td><?= $pro['detail_des'] ?></td>
                                    <td><?= $pro['view'] ?></td>
                                    <td class="text-center">
                                        <a href="./index.php?act=editpro&id_pro=<?= $pro['id_pro'] ?>" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i> Sửa</a>
                                        <a href="./index.php?act=removepro&id_pro=<?= $pro['id_pro'] ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')"><i class="fa-solid fa-trash"></i> Xóa</a>
                                    </td>
                                </tr>
                     <?php endforeach ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>