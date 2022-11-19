<?php
  include "./model/pdo.php";
  include "views/header.php";
  
  if(isset($_GET['page']) && $_GET['page'] != ""){
    $page = $_GET['page'];

    switch($page){
      case "homepage":
        // get products
        $sql_get_product = "SELECT * FROM san_pham";
        $product = pdo_query($sql_get_product); 
        // get categories product
        $sql_get_categories = "SELECT * FROM loai_sp";
        $categories = pdo_query($sql_get_categories);
        include "views/homepage.php";
        break;
      case "product":
        // get categories 
        $get_categories = "SELECT * FROM loai_sp";
        $categories = pdo_query($get_categories);
        // get brands
        $get_brands = "SELECT * FROM brand";
        $brands = pdo_query($get_brands);
        // get products
        $get_products = "SELECT * FROM san_pham";
        $products = pdo_query($get_products);
        include "views/product_page.php";
        break;
      case "contact":

        break;
      case "about":

        break;
      default:
      $sql_get_product = "SELECT * FROM san_pham";
        $product = pdo_query($sql_get_product); 
        // get categories product
        $sql_get_categories = "SELECT * FROM loai_sp";
        $categories = pdo_query($sql_get_categories);
      include "views/homepage.php";
        break;
    }
  } else {
    $sql_get_product = "SELECT * FROM san_pham";
        $product = pdo_query($sql_get_product); 
        // get categories product
        $sql_get_categories = "SELECT * FROM loai_sp";
        $categories = pdo_query($sql_get_categories);
    include "views/homepage.php";
  }

  include "views/footer.php";
?>