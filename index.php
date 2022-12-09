<?php
include "./model/pdo.php";
include "./model/san_pham_funtion.php";
include "./model/user_function.php";
include "./model/global_function.php";
session_start();

$id_user = $_SESSION['tai_khoan']['id_tai_khoan'];
$user_login = $_SESSION['tai_khoan'];
include "views/header.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpMailer/src/Exception.php';
require 'phpMailer/src/PHPMailer.php';
require 'phpMailer/src/SMTP.php';

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
      $error = '';
      if (isset($_POST['product__add__to__cart__btn'])) {
        $user_id = $_POST['user_id'];
        $product_id = $_POST['product_id'];
        $product_buy_quantity = $_POST['product_quantity'];
        $product_size = $_POST['size'];
        $product_color = $_POST['color'];


        $error = '';
        if ($product_size == '' || $product_size == NULL || $product_color == '' || $product_color == NULL) {
          $error .= "⚠️ Vui lòng chọn size hoặc màu sắc sản phẩm!";
          function_alert($error);
        } else {

          if(!isset($_SESSION['tai_khoan'])){
            header("location: ./login_method/index.php");
            ob_end_flush();
          } else {
            $select_product_quantity_of_each_classify = "SELECT * FROM phan_loai WHERE id_sp = '$product_id' and size = '$product_size' and color = '$product_color'";
            $product_quantity_of_each_classify = pdo_query_one($select_product_quantity_of_each_classify);

            $stocking_product = true;
            if($product_quantity_of_each_classify['so_luong_sp'] > 0){
              $stocking_product = true;
            } else {
              $stocking_product = false;
            }
            if ($stocking_product == false) {
              $error .= "Sản phẩm đã hết hàng!";
              function_alert($error);
            } else {
              insert_product_to_cart($cart_products, $user_id, $product_id, $product_buy_quantity, $product_size, $product_color);
              header("location: index.php?page=product_detail&id_product=$product_id");
              ob_end_flush();
            }
          }
        }
      }


      $id_product = isset($_GET['id_product']) ? $_GET['id_product'] : "";
      // get product
      $product = loading_product($id_product);
      // get classify

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
        $product_size = $_GET['size'];
        $product_color = $_GET['color'];
        $product_quantity_value = $_POST['table__body__value__quantity'];
        if (isset($_POST['table__body__value__addition__quantity'])) {
          $method_change = 'table__body__value__addition__quantity';
        } else if (isset($_POST['table__body__value__subtraction__quantity'])) {
          $method_change = 'table__body__value__subtraction__quantity';
        }
        change_product_quantity_value($product_id, $product_size, $product_color, $product_quantity_value, $method_change);
        header("location: index.php?page=cart");
        ob_end_flush();
      }
      // get product
      $cart_products = get_cart_products($id_user);
      // get total
      $total = 0;
      foreach ($cart_products as $cart_product_value) {;
        $product = loading_product($cart_product_value['id_sp']);
        $product_price = (int)$product['gia_sp'] * (int)$cart_product_value['so_luong_sp'];
        $total += (int)$product_price;
      }
      // delete product
      if (isset($_GET['id_delete_product']) && $_GET['id_delete_product'] != '') {
        delete_product_from_cart($_GET['id_delete_product'], $_GET['size'], $_GET['color']);
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

      if(isset($_GET['isOrder']) && $_GET['isOrder'] == true){
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'closetfashion203@gmail.com';
        $mail->Password = 'mkeupgwabxllatjj';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('closetfashion203@gmail.com'); 
        $mail->addAddress($user_login['email']);
        $mail->isHTML(true);
        $mail->Subject = 'THONG BAO MUA HANG THANH CONG!';
        $mail->Body = 'Chuc mung';
        $mail->send();

        echo "
        <script>
        alert('Chúc mừng bạn đã đặt hàng thành công! ^^');
        document.location.href = 'index.php';
        </script>   
        ";
      }

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
