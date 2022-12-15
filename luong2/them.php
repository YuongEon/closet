<article class="mt-4 mb-5" style="padding-bottom: 200px;">
      <h2>Thêm Hàng Hóa</h2>
       <form action="index.php?act=adddm" method="post">
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label " style="font-weight: bold;">Mã loại</label>
            <input type="text" name="ma_loai" class="form-control w-50 bg-light" id="formGroupExampleInput" placeholder="auto number" readonly>
          </div>
          <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label"  style="font-weight: bold;">Tên loại</label>
            <input type="text" name="ten_loai" class="form-control w-50" id="formGroupExampleInput2">
          </div>
          <div class="form-group mb-3">
            <input type="submit" name="themmoi" class="btn btn-success" value="Thêm mới">
            <input type="submit"  class="btn btn-danger" value="Nhập lại">
            <a href="index.php?act=listdm" class="btn btn-primary">Danh sách</a>
          </div>
          <?php
          if(isset($notice)&&($notice > 0)){
            echo $notice;
          }
          
          ?>
       </form>
      </article>
         <!-- FOOTER -->
         <footer class="container bg-dark text-center text-white">
          <!-- Copyright -->
          <div class="text-center p-3">
            © 2020 Copyright:
            <a class="trans-04 text-none txt-f hov-red"   href="../index.html">X-Shop.com</a>
          </div>
          <!-- Copyright -->
        </footer>
    </div>