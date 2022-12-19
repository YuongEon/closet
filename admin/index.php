<?php
  include "../model/pdo.php";
  include "../model/global_function.php";
  include "../model/san_pham_funtion.php";
  include "../model/user_function.php";
  include "./model/admin_product_function.php";


  session_start();

  if(isset($_SESSION['tai_khoan']) == false){
    header("location: ../login_method/index.php");
  } else if(isset($_SESSION['tai_khoan']) == true && $_SESSION['tai_khoan']['loai_tai_khoan'] == 0){
    header("location: ../index.php");
  }

  $user_info_global = loading_user_info($_SESSION['tai_khoan']['id_tai_khoan']);

  include "./view/header.php";
  include "./view/content.php";
  
  if(isset($_GET['section']) && $_GET['section'] != ""){
    $section = $_GET['section'];

    switch($section){

    case "admin_section":
      include "./view/section/admin_section.php";
      break;

    case "statistical":
      $sql_loading_product_without_id = "SELECT * FROM `san_pham`";
      $product_without_id = pdo_query($sql_loading_product_without_id);

      $sql_loading_account_without_id = "SELECT * FROM `tai_khoan`";
      $account_without_id = pdo_query($sql_loading_account_without_id);

      $sql_loading_bill_without_id = "SELECT * FROM `chi_tiet_bill`";
      $bill_without_id = pdo_query($sql_loading_bill_without_id);

      include "./view/section/dashboard/statistical.php";
      break;

    // control order
    case "control_order":
      if(isset($_GET['bill_status'])){
        $bill_status_insert = $_GET['bill_status'];

        $sql_loading_bill_list = "SELECT * FROM `chi_tiet_bill` WHERE `trang_thai_bill` = '$bill_status_insert'";
        $bill_list = pdo_query($sql_loading_bill_list);
      } else if(isset($_POST['order__section__search--submit'])){
        $keyword_id_bill = $_POST['order__section__search--value'];

        $sql_loading_bill_list = "SELECT * FROM `chi_tiet_bill` WHERE `id_bill` = '$keyword_id_bill'";
        $bill_list = pdo_query($sql_loading_bill_list);
      }else {
        $bill_list = loading_bill_without_id();
      }

      if(isset($_GET['confirm_bill'])){
        $bill_id = $_GET['bill_id'];
        $sql_confirm_bill = "UPDATE `chi_tiet_bill` SET `trang_thai_bill` = 1 WHERE `id_bill` = '$bill_id'";
        pdo_execute($sql_confirm_bill);
      }
      if(isset($_GET['cancel_bill'])){
        $bill_id = $_GET['bill_id'];
        $sql_confirm_bill = "UPDATE `chi_tiet_bill` SET `trang_thai_bill` = 3 WHERE `id_bill` = '$bill_id'";
        pdo_execute($sql_confirm_bill);
      }

      include "./view/section/dashboard/control_order.php";
      break;
    
    case "bill_detail":
      $bill_id = $_GET['bill_id'];
      $sql_loading_bill = "SELECT * FROM `chi_tiet_bill` WHERE `id_bill` = '$bill_id'";
      $bill_detail = pdo_query_one($sql_loading_bill);

      include "./view/section/dashboard/bill_detail.php";
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

          $percentage_price = ($product_sale_price / 100) * (int)$product_price;
          $new_product_price = (int)$product_price - $percentage_price;
          $new_product_price = (string)$new_product_price;
      
          admin_insert_product($product_name, $img_url, $new_product_price, $product_sale_price, $product_category, $product_brand, $product_sort_desc,$product_long_desc);
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
    
    case "product_update_section":
      $product_id_selected = $_GET['product_id'];
      $product_id_selected_info = loading_product($product_id_selected);

      if(isset($_POST['form__update__product__submit--btn'])){
        $product_id = $_POST['id_sp'];
        $product_name = $_POST['ten_sp'];
        $product_img = $_FILES['anh_sp'];
        $product_price = $_POST['gia_sp'];
        $product_sale_price = $_POST['giam_gia_sp'];
        $product_category = $_POST['loai_sp'];
        $product_brand = $_POST['brand'];
        $product_sort_desc = $_POST['mo_ta_ngan_sp'];
        $product_long_desc = $_POST['mo_ta_sp'];

        $product_info = loading_product($product_id);
        $sql_product_id_classify = "SELECT * FROM `phan_loai` WHERE `id_sp` = '$product_id'";
        $product_id_classify = pdo_query($sql_product_id_classify);

        $arr_classify = array();
        $arr_size = array();
        $arr_color = array();
        foreach($product_id_classify as $product_id_classify_value){
          array_push($arr_classify, "$product_id_classify_value[size]/$product_id_classify_value[color]");
          array_push($arr_size, "$product_id_classify_value[size]");
          array_push($arr_color, "$product_id_classify_value[color]");
        }

        $arr_classify_quantity = array();
        for($i = 0; $i < sizeof($arr_classify); $i++){
          array_push($arr_classify_quantity, $_POST[$arr_classify[$i]]);
        }
      

        // check errors
          $errors = array(
            "product_name_err" => '',
            'product_picture_err' => '',
            'product_price_err' => '',
            'product_sale_price_err' => '',
            'product_category_err' => '',
            'product_brand_err' => '',
            '$product_sort_desc_err' => '',
            'product_long_desc_err' => '',
            'product_quantity_err' => '',
          );
        // name
        if($product_name == ""){
          $errors['product_name_err'] = "Tên sản phẩm chưa có dữ liệu!";
        }
        // img
        $type_img_arr = array('jpg', 'jpeg', 'png');
        if($product_img['size'] <= 0){
          $errors['product_picture_err'] = "";
        } else {
          $fileType = pathinfo($product_img['name'], PATHINFO_EXTENSION);
          if(!in_array($fileType, $type_img_arr)){
            $errors['product_picture_err'] = "Chỉ cho phép ảnh dạng PNG hặc JPG!";
          }
        }
        // price
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
          if($product_img['size'] <= 0){
            $img_url = $product_info['anh_sp'];
          } else if($product_img['size'] > 0){
            $img_url = '';
            if($product_img['tmp_name'] != ''){
              $folderName = 'view/image/image_product/';
              $fileName = uniqid() . '_' . $product_img['name'];
              move_uploaded_file($product_img['tmp_name'], $folderName . $fileName);
              $img_url = $folderName . $fileName;
            }
          }

          $percentage_price = ($product_sale_price / 100) * (int)$product_price;
          $new_product_price = (int)$product_price - $percentage_price;

          $sql_update_product_detail_info = "UPDATE `san_pham` SET `ten_sp` = '$product_name', `anh_sp` = '$img_url', `gia_sp` = '$new_product_price', `giam_gia_sp` = '$product_sale_price', `loai_sp` = '$product_category', `brand` = '$product_brand', `mo_ta_ngan_sp` = '$product_sort_desc', `mo_ta_sp` = '$product_long_desc' WHERE `id_sp` = '$product_id'";
          pdo_execute($sql_update_product_detail_info);
          for($i = 0; $i < sizeof($arr_classify); $i++){
            $sql_update_product_detail_quantity = "UPDATE `phan_loai` SET `so_luong_sp` = '$arr_classify_quantity[$i]' WHERE `id_sp` = '$product_id' AND `size` = '$arr_size[$i]' AND `color` = '$arr_color[$i]';";
            pdo_execute($sql_update_product_detail_quantity);
          }
          header("location: index.php?section=product_update_section&product_id=$product_id");
          ob_end_flush();
        }
      }

      if(isset($_GET['product_id_delete'])){
        $product_id = $_GET['product_id_delete'];

        $sql_delete_product_classify_selected = "DELETE FROM `phan_loai` WHERE `id_sp` = '$product_id'";
        pdo_execute($sql_delete_product_classify_selected);
        $sql_delete_product_selected = "DELETE FROM `san_pham` WHERE `id_sp` = '$product_id'";
        pdo_execute($sql_delete_product_selected);
        header("location: index.php?section=product_list");
        ob_end_flush();
      }

      include "./view/section/product/product_update_section.php";
      break;

      case "classify_setting":
        $product_id = $_GET['product_id'];
        $sql_loading_classify_of_product = "SELECT * FROM `phan_loai` WHERE `id_sp` = '$product_id'";
        $classify_of_product = pdo_query($sql_loading_classify_of_product);

        if(isset($_GET['isDelete']) && $_GET['isDelete'] == true){
          $product_id = $_GET['product_id'];
          $product_size = $_GET['size'];
          $product_color = $_GET['color'];

          $sql_delete_classify_product = "DELETE FROM `phan_loai` WHERE `id_sp` = '$product_id' AND `size` = '$product_size' AND `color` = '$product_color'";
          pdo_execute($sql_delete_classify_product);
          header("location: index.php?section=classify_setting&product_id=$product_id");
          ob_end_flush();
        }

        include "./view/section/product/classify_setting.php";
        break;

      case "add_classify":
        $product_id = $_GET['product_id'];
        $product_info = loading_product($product_id);

        if(isset($_POST['form__add__classify__product__add--btn'])){
          $size = $_POST['size'];
          $color = $_POST['color'];
          $product_quantity = $_POST['so_luong_sp'];

          $sql_classify_arr_of_product = "SELECT * FROM `phan_loai` WHERE `id_sp` = '$product_id'";
          $classify_arr_of_product = pdo_query($sql_classify_arr_of_product);
          
          $isExits = false;
          foreach($classify_arr_of_product as $val){
            if($val['size'] == $size && $val['color'] == $color){
              $isExits = true;
              break;
            }
          }

          if($isExits == true){
            function_alert("Phân loại đã tồn tại!");
          } else {
            admin_insert_product_classify($product_id, $color, $size, $product_quantity);
          }

          
        }

        include "./view/section/product/add_classify.php";
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

      if(isset($_GET['category_id_delete'])){
        $category_id = $_GET['category_id_delete'];
        $sql_delete_category = "DELETE FROM `loai_sp` WHERE `id_loai_sp` = '$category_id'";
        pdo_execute($sql_delete_category);
        header("location: index.php?section=category_list");
        ob_end_flush();
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
        $category_id = $_GET['category_id'];
        $sql_category_info = "SELECT * FROM `loai_sp` WHERE `id_loai_sp` = '$category_id'";
        $category_info = pdo_query_one($sql_category_info);

        if(isset($_POST['form__update__category__submit--btn'])){
          $category_name = $_POST['ten_loai_sp'];
          
          if($category_name == ''){
            function_alert("Tên danh mục chưa có dữ liệu");
          } else {
            $sql_update_category = "UPDATE `loai_sp` SET `ten_loai_sp` = '$category_name' WHERE `id_loai_sp` = $category_id";
            pdo_execute($sql_update_category);
            header("location: index.php?section=category_list");
            ob_end_flush();
          }
        }

        include "./view/section/category/update_category.php";
        break;

        // brand
    case "brand_list":
      if(isset($_POST['brand__section__search--submit'])){
        $brand_search_name = $_POST['brand__section__search--value'];

        $sql_get_product_brand_by_keyword = "SELECT * FROM `brand` WHERE `ten_brand` LIKE '%$brand_search_name%'";
        $brands = pdo_query($sql_get_product_brand_by_keyword);
      } else {
        $brands = loading_product_brand_without_id_product();
      }

      if(isset($_GET['brand_id_delete'])){
        $brand_id = $_GET['brand_id_delete'];
        $sql_delete_brand = "DELETE FROM `brand` WHERE `id_brand` = '$brand_id'";
        pdo_execute($sql_delete_brand);
        header("location: index.php?section=brand_list");
        ob_end_flush();
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

        case "update_brand":
          $brand_id = $_GET['brand_id'];
          $sql_brand_info = "SELECT * FROM `brand` WHERE `id_brand` = '$brand_id'";
          $brand_info = pdo_query_one($sql_brand_info);
  
          if(isset($_POST['form__update__brand__submit--btn'])){
            $brand_name = $_POST['ten_brand'];
            
            if($brand_name == ''){
              function_alert("Tên brand chưa có dữ liệu");
            } else {
              $sql_update_brand = "UPDATE `brand` SET `ten_brand` = '$brand_name' WHERE `id_brand` = $brand_id";
              pdo_execute($sql_update_brand);
              header("location: index.php?section=brand_list");
              ob_end_flush();
            }
          }
          include "./view/section/brand/update_brand.php";
          break;


    case "user_list":
      if(isset($_POST['user__section__search--submit'])){
        $user_search_name = $_POST['user__section__search--value'];

        $sql_get_product_user_by_keyword = "SELECT * FROM `tai_khoan` WHERE `ho_va_ten` LIKE '%$user_search_name%'";
        $users = pdo_query($sql_get_product_user_by_keyword);
      } else {
        $users = loading_product_user_without_id_user();
      }
      include "./view/section/user/user_list.php";
      break;

      case "comment_list":
        if(isset($_GET['comment_id_delete'])){
          $comment_id_delete = $_GET['comment_id_delete'];

          $sql_delete_comment = "DELETE FROM `binh_luan` WHERE `id_binh_luan` = '$comment_id_delete'";
          pdo_execute($sql_delete_comment);
          header("location: index.php?section=comment_list");
          ob_end_flush();
        }

        if(isset($_POST['comment__section__search--submit'])){
          $comment_keyword = $_POST['comment__section__search--value'];

          $loading_id_product_buy_keyword = "SELECT * FROM `san_pham` WHERE `ten_sp` LIKE '%$comment_keyword%'";
          $product = pdo_query_one($loading_id_product_buy_keyword);
          $sql_loading_comment_by_keyword = "SELECT * FROM `binh_luan` WHERE `id_sp` = '$product[id_sp]'";
          $comment_detail = pdo_query($sql_loading_comment_by_keyword);
        } else {
          $sql_loading_comment = "SELECT * FROM `binh_luan`";
          $comment_detail = pdo_query($sql_loading_comment);
        }

        
        include "./view/section/dashboard/comment_list.php";

    default: 
      include "./view/section/dashboard/statistical.php";
      break;
    }

  } else {
    include "./view/section/dashboard/statistical.php";
  }

  include "./view/footer.php";
