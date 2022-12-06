<?php
  include "./view/header.php";
  include "./view/content.php";

  $section = isset($_GET['section'])? $_GET['section'] : null;
  
  if($section != '' || isset($section) == false){
    switch($section){
    case "admin_section":
      include "./view/section/admin_section.php";
      break;
    case "statistical":
      include "./view/section/dashboard/statistical.php";
      break;
      // product section
    case "product_list":
      include "./view/section/product/product_list.php";
      break;
    case "insert_product":
      include "./view/section/product/insert_product_section.php";
      break;
    case "user_list":
      include "./view/section/user/user_list.php";
      break;
    default: 
      include "./view/section/statistical.php";
      break;
    }
  } else {
    include "./view/section/statistical.php";
  }
  include "./view/footer.php";
?>