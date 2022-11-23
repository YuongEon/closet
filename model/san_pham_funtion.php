<?php
  include "./pdo.php";

  function best_sale_products(){
    $sql_best_sale_products = "SELECT * FROM san_pham ORDER BY so_luong_sp_da_ban DESC LIMIT 4";
    $best_sale_products = pdo_query($sql_best_sale_products);
    return $best_sale_products;
  }

  function flash_sale_products(){
    $sql_flash_sale_products = "SELECT * FROM san_pham ORDER BY giam_gia_sp DESC LIMIT 4";
    $flash_sale_products = pdo_query($sql_flash_sale_products);
    return $flash_sale_products;
  }

  function loading_products($id_category, $id_brand, $search_keyword){
    if($id_category != "" || $id_category != NULL){
      $sql_loading_products = "SELECT * FROM san_pham WHERE loai_sp = '$id_category'";
    } else if($id_brand != "" || $id_brand != NULL){
      $sql_loading_products = "SELECT * FROM san_pham WHERE brand = '$id_brand'";
    } else if($search_keyword != "" || $search_keyword != NULL){
      $sql_loading_products = "SELECT * FROM san_pham WHERE ten_sp LIKE '%$search_keyword%'";
    } else {
      $sql_loading_products = "SELECT * FROM san_pham";
    }
    
    $products = pdo_query($sql_loading_products);
    return $products;
  }

  function filter_of_loading_product($id_category, $id_brand){
    if($id_category != "" || $id_category != NULL){
      $sql_filter_of_loading_product = "SELECT * FROM loai_sp WHERE id_loai_sp = '$id_category'";
      $filter_of_loading_product = pdo_query_one($sql_filter_of_loading_product);
    } else if($id_brand != "" || $id_brand != NULL){
      $sql_filter_of_loading_product = "SELECT * FROM brand WHERE id_brand = '$id_brand'";
      $filter_of_loading_product = pdo_query_one($sql_filter_of_loading_product);
    }
    return $filter_of_loading_product;
  }

  function loading_product($id_product){
    $sql_loading_product = "SELECT * FROM san_pham WHERE id_sp = '$id_product'";
    $product = pdo_query_one($sql_loading_product);
    return $product;
  }
?>