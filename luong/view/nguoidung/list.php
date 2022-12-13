<div id="layoutSidenav_content">
    <div class="container-fluid px-4">
        <div class="card mb-4 mt-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Danh sách Người dùng
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Mã người dùng</th>
                            <th>Tên đăng nhập</th>
                            <th>Mật khẩu</th>
                            <th>Họ tên</th>
                            <th>Email</th>
                            <th>Vai trò</th>
                            <th>Ngày đăng ký</th>
                            <th>Lần đăng nhập cuối</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tfoot>
                    <tr>
                            <th>Mã người dùng</th>
                            <th>Tên đăng nhập</th>
                            <th>Mật khẩu</th>
                            <th>Họ tên</th>
                            <th>Email</th>
                            <th>Vai trò</th>
                            <th>Ngày đăng ký</th>
                            <th>Lần đăng nhập cuối</th>
                            <th>Thao tác</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($listuser as $user) : ?>
                             <tr>
                                    <td><?= $user['id_user'] ?></td>
                                    <td><?= $user['user_name'] ?></td>
                                    <td><?= $user['password'] ?></td>
                                    <td><?= $user['full_name'] ?></td>
                                    <td><?= $user['email_user'] ?></td>
                                    <td><?php if($user['role'] == 1) {
                                        echo "Admin";
                                    } else {
                                        echo "Người dùng";
                                    } ?></td>
                                    <td><?= $user['register_date'] ?></td>
                                    <td><?= $user['last_login'] ?></td>
                                    <td class="text-center">
                                        <a href="./index.php?act=edituser&id_user=<?= $user['id_user'] ?>" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i> Sửa</a>
                                        <a href="./index.php?act=removeuser&id_user=<?= $user['id_user'] ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')"><i class="fa-solid fa-trash"></i> Xóa</a>
                                    </td>
                                </tr>
                     <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>