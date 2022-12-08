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

        $img_url = '';

        if($product_picture['tmp_name'] != ''){
            $folderName = 'view/image/image_product/';
            $fileName = uniqid() . '_' . $product_picture['name'];
            move_uploaded_file($product_picture['tmp_name'], $folderName . $fileName);
            $img_url = $folderName . $fileName;
        }
        admin_insert_product($product_name, $img_url, $product_price, $product_sale_price, $product_category, $product_brand, $product_sort_desc,$product_long_desc);
      }
      
      $product_arr = loading_product_without_id_product();
      $last_product = end($product_arr);
      $product_name_add_classify = $last_product['ten_sp'];

      if(isset($_POST['form__insert__classify__product__add--btn'])){
        $product_id = $last_product['id_sp'];
        $color = $_POST['color'];
        $size = $_POST['size'];
        $product_quantity = $_POST['so_luong_sp'];

        admin_insert_product_classify($product_id, $color, $size, $product_quantity);
        
      }
      include "./view/section/product/insert_classify_product.php";
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

        // brand
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
