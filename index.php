<?php
  include "./model/pdo.php";
  include "./model/san_pham_funtion.php";
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
        // best sale
        $best_sale_products = best_sale_products();
        // flash sale
        $flash_sale_products = flash_sale_products();

        include "views/homepage.php";
        break;
      case "product":
        // get categories 
        $get_categories = "SELECT * FROM loai_sp";
        $categories = pdo_query($get_categories);
        // get brands
        $get_brands = "SELECT * FROM brand order by id_brand desc";
        $brands = pdo_query($get_brands);

        // filter
        $category_id_filter = isset($_GET['category_id'])? $_GET['category_id'] : "";
        $brand_id_filter = isset($_GET['brand_id'])? $_GET['brand_id'] : "";
        if(isset($_POST['header_search_product'])){
          $search_keyword_filter = $_POST['search_keyword'];
        }
        $filter_of_loading_product = filter_of_loading_product($category_id_filter, $brand_id_filter);

        // get products
        $products = loading_products($category_id_filter, $brand_id_filter, $search_keyword_filter);
        
        include "views/product_page.php";
        break;
      case "contact":

        break;
      case "about":

        break;
      
      case "product_detail":
        $id_product = isset($_GET['id_product'])? $_GET['id_product'] : "";
        // get product
        $product = loading_product($id_product);
        include "views/product_detail.php";
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