<div id="layoutSidenav_content">
    <div class="container-fluid px-4">
        <div class="card mb-4 mt-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Danh sách hóa đơn
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Mã hóa đơn</th>
                            <th>Người đặt</th>
                            <th>Sản phẩm</th>
                            <th>Ngày đặt</th>
                            <th>Thành tiền</th>
                            <th>Phương thức thanh toán</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Mã hóa đơn</th>
                            <th>Người đặt</th>
                            <th>Sản phẩm</th>
                            <th>Ngày đặt</th>
                            <th>Thành tiền</th>
                            <th>Phương thức thanh toán</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($listbill as $bill) :
                            extract($bill);
                            $user_detail = '' . $bill['user_name'] . '<br>' . $bill['full_name'] . '<br> ' . $bill['email'] . '<br> ' . $bill['address'] . '<br>0' . $bill['phone'] . '<br> 
                                        </td>'
                        ?>
                            <tr>
                                <td><?= $bill['id_bill'] ?></td>
                                <td><?= $user_detail ?></td>
                                <td>chưa show</td>
                                <td><?= $bill['order_date'] ?></td>
                                <td><?= number_format($bill['total_amount']) ?></td>
                                <td><?php if ($bill['payment'] == 1) {
                                        echo "Thanh toán khi nhận hàng";
                                    } else if ($bill['payment'] == 2) {
                                        echo "Chuyển khoản ngân hàng";
                                    } else if ($bill['payment'] == 3) {
                                        echo "Thanh toán online";
                                    } else {
                                        echo "Không tìm thấy phương thức thanh toán";
                                    }  ?></td>
                                <td><?php if ($bill['status'] == 0) {
                                        echo "Đơn hàng mới";
                                    } else if ($bill['status'] == 1) {
                                        echo "Đang xử lý";
                                    } else if ($bill['status'] == 2) {
                                        echo "Đang giao hàng";
                                    } else if ($bill['status'] == 3) {
                                        echo "Đã giao hàng";
                                    } else {
                                        echo "Lỗi trạng thái";
                                    } ?></td>
                                <td class="text-center">
                                    <a href="index.php?act=editbill&idbill=<?= $bill['id_bill'] ?>" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i> Sửa</a>
                                    <a href="index.php?act=removebill&idbill=<?= $bill['id_bill'] ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Xóa</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>