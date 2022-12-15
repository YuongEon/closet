<?php
  include "../model/pdo.php";
  include "../model/global_function.php";
  include "../model/san_pham_funtion.php";
  include "../model/user_function.php";
  include "./model/admin_product_function.php";

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

    // control order
    case "control_order":
      $bill_list = loading_bill_without_id();

      include "./view/section/dashboard/control_order.php";
      break;

      // product section
    case "product_list":
      if(isset($_POST['product__section__search--submit'])){
        $product_search_name = $_POST['product__section__search--value'];
        $products = loading_products('', '' ,$product_search_name, '');
      } else {
        $products = loading_product_without_id_product();
      }

      include "./view/section/product/product_list.php";
      break;
    case "insert_product":
      $errors = array();
      if(isset($_GET['isError']) && $_GET['isError'] == true){
        $errors = array(
          "product_name_err" => "$_GET[product_name_err]",
          'product_picture_err' => "$_GET[product_picture_err]",
          'product_price_err' => "$_GET[product_price_err]",
          'product_sale_price_err' => "$_GET[product_sale_price_err]",
          'product_category_err' => "$_GET[product_category_err]",
          'product_brand_err' => "$_GET[product_brand_err]",
          '$product_sort_desc_err' => "$_GET[product_sort_desc_err]",
          'product_long_desc_err' => "$_GET[product_long_desc_err]"
        );
      }

      include "./view/section/product/insert_product_section.php";
      break;
    case "insert_classify_product":
      if(isset($_POST['form__insert__product__submit--btn'])){
        $product_name = $_POST['ten_sp'];
        $product_picture = $_FILES['anh_sp'];
        $product_price = $_POST['gia_sp'];
        $product_sale_price = $_POST['giam_gia_sp'];
        $product_category = $_POST['loai_sp'];
        $product_brand = $_POST['brand'];
        $product_sort_desc = $_POST['mo_ta_ngan_sp'];
        $product_long_desc = $_POST['mo_ta_sp'];

        $products_exit_in_arr = loading_product_without_id_product();

        $errors = array(
          "product_name_err" => '',
          'product_picture_err' => '',
          'product_price_err' => '',
          'product_sale_price_err' => '',
          'product_category_err' => '',
          'product_brand_err' => '',
          '$product_sort_desc_err' => "",
          'product_long_desc_err' => ''
        );

        // check product_name
        if($product_name == ''){
          $errors['product_name_err'] = "Tên sản phẩm chưa có dữ liệu!";
        } else {
          foreach($products_exit_in_arr as $products_exit_in_arr_value){
            if($product_name == $products_exit_in_arr_value['ten_sp']){
              $errors['product_name_err'] = "Tên sản phẩm đã tồn tại!";
            }
          }
        }

        // check product_picture
        $type_img_arr = array('jpg', 'jpeg', 'png');
        if($product_picture['size'] <= 0){
          $errors['product_picture_err'] = "Ảnh sản phẩm chưa có dữ liệu!";
        } else {
          $fileType = pathinfo($product_picture['name'], PATHINFO_EXTENSION);
          if(!in_array($fileType, $type_img_arr)){
            $errors['product_picture_err'] = "Chỉ cho phép ảnh dạng PNG hặc JPG!";
          }
        }

        // check product_price
        if($product_price == ''){
          $errors['product_price_err'] = "Giá sản phẩm chưa có dữ liệu!";
        }

        // check sale price
        if($product_sale_price == ''){
          $product_sale_price = 0;
        } else if($product_sale_price > 100){
          $errors['product_sale_price_err'] = "Giảm giá vượt quá 100%!";
        }

        // check sort desc
        if($product_sort_desc == ''){
          $errors['product_sort_desc_err'] = 'Mô tả ngắn sản phẩm chưa có dữ liệu!';
        } else if(strlen($product_sort_desc) > 1000){
          $errors['product_sort_desc_err'] = 'Mô tả ngắn sản phẩm vượt quá số ký tự cho phép';
        }

        // check long desc
        if($product_long_desc == ''){
          $errors['product_long_desc_err'] = 'Mô tả sản phẩm chưa có dữ liệu!';
        } else if(strlen($product_long_desc) > 5000){
          $errors['product_long_desc_err'] = 'Mô tả sản phẩm vượt quá số ký tự cho phép';
        }

        $error_count = 0;
        foreach($errors as $error_value){
          if($error_value != ''){
            $error_count += 1;
          }
        }

        if($error_count == 0){
          $img_url = '';
          if($product_picture['tmp_name'] != ''){
              $folderName = 'view/image/image_product/';
              $fileName = uniqid() . '_' . $product_picture['name'];
              move_uploaded_file($product_picture['tmp_name'], $folderName . $fileName);
              $img_url = $folderName . $fileName;
          }
          admin_insert_product($product_name, $img_url, $product_price, $product_sale_price, $product_category, $product_brand, $product_sort_desc,$product_long_desc);
        } else {
          header("location: index.php?section=insert_product&isError=true&product_name_err=$errors[product_name_err]&product_picture_err=$errors[product_picture_err]&product_price_err=$errors[product_price_err]&product_sale_price_err=$errors[product_sale_price_err]&product_sort_desc_err=$errors[product_sort_desc_err]&product_long_desc_err=$errors[product_long_desc_err]");
        }
        
      }
      
      $product_arr = loading_product_without_id_product();
      $last_product = end($product_arr);
      $product_name_add_classify = $last_product['ten_sp'];

      $classify_err = array(
        'color_err' => '',
        'size_err' => '',
        'product_quantity_err' => ''
      );

      if(isset($_POST['form__insert__classify__product__add--btn'])){
        $product_id = $last_product['id_sp'];
        $color = $_POST['color'];
        $size = $_POST['size'];
        $product_quantity = $_POST['so_luong_sp'];

        // check color
        if($color == ''){
          $classify_err['color_err'] = "Màu sản phẩm chưa có dữ liệu";
        }
        // check size
        if($size == ''){
          $classify_err['size_err'] = "Size sản phẩm chưa có dữ liệu";
        }
        // check product quantity
        if($product_quantity == ''){
          $classify_err['product_quantity_arr'] = "Số lượng sản phẩm chưa có dữ liệu";
        }

        $check_classify_err_quantity = 0;
        foreach($classify_err as $classify_err_val){
          if($classify_err_val != ''){
            $check_classify_err_quantity += 1;
          }
        }

        if($check_classify_err_quantity == 0){
          admin_insert_product_classify($product_id, $color, $size, $product_quantity);
        } else {
          header("location: index.php?section=insert_classify_product&isError=true&size_err=$classify_err[size_err]&color_err=$classify_err[color_err]&product_quantity_arr=$classify_err[product_quantity_err]");
          ob_end_flush();
        }
        
        
      }
      include "./view/section/product/insert_classify_product.php";
      break;
    case "update_product":
        include "./view/section/product/update_product_section.php";
        break;
      case "detail_product":
        include "./view/section/product/detail_product_section.php";
        break;
      // category
    case "category_list":
      if(isset($_POST['category__section__search--submit'])){
        $category_search_name = $_POST['category__section__search--value'];

        $sql_get_product_category_by_keyword = "SELECT * FROM `loai_sp` WHERE `ten_loai_sp` LIKE '%$category_search_name%'";
        $categories = pdo_query($sql_get_product_category_by_keyword);
      } else {
        $categories = loading_product_category_without_id_product();
      }
      include "./view/section/category/category_list.php";
      break;

      case "insert_category":
        if(isset($_POST['form__insert__category__submit--btn'])){
          $category_name = $_POST['ten_loai_sp'];

          $sql_insert_into_category = "INSERT INTO `loai_sp` (`id_loai_sp`, `ten_loai_sp`) VALUES (NULL, '$category_name')";
          pdo_execute($sql_insert_into_category);

          header("Location: index.php?section=category_list");
          ob_end_flush();
        }
        include "./view/section/category/insert_category_section.php";
        break;
      case "update_category":
    
          include "./view/section/category/category_update.php";
          break;
    case "brand_list":
      if(isset($_POST['brand__section__search--submit'])){
        $brand_search_name = $_POST['brand__section__search--value'];

        $sql_get_product_brand_by_keyword = "SELECT * FROM `brand` WHERE `ten_brand` LIKE '%$brand_search_name%'";
        $brands = pdo_query($sql_get_product_brand_by_keyword);
      } else {
        $brands = loading_product_brand_without_id_product();
      }
      include "./view/section/brand/brand_list.php";
      break;

      case "insert_brand":
        if(isset($_POST['form__insert__brand__submit--btn'])){
          $brand_name = $_POST['ten_brand'];

          $sql_insert_into_brand = "INSERT INTO `brand` (`id_brand`, `ten_brand`) VALUES (NULL, '$brand_name')";
          pdo_execute($sql_insert_into_brand);

          header("Location: index.php?section=brand_list");
          ob_end_flush();
        }
        include "./view/section/brand/insert_brand_section.php";
        break;


    case "user_list":
      if(isset($_POST['user__section__search--submit'])){
        $user_search_name = $_POST['user__section__search--value'];

        $sql_get_product_user_by_keyword = "SELECT * FROM `tai_khoan` WHERE `ho_va_ten` LIKE '%$brand_search_name%'";
        $users = pdo_query($sql_get_product_user_by_keyword);
      } else {
        $users = loading_product_user_without_id_user();
      }
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
