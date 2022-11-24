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

  function loading_products($id_category, $id_brand, $search_keyword, $tag){
    if($id_category != "" || $id_category != NULL){
      $sql_loading_products = "SELECT * FROM san_pham WHERE loai_sp = '$id_category'";
      $products = pdo_query($sql_loading_products);
    } else if($id_brand != "" || $id_brand != NULL){
      $sql_loading_products = "SELECT * FROM san_pham WHERE brand = '$id_brand'";
      $products = pdo_query($sql_loading_products);
    } else if($search_keyword != "" || $search_keyword != NULL){
      $sql_loading_products = "SELECT * FROM san_pham WHERE ten_sp LIKE '%$search_keyword%'";
      $products = pdo_query($sql_loading_products);
    } else if($tag != "" || $tag != NULL){
      $sql_loading_products = "SELECT * FROM san_pham WHERE ten_sp LIKe '%$tag%'";
      $products = pdo_query($sql_loading_products);
      if(sizeof($products) <= 0){
        // get brand id
        $sql_get_brand_id = "SELECT * FROM brand WHERE ten_brand LIKE '%$tag%'";
        $brand_id = pdo_query_one($sql_get_brand_id);
        $brand_id = $brand_id['id_brand'];

        $sql_loading_products = "SELECT * FROM san_pham WHERE brand = '$brand_id'";
        $products = pdo_query($sql_loading_products);
      }
    } else {
      $sql_loading_products = "SELECT * FROM san_pham";
      $products = pdo_query($sql_loading_products);
    }
  
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

  function get_product_category($id_product){
    $sql_get_product = "SELECT * FROM san_pham WHERE id_sp = '$id_product'";
    $product = pdo_query_one($sql_get_product);

    $product_category_id = $product['loai_sp'];
    $sql_get_product_category = "SELECT * FROM loai_sp WHERE id_loai_sp = '$product_category_id'";
    $product_category = pdo_query_one($sql_get_product_category);

    return $product_category;
  }

  function get_product_brand($id_product){
    $sql_get_product = "SELECT * FROM san_pham WHERE id_sp = '$id_product'";
    $product = pdo_query_one($sql_get_product);

    $product_brand_id = $product['brand'];
    $sql_get_product_brand = "SELECT * FROM brand WHERE id_brand = '$product_brand_id'";
    $product_brand = pdo_query_one($sql_get_product_brand);

    return $product_brand;
  }

  function loading_same_products($id_product){
    $product_category = get_product_category($id_product);

    $product_category_id = $product_category['id_loai_sp'];
    $sql_loading_same_products = "SELECT * FROM san_pham WHERE loai_sp = '$product_category_id'";
    $same_products = pdo_query($sql_loading_same_products);
    $same_products_arr = array();
    
    foreach($same_products as $same_products_value){
      if($same_products_value["id_sp"] != $id_product){
        array_push($same_products_arr, $same_products_value);
      }
    }
    $same_products = $same_products_arr;
    return $same_products;
  }

  function get_tags_of_product($id_product){
    $category_tag = get_product_category($id_product);
    $brand_tag = get_product_brand($id_product);
    $tags = array_merge($category_tag, $brand_tag);
    function filter_tag($val){
      return !is_numeric($val);
    }
    $tags = array_filter($tags, "filter_tag");
    return $tags;
  }
?>