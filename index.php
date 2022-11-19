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
        $get_brands = "SELECT * FROM brand order by id_brand desc";
        $brands = pdo_query($get_brands);
        // get products
        
        // filter
        $category_id_filter = isset($_GET['category_id'])? $_GET['category_id'] : "";
        $brand_id_filter = isset($_GET['brand_id'])? $_GET['brand_id'] : "";

        if($category_id_filter != ""){
          $filter_product = "SELECT * FROM san_pham WHERE loai_sp = '$category_id_filter'";
          $products = pdo_query($filter_product);
          // get category filter name
          $get_category_id_filter_name = "SELECT ten_loai_sp FROM loai_sp WHERE id_loai_sp = '$category_id_filter'";
          $filter_name = pdo_query_one($get_category_id_filter_name);
        } else if($brand_id_filter != ""){
          $filter_product = "SELECT * FROM san_pham WHERE brand = '$brand_id_filter'";
          $products = pdo_query($filter_product);
          // get brand filter name
          $get_brand_id_filter_name = "SELECT ten_brand FROM brand WHERE id_brand = '$brand_id_filter'";
          $filter_name = pdo_query_one($get_brand_id_filter_name);
        } else {
          $get_products = "SELECT * FROM san_pham";
          $products = pdo_query($get_products);
        }
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