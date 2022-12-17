<?php
include "./model/pdo.php";
include "./model/san_pham_funtion.php";
include "./model/user_function.php";
include "./model/global_function.php";
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpMailer/src/Exception.php';
require 'phpMailer/src/PHPMailer.php';
require 'phpMailer/src/SMTP.php';

$id_user = $_SESSION['tai_khoan']['id_tai_khoan'];
$user_login = $_SESSION['tai_khoan'];
$user_info_global = loading_user_info($id_user);

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
          } else if($user_info_global['trang_thai'] == 2){
            $error .= "⚠️ Tài khoản của bạn bị cấm mua hàng!";
            function_alert($error);
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

      if(isset($_GET['createComment'])){
        $create_comment = true;
      } else {
        $create_comment = false;
      }

      if(isset($_POST['isComment'])){
        $product_id = $_POST['id_sp'];
        $user_id = $_POST['id_tai_khoan'];
        $comment_content = $_POST['noi_dung_binh_luan'];
        $star_rating = $_POST['sao_danh_gia'];

        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $date_comment = date("d/m/Y");

        var_dump($product_id, $user_id, $comment_content, $star_rating);
        $errors = array(
          "comment_err" => "",
          "star_err" => ""
        );

        if($comment_content == ''){
          $errors['comment_err'] = "Bình luận chưa có dữ liệu!";
        }

        if($star_rating == ''){
          $errors['star_err'] = "Chưa đánh giá sao!";
        }

        $check_errors = 0;
        foreach($errors as $error){
          if($error != ''){
            $check_errors += 1;
          }
        }

        if($check_errors == 0){
          insert_comment($product_id, $user_id, $comment_content, $star_rating, $date_comment);
          header("location: index.php?page=product_detail&id_product=$product_id");
          ob_end_flush();
        }
      }

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
    // case "payment_page":
      $sql_get_categories = "SELECT * FROM loai_sp";
      $categories = pdo_query($sql_get_categories);
      // loading cart products
      $cart_products = get_cart_products($id_user);
      // loading user info
      $user_info_arr = array();

      

      // loading user info with none-sql
      if (isset($_POST['payment__info__insert__submit--btn'])) {
        $ho_va_ten = $_POST['ho_va_ten'];
        $sdt = (int)$_POST['sdt'];
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
        $sdt = (int)$_POST['sdt'];
        $ho_va_ten = $_POST['ho_va_ten'];
        $email = $_POST['email'];
        $address_1 = $_POST['tinh__thanh_pho'];
        $address_2 = $_POST['quan__huyen'];
        $address_3 = $_POST['phuong__xa'];
        $address_4 = $_POST['dia_chi_chi_tiet'];


        update_user_info($id_user, $sdt, $email, $ho_va_ten);
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

      if(isset($_POST['isOrder--btn'])){
        // get user info
        $user_email = $_POST['email'];
        $user_name = $_POST['fullName'];
        $user_phone_number = $_POST['phone_number'];
        $user_address = $_POST['address'];
        $payment_method_user_selected = $_POST['payment_method'];

        $user_info_string = "$user_name, $user_email, $user_phone_number, $user_address";


        // get bill info
        $product_of_bill = $cart_products;
        $date_order = $_POST['date_order'];
        $date_take_order_soonest = $_POST['date_take_order_soonest'];
        $date_take_order_latest = $_POST['date_take_order_latest'];

        $product_of_bill_arr = array();
        foreach($product_of_bill as $product_of_bill_val){
          $product_info = loading_product($product_of_bill_val['id_sp']);
          array_push($product_of_bill_arr, "$product_info[ten_sp] + $product_of_bill_val[size], $product_of_bill_val[color] | SL: $product_of_bill_val[so_luong_sp]");
        }
        $product_of_bill_string = implode(",", $product_of_bill_arr);

        if($payment_method_user_selected == ''){
          function_alert("⚠️ Bạn chưa chọn phương thức thanh toán!");
        } else {
          $sql_insert_into_bill = "INSERT INTO `chi_tiet_bill` (`id_bill`, `id_tai_khoan`, `user_info`,`san_pham_order`, `ngay_mua`, `ngay_nhan_hang`, `phuong_thuc_thanh_toan`, `trang_thai_bill`) VALUES (NULL, '$user_info[id_tai_khoan]','$user_info_string','$product_of_bill_string', '$date_order', '$date_take_order_latest', '$payment_method_user_selected', '0');";
          pdo_execute($sql_insert_into_bill);


          // select to bill
        $sql_select_to_bill = "SELECT * FROM `chi_tiet_bill` WHERE `id_tai_khoan` = '$user_login[id_tai_khoan]'";
        $bill = pdo_query($sql_select_to_bill);
        $last_bill = end($bill);

        // send mail
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'closetfashion203@gmail.com';
        $mail->Password = 'mkeupgwabxllatjj';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('closetfashion203@gmail.com'); 
        $mail->addAddress($user_email);
        $mail->isHTML(true);
        $mail->Subject = 'THONG BAO MUA HANG THANH CONG!';
        $mail->Body = "
          <h3>$user_login[ho_va_ten],</h3>
          <p>Cảm ơn bạn vì đã lựa chọn sản phẩm của CLOSET.</p>
          <br/>
          <h3>Mã đơn hàng của bạn là <span style='color:red;'>#$last_bill[id_bill]</span></h3>
          <p>Nhân viên CLOSET sẽ liên hệ với bạn trong thời gian gần nhất để xác nhận đơn hàng!</p>
          <p>Bạn có thể xem đơn hàng của mình bất cứ khi nào trong mục \"<a href=\"\">Đơn hàng</a>\".</p>
          <h3>Danh sách sản phẩm bạn đã order:</h3>
          <table style='border: 1px solid #ddd; border-collapse: collapse;'>
            <thead>
              <tr style='background-color: #e0ae8c;'>
                <th style='border: 1px solid #ddd; padding: 15px;'>Tên sản phẩm</th>
                <th style='border: 1px solid #ddd; padding: 15px;'>Phân loại</th>
                <th style='border: 1px solid #ddd; padding: 15px;'>Đơn giá</th>
                <th style='border: 1px solid #ddd; padding: 15px;'>Số lượng</th>
                <th style='border: 1px solid #ddd; padding: 15px;'>Thành tiền</th>
              </tr>
            </thead>
            <tbody>
        ";
        $total_bill = 0;
        foreach($product_of_bill as $product_of_bill_key => $product_of_bill_val){
          $product_info_for_bill = loading_product($product_of_bill_val['id_sp']);

          $total_each_product = $product_info_for_bill['gia_sp'] * $product_of_bill_val['so_luong_sp'];
          $total_bill += $total_each_product;
          // format price
          $format_don_gia = currency_format($product_info_for_bill['gia_sp']);
          $format_total_each_product = currency_format($total_each_product);

          $mail->Body .= "
            <tr>
              <td style='border: 1px solid #ddd; padding: 15px;'>$product_info_for_bill[ten_sp]</td>
              <td style='border: 1px solid #ddd; padding: 15px;'>$product_of_bill_val[size] / $product_of_bill_val[color]</td>
              <td style='border: 1px solid #ddd; padding: 15px;'>$format_don_gia</td>
              <td style='border: 1px solid #ddd; padding: 15px;'>$product_of_bill_val[so_luong_sp]</td>
              <td style='border: 1px solid #ddd; padding: 15px;'>$format_total_each_product</td>
            </tr>
          ";
        }
        $format_total_bill = currency_format($total_bill);
        $mail->Body .= "
            </tbody>
            <tr><td style='tex-align:right;padding: 15px;'>Tổng là: <span style='color:red;'>$format_total_bill</span></td></tr>
          </table>
        ";
        $mail->Body .= "<p>Ngày đặt hàng: $date_order</p>";
        $mail->Body .= "<p>Nhận hàng muộn nhất vào ngày: $pick_up_date_latest</p>";
        if($payment_method_user_selected == '1' || $payment_method_user_selected == 1){
          $mail->Body .= "<p>Phương thức thanh toán: Thanh toán khi nhận hàng</p>"; 
        } else if($payment_method_user_selected == '2' || $payment_method_user_selected == 2){
          $mail->Body .= "<p>Phương thức thanh toán: Thanh toán online</p>"; 
          $mail->Body .= "
            <h4>Ngân hàng: Vietcombank</h4>
            <h4>Số tài khoản: 001101101111</h4>
            <div style='width:180px; height:180px'>
            <img style='width:100%; height:100%; object-fit: contain;' src='https://media.istockphoto.com/id/828088276/vector/qr-code-illustration.jpg?s=612x612&w=0&k=20&c=FnA7agr57XpFi081ZT5sEmxhLytMBlK4vzdQxt8A70M=' alt=''>
            </div>
          ";
        }
        $mail->Body .= "<p>Chúng tôi hy vọng bạn thích trải nghiệm mua sắm của mình với CLOSET và bạn sẽ sớm ghé thăm lại CLOSET sớm nhất.</p>";
        $mail->send();

        echo "
        <script>
        alert('Chúc mừng bạn đã đặt hàng thành công! ^^');
        document.location.href = 'index.php';
        </script>   
        ";
        }
      }

      include "views/payment_page.php";
      break;

    case "payment":
      $sql_get_categories = "SELECT * FROM loai_sp";
      $categories = pdo_query($sql_get_categories);
      // loading cart products
      $cart_products = get_cart_products($id_user);
      // loading user info
      $user_info_arr = array();

      // loading user info with none-sql
      if (isset($_POST['user--change__data--submit--insert'])) {
        $ho_va_ten = $_POST['ho_va_ten'];
        $sdt = (int)$_POST['sdt'];
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

      } else if (isset($_POST['user--change__data--submit--update'])) {
        $ho_va_ten = $_POST['ho_va_ten'];
        $sdt = (int)$_POST['sdt'];
        $email = $_POST['email'];
        $address_1 = $_POST['tinh__thanh_pho'];
        $address_2 = $_POST['quan__huyen'];
        $address_3 = $_POST['phuong__xa'];
        $address_4 = $_POST['dia_chi_chi_tiet'];

        update_user_info($id_user, $sdt, $email, $ho_va_ten);
        change_address($id_user, $address_1, $address_2, $address_3, $address_4);

        $user_info = loading_user_info($id_user);
        $user_info_address = loading_user_address($user_info['id_tai_khoan']);
        $user_info_arr = loading_user_info_for_payment_page($user_info, $user_info_address);
        header("location: index.php?page=payment");
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

      if(isset($_POST['isOrder--btn'])){
        // get user info
        $user_email = $_POST['email'];
        $user_name = $_POST['fullName'];
        $user_phone_number = $_POST['phone_number'];
        $user_address = $_POST['address'];
        $payment_method_user_selected = $_POST['payment_method'];

        $user_info_string = "$user_name, $user_email, $user_phone_number, $user_address";


        // get bill info
        $product_of_bill = $cart_products;
        $date_order = $_POST['date_order'];
        $date_take_order_soonest = $_POST['date_take_order_soonest'];
        $date_take_order_latest = $_POST['date_take_order_latest'];

        $product_of_bill_arr = array();
        foreach($product_of_bill as $product_of_bill_val){
          $product_info = loading_product($product_of_bill_val['id_sp']);
          array_push($product_of_bill_arr, "$product_info[ten_sp] / $product_of_bill_val[size] / $product_of_bill_val[color] / $product_of_bill_val[so_luong_sp]");
        }
        $product_of_bill_string = implode(",", $product_of_bill_arr);

        if($payment_method_user_selected == ''){
          function_alert("⚠️ Bạn chưa chọn phương thức thanh toán!");
        } else {
          $sql_insert_into_bill = "INSERT INTO `chi_tiet_bill` (`id_bill`, `id_tai_khoan`, `user_info`,`san_pham_order`, `ngay_mua`, `ngay_nhan_hang`, `phuong_thuc_thanh_toan`, `trang_thai_bill`) VALUES (NULL, '$user_info[id_tai_khoan]','$user_info_string','$product_of_bill_string', '$date_order', '$date_take_order_latest', '$payment_method_user_selected', '0');";
          pdo_execute($sql_insert_into_bill);


          // select to bill
        $sql_select_to_bill = "SELECT * FROM `chi_tiet_bill` WHERE `id_tai_khoan` = '$user_login[id_tai_khoan]'";
        $bill = pdo_query($sql_select_to_bill);
        $last_bill = end($bill);

        // send mail
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'closetfashion203@gmail.com';
        $mail->Password = 'mkeupgwabxllatjj';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('closetfashion203@gmail.com'); 
        $mail->addAddress($user_email);
        $mail->isHTML(true);
        $mail->Subject = 'THONG BAO MUA HANG THANH CONG!';
        $mail->Body = "
          <h3>$user_login[ho_va_ten],</h3>
          <p>Cảm ơn bạn vì đã lựa chọn sản phẩm của CLOSET.</p>
          <br/>
          <h3>Mã đơn hàng của bạn là <span style='color:red;'>#$last_bill[id_bill]</span></h3>
          <p>Nhân viên CLOSET sẽ liên hệ với bạn trong thời gian gần nhất để xác nhận đơn hàng!</p>
          <p>Bạn có thể xem đơn hàng của mình bất cứ khi nào trong mục \"<a href=\"\">Đơn hàng</a>\".</p>
          <h3>Danh sách sản phẩm bạn đã order:</h3>
          <table style='border: 1px solid #ddd; border-collapse: collapse;'>
            <thead>
              <tr style='background-color: #e0ae8c;'>
                <th style='border: 1px solid #ddd; padding: 15px;'>Tên sản phẩm</th>
                <th style='border: 1px solid #ddd; padding: 15px;'>Phân loại</th>
                <th style='border: 1px solid #ddd; padding: 15px;'>Đơn giá</th>
                <th style='border: 1px solid #ddd; padding: 15px;'>Số lượng</th>
                <th style='border: 1px solid #ddd; padding: 15px;'>Thành tiền</th>
              </tr>
            </thead>
            <tbody>
        ";
        $total_bill = 0;
        foreach($product_of_bill as $product_of_bill_key => $product_of_bill_val){
          $product_info_for_bill = loading_product($product_of_bill_val['id_sp']);

          $total_each_product = $product_info_for_bill['gia_sp'] * $product_of_bill_val['so_luong_sp'];
          $total_bill += $total_each_product;
          // format price
          $format_don_gia = currency_format($product_info_for_bill['gia_sp']);
          $format_total_each_product = currency_format($total_each_product);

          $mail->Body .= "
            <tr>
              <td style='border: 1px solid #ddd; padding: 15px;'>$product_info_for_bill[ten_sp]</td>
              <td style='border: 1px solid #ddd; padding: 15px;'>$product_of_bill_val[size] / $product_of_bill_val[color]</td>
              <td style='border: 1px solid #ddd; padding: 15px;'>$format_don_gia</td>
              <td style='border: 1px solid #ddd; padding: 15px;'>$product_of_bill_val[so_luong_sp]</td>
              <td style='border: 1px solid #ddd; padding: 15px;'>$format_total_each_product</td>
            </tr>
          ";
        }
        $format_total_bill = currency_format($total_bill);
        $mail->Body .= "
            </tbody>
            <tr><td style='tex-align:right;padding: 15px;'>Tổng là: <span style='color:red;'>$format_total_bill</span></td></tr>
          </table>
        ";
        $mail->Body .= "<p>Ngày đặt hàng: $date_order</p>";
        $mail->Body .= "<p>Nhận hàng muộn nhất vào ngày: $pick_up_date_latest</p>";
        if($payment_method_user_selected == '1' || $payment_method_user_selected == 1){
          $mail->Body .= "<p>Phương thức thanh toán: Thanh toán khi nhận hàng</p>"; 
        } else if($payment_method_user_selected == '2' || $payment_method_user_selected == 2){
          $mail->Body .= "<p>Phương thức thanh toán: Thanh toán online</p>"; 
          $mail->Body .= "
            <h4>Ngân hàng: Vietcombank</h4>
            <h4>Số tài khoản: 001101101111</h4>
            <div style='width:180px; height:180px'>
            <img style='width:100%; height:100%; object-fit: contain;' src='https://media.istockphoto.com/id/828088276/vector/qr-code-illustration.jpg?s=612x612&w=0&k=20&c=FnA7agr57XpFi081ZT5sEmxhLytMBlK4vzdQxt8A70M=' alt=''>
            </div>
          ";
        }
        $mail->Body .= "<p>Chúng tôi hy vọng bạn thích trải nghiệm mua sắm của mình với CLOSET và bạn sẽ sớm ghé thăm lại CLOSET sớm nhất.</p>";
        $mail->send();

        echo "
        <script>
        alert('Chúc mừng bạn đã đặt hàng thành công! ^^');
        document.location.href = 'index.php';
        </script>   
        ";
        }

        // delete product in cart
        $sql_delete_product_in_cart_after_order = "DELETE FROM `gio_hang` WHERE `id_tai_khoan` = '$user_login[id_tai_khoan]'";
        pdo_execute($sql_delete_product_in_cart_after_order);

        // decrement product quantity by id and classify
        foreach($cart_products as $cart_product_value){
          $sql_select_to_product_classify = "SELECT * FROM `phan_loai` WHERE `id_sp` = '$cart_product_value[id_sp]' and `color` = '$cart_product_value[color]' and `size` = '$cart_product_value[size]'";
          $product_classify = pdo_query_one($sql_select_to_product_classify);
          
          $new_product_quantity = $product_classify['so_luong_sp'] - $cart_product_value['so_luong_sp'];

          $sql_update_product_quantity = "UPDATE `phan_loai` SET `so_luong_sp` = '$new_product_quantity' WHERE `id_sp` = '$product_classify[id_sp]' and `color` = '$product_classify[color]' and `size` = '$product_classify[size]'";
          pdo_execute($sql_update_product_quantity);
        }
      }
      include "views/new_payment_page.php";
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
