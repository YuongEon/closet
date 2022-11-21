<?php
  include "./pdo.php";

  function best_sale_product($sql){

  }

  function flash_sale_product($sql){

  }

  function loading_products($id_category, $id_brand, $search_keyword){
    if($id_category != "" || $id_category != NULL){
      $sql_loading_product = "SELECT * FROM san_pham WHERE loai_sp = '$id_category'";
    } else if($id_brand != "" || $id_brand != NULL){
      $sql_loading_product = "SELECT * FROM san_pham WHERE brand = '$id_brand'";
    } else if($search_keyword != "" || $search_keyword != NULL){
      $sql_loading_product = "SELECT * FROM san_pham WHERE ten_sp LIKE '%$search_keyword%'";
    } else {
      $sql_loading_product = "SELECT * FROM san_pham";
    }
    
    $products = pdo_query($sql_loading_product);
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
?>