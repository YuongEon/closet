<?php
include 'view/header.php';

//include dao để dùng các functione: 
include "model/pdo.php";
include "model/loai.php";
include "model/sanpham.php";
include "model/nguoidung.php";
include "model/hoadon.php";
// controller
if (isset($_GET['act'])) {
    $act = $_GET['act'];
    switch ($act) {
            // CONTROLLER LOẠI:
        case "addl":
            if(isset($_POST['btn_add']) && ($_POST['btn_add'])) { 
                $name_cate = $_POST['name_cate'];
                them_loai($name_cate);
                echo '<script>alert("Thêm loại thành công!")</script>';
            }
            include "view/loai/add.php";
            break;
            case "addl":
                if(isset($_POST['btn_add']) && ($_POST['btn_add'])) { 
                    $name_cate = $_POST['name_cate'];
                    them_loai($name_cate);
                    echo '<script>alert("Thêm loại thành công!")</script>';
                }
                include "view/loai/add.php";
                break;
            case "listl":
                $ds_loai = loadall_loai();
                include "view/loai/list.php";
                break;    