<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Quản trị - UltraPhone</title>
    <link rel="shortcut icon" type="image/x-icon" href="./assets/image/admin/logo-url.png" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">
            <img src="./assets/image/admin/logo.png" alt="" style="width: 130px; padding: 10px 0px" />
        </a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
            <i class="fas fa-bars"></i>
        </button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"></form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <img src="./assets/image/admin/logo-admin.png" alt="" style="width: 19px;">
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li>
                        <a class="dropdown-item" href="login.php">Logout</a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Chức năng</div>
                        <div class="cate">
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                data-bs-target="#cateCollapseAuth" aria-expanded="false"
                                aria-controls="cateCollapseAuth">
                                <div class="sb-nav-link-icon"><i class="fas fa-bars"></i></div>
                                Loại
                                <div class="sb-sidenav-collapse-arrow">
                                    <i class="fas fa-angle-down"></i>
                                </div>
                            </a>
                            <div class="collapse" id="cateCollapseAuth" aria-labelledby="headingOne"
                                data-bs-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="index.php?act=listl">Danh sách loại</a>
                                    <a class="nav-link" href="index.php?act=addl">Thêm loại</a>
                                </nav>
                            </div>
                        </div>

                        <div class="product">
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                data-bs-target="#proCollapseAuth" aria-expanded="false" aria-controls="proCollapseAuth">
                                <div class="sb-nav-link-icon"> <i class="fa-solid fa-mobile-screen-button"></i></div>
                                Sản phẩm
                                <div class="sb-sidenav-collapse-arrow">
                                    <i class="fas fa-angle-down"></i>
                                </div>
                            </a>
                            <div class="collapse" id="proCollapseAuth" aria-labelledby="headingOne"
                                data-bs-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="index.php?act=listpro">Danh sách sản phẩm</a>
                                    <a class="nav-link" href="index.php?act=addpro">Thêm sản phẩm</a>
                                </nav>
                            </div>
                        </div>
                        <a class="nav-link" href="index.php?act=listuser">
                            <div class="sb-nav-link-icon">
                                <i class="fa-solid fa-user"></i>
                            </div>
                            Người dùng
                        </a>
                        <a class="nav-link" href="binhluan.html">
                            <div class="sb-nav-link-icon">
                                <i class="fa-solid fa-comment"></i>
                            </div>
                            Bình luận
                        </a>
                        <a class="nav-link" href="index.php?act=bill">
                            <div class="sb-nav-link-icon">
                                <i class="fa-solid fa-money-bill"></i>
                            </div>
                            Hóa đơn
                        </a>
                        <a class="nav-link" href="thongke.html">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-chart-area"></i>
                            </div>
                            Thống kê
                        </a>
                        <a class="nav-link" href="bieudo.html">
                            <div class="sb-nav-link-icon">
                                <i class="fa-solid fa-chart-pie"></i>
                            </div>
                            Biểu đồ
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Đăng nhập với tư cách:</div>
                    Administrator UltraPhone
                </div>
            </nav>
        </div>