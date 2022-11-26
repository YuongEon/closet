<?php
include "./model/pdo.php";
include "./model/san_pham_funtion.php";
include "./model/user_function.php";
$id_user = 1;
include "views/header.php";

if (isset($_GET['page']) && $_GET['page'] != "") {
  $page = $_GET['page'];

  switch ($page) {
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

    // !product
    case "product":
      // get categories 
      $get_categories = "SELECT * FROM loai_sp";
      $categories = pdo_query($get_categories);
      // get brands
      $get_brands = "SELECT * FROM brand order by id_brand desc";
      $brands = pdo_query($get_brands);

      // filter
      $category_id_filter = isset($_GET['category_id']) ? $_GET['category_id'] : "";
      $brand_id_filter = isset($_GET['brand_id']) ? $_GET['brand_id'] : "";
      if (isset($_POST['header_search_product'])) {
        $search_keyword_filter = $_POST['search_keyword'];
      }
      $filter_of_loading_product = filter_of_loading_product($category_id_filter, $brand_id_filter);
      // get tag form product detail
      if (isset($_GET['tag']) && $_GET['tag'] != "") {
        $tag = $_GET['tag'];
      }
      // get products
      $products = loading_products($category_id_filter, $brand_id_filter, $search_keyword_filter, $tag);

      include "views/product_page.php";
      break;
    case "contact":

      break;
    case "about":

      break;


        // !product detail
    case "product_detail":
      $cart_products = get_cart_products($id_user);
      // insert product to cart
      if (isset($_POST['product__add__to__cart__btn'])) {
        $get_user_id = (int)$_POST['user_id'];
        $get_product_id = (int)$_POST['product_id'];
        $get_product_buy_quantity = (int)$_POST['product_quantity'];

        add_product_to_cart($get_user_id, $get_product_id, $get_product_buy_quantity, $cart_products);
        header("location: index.php?page=product_detail&id_product=$get_product_id");
        ob_end_flush();
      }
      $id_product = isset($_GET['id_product']) ? $_GET['id_product'] : "";
      // get product
      $product = loading_product($id_product);
      // get same products
      $same_products = loading_same_products($id_product);
      // get tags
      $tags = get_tags_of_product($id_product);

      include "views/product_detail.php";
      break;


          // !cart
    case "cart":
      // change quantity product
      if (isset($_GET['id_product']) && $_GET['id_product'] != '') {
        $product_id = $_GET['id_product'];
        $product_quantity_value = $_POST['table__body__value__quantity'];
        if (isset($_POST['table__body__value__addition__quantity'])) {
          $method_change = 'table__body__value__addition__quantity';
        } else if (isset($_POST['table__body__value__subtraction__quantity'])) {
          $method_change = 'table__body__value__subtraction__quantity';
        }
        change_product_quantity_value($product_id, $product_quantity_value, $method_change);
        header("location: index.php?page=cart");
        ob_end_flush();
      }
      $cart_products = get_cart_products(1);
      // get total
      $total = 0;
      foreach ($cart_products as $cart_product_value) {;
        $product = loading_product($cart_product_value['id_sp']);
        $product_price = (int)$product['gia_sp'] * (int)$cart_product_value['so_luong_sp'];
        $total += (int)$product_price;
      }
      // delete product
      if (isset($_GET['id_delete_product']) && $_GET['id_delete_product'] != '') {
        delete_product_from_cart($_GET['id_delete_product']);
        header("location: index.php?page=cart");
        ob_end_flush();
      }

      include "views/cart.php";
      break;



          // !payment 
    case "payment_page":
      $sql_get_categories = "SELECT * FROM loai_sp";
      $categories = pdo_query($sql_get_categories);
      // loading cart products
      $cart_products = get_cart_products($id_user);
      // loading user info
      $user_info_arr = array();

      // loading user info with none-sql
      if (isset($_POST['payment__info__insert__submit--btn'])) {
        $ho_va_ten = $_POST['ho_va_ten'];
        $sdt = $_POST['sdt'];
        $email = $_POST['email'];
        $address_1 = $_POST['tinh__thanh_pho'];
        $address_2 = $_POST['quan__huyen'];
        $address_3 = $_POST['phuong__xa'];
        $address_4 = $_POST['dia_chi_chi_tiet'];

        $user_info = array(
          "ho_va_ten" => "$ho_va_ten",
          "sdt" => "$sdt",
          "email" => "$email"
        );
        $user_info_address = array(
          "tinh__thanh_pho" => "$address_1",
          "quan__huyen" => "$address_2",
          "phuong__xa" => "$address_3",
          "dia_chi_chi_tiet" => "$address_4"
        );

        $user_info_arr = loading_user_info_for_payment_page($user_info, $user_info_address);
      } else if (isset($_POST['payment__info__update__submit--btn'])) {
        $sdt = $_POST['sdt'];
        $email = $_POST['email'];
        $address_1 = $_POST['tinh__thanh_pho'];
        $address_2 = $_POST['quan__huyen'];
        $address_3 = $_POST['phuong__xa'];
        $address_4 = $_POST['dia_chi_chi_tiet'];

        update_user_info($id_user, $sdt, $email);
        change_address($id_user, $address_1, $address_2, $address_3, $address_4);

        $user_info = loading_user_info($id_user);
        $user_info_address = loading_user_address($user_info['id_tai_khoan']);
        $user_info_arr = loading_user_info_for_payment_page($user_info, $user_info_address);
        header("location: index.php?page=payment_page");
        ob_end_flush();
      } else {
        // loading user info with sql
        $user_info = loading_user_info($id_user);
        $user_info_address = loading_user_address($user_info['id_tai_khoan']);
        $user_info_arr = loading_user_info_for_payment_page($user_info, $user_info_address);
      }

      // loading payment method
      $payment_methods = loading_payment_methods();
      // get total
      $total = 0;
      foreach ($cart_products as $cart_product_value) {;
        $product = loading_product($cart_product_value['id_sp']);
        $product_price = (int)$product['gia_sp'] * (int)$cart_product_value['so_luong_sp'];
        $total += (int)$product_price;
      }
      // ngay dat - nhan hang
      date_default_timezone_set("Asia/Ho_Chi_Minh");
      $take_order_date = date("d/m/Y");
      $pick_up_date_soonest = date('d/m/Y', strtotime("+7 day"));
      $pick_up_date_latest = date('d/m/Y', strtotime("+10 day"));

      include "views/payment_page.php";
      break;

    default:
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
  }
} else {
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
}

include "views/footer.php";
