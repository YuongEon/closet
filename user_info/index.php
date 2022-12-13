<?php
  include "../model/pdo.php";
  include "../model/san_pham_funtion.php";
  include "../model/user_function.php";
  include "../model/global_function.php";
  session_start();
  
  $id_user = $_SESSION['tai_khoan']['id_tai_khoan'];
  $user_login = $_SESSION['tai_khoan'];


  $cart_products = get_cart_products($id_user);
  $cart_products_length = count($cart_products);

  include "./user_info_views/header.php";
  include "./user_info_views/content.php";

  if(isset($_GET['section']) && $_GET['section'] != ''){
    $section = $_GET['section'];

    switch($section){
      case "profile":
        include "user_info_views/section/profile/profile.php";
        break;
      
        case "update_profile":
          include "user_info_views/section/profile/update_profile.php";
          break;
      
        default:
        include "user_info_views/section/profile/profile.php";
        break;
    }
  } else{
    include "user_info_views/section/profile/profile.php";
  }

  include "./user_info_views/footer.php";
?>