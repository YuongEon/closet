<?php
  include "./pdo.php";
  include "./user_function.php";

  function best_sale_products(){
    $sql_best_sale_products = "SELECT * FROM san_pham ORDER BY so_luong_sp_da_ban DESC LIMIT 4";
    $best_sale_products1 = pdo_query($sql_best_sale_products);
    return $best_sale_products1;
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

  // select to cart
  function get_cart_products($id_user){
    $sql_get_cart_products = "SELECT * FROM gio_hang WHERE id_tai_khoan = '$id_user'";
    $cart_products = pdo_query($sql_get_cart_products);
    return $cart_products;
  }

  function insert_product_to_cart($cart_products, $user_id, $product_id, $product_buy_quantity, $product_size, $product_color){
    foreach($cart_products as $cart_products_val){
      if($cart_products_val['id_sp'] == $product_id){
        $is_product_exits = true;
        break;
      } else {
        $is_product_exits = false;
      }
    }
    
    if($is_product_exits == false || sizeof($cart_products) == 0){
      $sql_insert_product_into_cart = "INSERT INTO `gio_hang` (`id_tai_khoan`, `id_sp`, `so_luong_sp`, `size`, `color`) VALUES ('$user_id','$product_id','$product_buy_quantity','$product_size','$product_color')";
      pdo_execute($sql_insert_product_into_cart);
    } else {
      // get product classify in cart
      $sql_get_classify_of_product = "SELECT * FROM `gio_hang` WHERE `id_sp` = '$product_id'";
      $classify_of_product = pdo_query($sql_get_classify_of_product);

      foreach($classify_of_product as $classify_of_product_val){
        if($classify_of_product_val['color'] == $product_color && $classify_of_product_val['size'] == $product_size){
          $is_classify_of_product_exits = true;
          break;
        } else {
          $is_classify_of_product_exits = false;
        }
      }
      
      if($is_classify_of_product_exits == false){
        $sql_insert_product_into_cart = "INSERT INTO `gio_hang` (`id_tai_khoan`, `id_sp`, `so_luong_sp`, `size`, `color`) VALUES ('$user_id','$product_id','$product_buy_quantity','$product_size','$product_color')";
        pdo_execute($sql_insert_product_into_cart);
      } else {
        $sql_get_current_product_buy_quantity = "SELECT * FROM `gio_hang` WHERE `id_sp` = '$product_id' and `color` = '$product_color' and `size` = '$product_size'";
        $product_and_classify_selected = pdo_query($sql_get_current_product_buy_quantity);
        foreach($product_and_classify_selected as $product_and_classify_selected_val){
          $product_and_classify_selected_color = $product_and_classify_selected_val['color'];
          $product_and_classify_selected_size = $product_and_classify_selected_val['size'];
          $product_and_classify_selected_quantity = $product_and_classify_selected_val['so_luong_sp'];
        }
        $new_product_buy_quantity = $product_buy_quantity + $product_and_classify_selected_quantity;
        $sql_update_product_quantity_for_product_and_classify_exits_in_cart = "UPDATE `gio_hang` SET `so_luong_sp` = '$new_product_buy_quantity' WHERE `id_sp` = '$product_id' and `color` = '$product_and_classify_selected_color' and `size` = '$product_and_classify_selected_size'";
        pdo_execute($sql_update_product_quantity_for_product_and_classify_exits_in_cart);
      }
    }
  }

  function delete_product_from_cart($product_id, $product_size, $product_color){
    $sql_delete_product_form_cart = "DELETE FROM gio_hang WHERE id_sp = '$product_id' and size = '$product_size' and color = '$product_color' ";
    pdo_execute($sql_delete_product_form_cart);
  }

  function change_product_quantity_value($product_id, $product_size, $product_color, $product_quantity_value, $method_change){
    if($method_change == 'table__body__value__addition__quantity'){
      $product_quantity_value = $_POST['table__body__value__quantity'];
      $product_quantity_value = (int)$product_quantity_value;
      $product_quantity_value += 1;
      $sql_update_product_quantity = "UPDATE gio_hang SET so_luong_sp = '$product_quantity_value' WHERE id_sp = '$product_id' and size = '$product_size' and color = '$product_color'";
      pdo_execute($sql_update_product_quantity);
    } else
    if($method_change == 'table__body__value__subtraction__quantity'){
      $product_quantity_value = $_POST['table__body__value__quantity'];
      $product_quantity_value = (int)$product_quantity_value;
      if($product_quantity_value <= 1){
        $product_quantity_value = 1;
      } else{
        $product_quantity_value -= 1;
      }
      $sql_update_product_quantity = "UPDATE gio_hang SET so_luong_sp = '$product_quantity_value' WHERE id_sp = '$product_id' and size = '$product_size' and color = '$product_color'";
      pdo_execute($sql_update_product_quantity);
    }
  }

  // payment methods
  function loading_payment_methods(){
    $sql_loading_payment_methods = "SELECT * FROM payment_method";
    $payment_method = pdo_query($sql_loading_payment_methods);
    return $payment_method;
  }

  // function without id
  function loading_product_category_without_id_product(){
    $sql_loading_product_category_without_id_product = "SELECT * FROM loai_sp";
    $product_category_without_id_product = pdo_query($sql_loading_product_category_without_id_product);

    return $product_category_without_id_product;
  }
  function loading_product_brand_without_id_product(){
    $sql_loading_product_brand_without_id_product = "SELECT * FROM brand";
    $product_brand_without_id_product = pdo_query($sql_loading_product_brand_without_id_product);

    return $product_brand_without_id_product;
  }

  function loading_product_without_id_product(){
    $sql_loading_product_without_id_product = "SELECT * FROM san_pham";
    $product_without_id_product = pdo_query($sql_loading_product_without_id_product);

    return $product_without_id_product;
  }

  function loading_bill_without_id(){
    $sql_loading_bill_without_id = "SELECT * FROM `chi_tiet_bill`";
    $loading_bill_without_id_arr = pdo_query($sql_loading_bill_without_id);
    return $loading_bill_without_id_arr;
  }
  function loading_bill_with_id_bill($id_bill){
    $sql_loading_bill_with_id = "SELECT * FROM `chi_tiet_bill` WHERE `id_bill` = '$id_bill'";
    $loading_bill_with_id_arr = pdo_query_one($sql_loading_bill_with_id);
    return $loading_bill_with_id_arr;
  }