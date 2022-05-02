<?php 
  require('../database/dbconnection.php');
  require('../inc/functions.inc.php');
  include('templates/header.php');
  include('templates/navbar.php');
  include('templates/sidebar.php');
?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12" style="text-align: center;">
          <h1 class="m-0">Thêm Sản phẩm</h1> 
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Sản phẩm mới</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal">
                <div class="card-body">
                  <div class="form-group">
                    <label for="">Email address</label>
                    <input type="email" class="form-control" id="" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="">Product Name</label>
                    <input type="text" class="form-control" id="" placeholder="Enter product name">
                  </div>
                  <div class="form-group">
                    <label for="">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="">
                        <label class="custom-file-label" for="">Chọn tệp</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Tải lên</span>
                      </div>
                      <div id="thumb">

                      </div>
                    </div>
                  </div>
                  <!-- <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck2">
                        <label class="form-check-label" for="exampleCheck2">Remember me</label>
                      </div>
                    </div>
                  </div> -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Thêm</button>
                  <!-- <button type="submit" class="btn btn-default float-right">Cancel</button> -->
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
        </div>
      </div>
    </div>
  </section>
</div>


<?php include('templates/footer.php'); ?>
