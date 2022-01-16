<?php 
  include('../inc/functions.php');
  include('templates/header.php');
  include('templates/navbar.php');
  include('templates/sidebar.php');
?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12" style="text-align: center;">
          <h1 class="m-0">Sản phẩm</h1>
        </div>
      </div>
    </div>
  </div> 

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Danh sách sản phẩm</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Tên</th>
                    <th>Mô tả</th>
                    <th>Ảnh đại diện</th>
                    <th>Giá</th>
                    <th>Giá giảm</th>
                    <th>Trạng thái</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>183</td>
                    <td>John Doe</td>
                    <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id odit voluptatum quis doloribus similique aperiam.</td>
                    <td>
                      <a href="#"><img src="" alt="Product Thumb"></a>
                    </td>
                    <td>$ 9.99</td>
                    <td>$ 8.49</td>
                    <td>
                      <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-animate bootstrap-switch-on bootstrap-switch-focused" style="width: 86px;">
                        <div class="bootstrap-switch-container" style="width: 126px; margin-left: 0px;">
                          <input type="checkbox" name="my-checkbox" checked="" data-bootstrap-switch="" data-off-color="danger" data-on-color="success">
                        </div>
                      </div>
                    </td>
                    <td>
                      <a class="btn btn-primary btn-sm" href="#">
                        <i class="bx bxs-edit"></i>
                      </a>
                      <a class="btn btn-danger btn-sm" href="#">
                        <i class="bx bxs-trash"></i>
                      </a>
                    </td>
                  </tr>
                  <div class="pagination"><?php pagination(); ?></div> 
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div> 
    </div>
  </section>
</div>

<?php include('templates/footer.php'); ?>