<div id="layoutSidenav_content" class="container-fluid">
        <div class="container-fluid mt-3">
        <div>
            <h3 class="alert alert-success">Thêm loại điện thoại</h3>
        </div>
    <div class="form-addcate">
        <form action="./index.php?act=addl" method="post">
            <div class="form-group mt-3">
                <label for="formGroupExampleInput" class="font-lb">Mã loại</label>
                <input type="text" class="form-control" placeholder="Mã loại (auto increase)" disabled>
              </div>
              <div class="form-group mt-3">
                <label for="formGroupExampleInput" class="font-lb">Tên loại</label>
                <input type="text" name="name_cate" class="form-control" placeholder="Tên loại điện thoại">
              </div>
              <div class="wrap-btn">
                <input type="submit" name="btn_add" class="btn btn-success mt-3" value="Thêm">
                <input type="reset" class="btn btn-danger mt-3" value="Nhập lại">
              </div>
        </form>
        <h3 class="text-success fs-6 mt-3 fw-bolder">
        <?php 
        if(isset($notice) && $notice != "") { 
          echo $notice;
        }
        ?>
        </h3>
    
    </div>
    <div class="pb-300"></div>