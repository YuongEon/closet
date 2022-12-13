<div class="data__showing--region">
          <div class="data__showing--region__label--box">
            <p class="data__showing--region__label">Đơn mua</p>
          </div>
          <ul class="data__showing--region__bill--function--list">
            <li class="data__showing--region__bill--function--item">
              <a href="" class="data__showing--region__bill--function--link">Tất cả</a>
            </li>
            <li class="data__showing--region__bill--function--item">
              <a href="" class="data__showing--region__bill--function--link">Chờ xác nhận</a>
            </li>
            <li class="data__showing--region__bill--function--item">
              <a href="" class="data__showing--region__bill--function--link">Đang giao</a>
            </li>
            <li class="data__showing--region__bill--function--item">
              <a href="" class="data__showing--region__bill--function--link">Đã giao</a>
            </li>
            <li class="data__showing--region__bill--function--item">
              <a href="" class="data__showing--region__bill--function--link">Đã huỷ</a>
            </li>
          </ul>
          <div class="data__showing--region__bill">
            <div class="data__showing--region__bill--wrap">
              <?php foreach($bill_arr as $bill_key => $bill_value): ?>
              <div class="data__showing--region__bill--list">
                <!-- product -->
                <div class="data__showing--region__bill--id">
                  <p>Đơn hàng #<?= $bill_value['id_bill'] ?></p>
                </div>
                <div class="data__showing--region__bill--item--wrap">
                  <?php
                    $bill_total = 0;
                    $product_bill_list = explode(",", $bill_value['san_pham_order']);
                  ?>
                  <?php foreach($product_bill_list as $product_bill_list_key => $product_bill_list_value): ?>
                  <div class="data__showing--region__bill--item">
                    <?php
                      $product_bill_info_arr = explode(" / ", $product_bill_list_value);
                      $product_bill_info = array(
                        "ten_sp" => $product_bill_info_arr[0],
                        "size" => $product_bill_info_arr[1],
                        "color" => $product_bill_info_arr[2],
                        "so_luong_sp" => $product_bill_info_arr[3]
                      );
                    ?>
                    <?php
                          $sql_get_price_product = "SELECT `anh_sp`,`gia_sp` FROM `san_pham` WHERE `ten_sp` = '$product_bill_info[ten_sp]'";
                          $product_info = pdo_query_one($sql_get_price_product);
                          $bill_total += ($product_bill_info['so_luong_sp'] * $product_info['gia_sp']);
                        ?>
                    <div class="bill--item__img--box">
                      <img src="../admin/<?= $product_info['anh_sp']; ?>" alt="" class="bill--item__img--img">
                    </div>
                    <div class="bill--item__info__product--box">
                      <div class="bill--item__info__product--classify--box">
                        <p class="bill--item__info__product--name"><?= $product_bill_info['ten_sp'] ?></p>
                        <p class="bill--item__info__product--classify">Phân loại: <?= $product_bill_info['size'] ?> / <?= $product_bill_info['color'] ?></p>
                        <p class="bill--item__info__product--quantity">x <?= $product_bill_info['so_luong_sp'] ?></p>
                      </div>
                      <div class="bill--item__info__product--price--box">
                        <p class="bill--item__info__product--price"><?= currency_format($product_info['gia_sp']) ?></p>
                      </div>
                    </div>
                  </div>
                  <?php endforeach ?>
                </div>
                
                <!-- value -->
                <div class="data__showing--region__bill--bottom bill--total">
                  <p class="data__showing--region__bill--label bill--total">Tổng số tiền</p>
                  <p class="data__showing--region__bill--value bill--total"><?= currency_format($bill_total) ?></p>
                </div>
                <div class="data__showing--region__bill--bottom bill--status">
                  <p class="data__showing--region__bill--label bill--status">Trạng thái đơn hàng</p>
                  <?php
                    if($bill_value['trang_thai_bill'] == 0){
                      $bill_value_status = "Chờ xác nhận";
                      $bill_value_status_text_color = "#ffb600";
                    } else if($bill_value['trang_thai_bill'] == 1){
                      $bill_value_status = "Đang giao";
                      $bill_value_status_text_color = "#00a7c7";
                    } else if($bill_value['trang_thai_bill'] == 2){
                      $bill_value_status = "Đã giao";
                      $bill_value_status_text_color = "#00bd3a";
                    } else if($bill_value['trang_thai_bill'] == 3){
                      $bill_value_status = "Đã huỷ";
                      $bill_value_status_text_color = "#ff3939";
                    }
                  ?>
                  <p style="color: <?= $bill_value_status_text_color ?>;" class="data__showing--region__bill--value bill--status"><?= $bill_value_status ?></p>
                </div>
              </div>
              <?php endforeach ?>
            </div>
          </div>
        </div>