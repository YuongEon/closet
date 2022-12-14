<?php
include "../model/pdo.php";
include "views/header.php";

include "views/home.php";
if(isset($_GET['act'])){
    $act=$_GET['act'];
    switch($act){
        case "admin_section":
            include "views/admin_section.php";
            break;
        case 'ql_dm':
            if(isset($_POST['themmoi'])&&($_POST['themmoi'])){
                $ten_loai_sp=$_POST['ten_loai_sp'];
                $sql="insert into loai_sp(ten_loai_sp) values('$ten_loai_sp')";
                pdo_execute($sql);
            }
            include "danhmuc/add.php";
            break;
        case 'list_dm':
            $sql ="select *from loai_sp order by ten_loai_sp";
            $listdanhmuc=pdo_query($sql);
            include "danhmuc/list.php";
            break;
        case 'ql_sp':
            include "sanpham/add.php";
            break;
        case 'ql_tk':
            include "user/user.php";
            break;
        case 'ql_bl':
            include "user/binhluan.php";
            break;    
        default:
            include "views/setion.php";
            break;
    }
}else{
    include "views/setion.php";
}

include "views/footer.php";
?>