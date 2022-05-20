<?php 
  require_once("../database/dbconnection.php");
  require_once("../inc/functions.inc.php");

  // them san pham
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = array();
    
    if (isset($_POST['name']) ) {
      $name = filteredInput($_POST['name']);
    } else {
      $errors[] = 'name';
    }

    if (isset($_POST['description'])) {
      $description = filteredInput($_POST['description']);
    } else {
      $errors[] = 'description';
    }

    if (isset($_POST['price']) && filter_var($_POST['price'], FILTER_VALIDATE_FLOAT, array('min_range' => 1))) {
      $price = filteredInput($_POST['price']);
    } else {
      $errors[] = 'price';
    }

    if (isset($_POST['sale']) && filter_var($_POST['sale'], FILTER_VALIDATE_FLOAT, array('min_range' => 1))) {
      $sale = filteredInput($_POST['sale']);
    } else {
      $errors[] = 'sale';
    }

    // if ($price < $sale) $errors[] = 'pricegtsale';

    if (isset($_POST['stock']) && filter_var($_POST['stock'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
      $stock = filteredInput($_POST['stock']);
    } else {
      $errors[] = 'sale';
    }

    if (isset($_FILES['thumb'])) {
      $allowed = array('image/jpg', 'image/jpeg', 'image/png');
      print_r($_FILES['thumb']);

      if (in_array($_FILES['thumb']['type'], $allowed)) {
        // uploaded file is valid
        $tmp = explode('.', $_FILES['thumb']['name']);
        $ext = end($tmp);
        // separate into 2 lines because:
        // https://stackoverflow.com/questions/4636166/only-variables-should-be-passed-by-reference#4636183
        $remaned = time() . '_' . uniqid(rand(), false) . '.' . $ext;
        move_uploaded_file($_FILES['thumb']['tmp_name'], 'public/img/' . $remaned);
      } else {
        $msg = "<script type='text/javascript'> toastr.error('Invalid file extension'); </script>";
      }
    } else {
      $errors[] = 'thumbnail'; 
    }

    // if (empty($errors)) {
      // neu ko co input trong thi query csdl
    //   $slug = "";
    //   $data = array("name" => $name, "description" => $description, "price" => $price, "sale" => $sale, "slug" => $slug, "stock" => $stock, "date" => (new DateTime())->format("Y-m-d H:i:s"));
    //   $query = "INSERT INTO products";
    //   $query .= " (name, cate_id, description, thumb, images, price, price_sale, slug, stock, add_date)";
    //   $query .= " VALUES (:name, 1, :description, 'test', 'test', :price, :sale, :slug, :stock, :date)";
    //   $sth = $dbh->prepare($query);
      
    //   if ($sth->execute($data)) {
    //     redirect('backend/prod_index.php');
    //   } else {
    //     $msg = "<p class='noti noti-warning'>Failed to update due to server error</p>";
    //   }
    // } else {
    //   // neu co input trong thi thong bao loi
    //   // $msg = "<p class='noti noti-warning'>Please fill in all fields</p>";
    //   $msg = "<script type='text/javascript'> toastr.error('Please fill in all field'); </script>";
    // }
  }

?>
  
<?php
  include_once("templates/header.php");
  include_once("templates/navbar.php");
  include_once("templates/sidebar.php");
?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="ml-2">Create Product</h1> 
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
                <h3 class="card-title">Product Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Product Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name">
                  </div>
                  <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="5" placeholder="Enter product description"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" name="price" placeholder="Enter product price" step="0.01">
                  </div>
                  <div class="form-group">
                    <label for="sale">Price Sale</label>
                    <input type="number" class="form-control" id="sale" name="sale" placeholder="Enter product sale price" step="0.01">
                  </div>
                  <div class="form-group">
                    <label for="stock">In Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" placeholder="Enter number of products in stock">
                  </div>
                  <div class="form-group">
                    <label for="">Thumbnail</label>
                    <div class="input-group" style="display: flex;">
                      <div class="custom-file">
                        <!-- input file -->
                        <input type="file" class="custom-file-input" id="thumb" name="thumb" value="">
                        <label class="custom-file-label" for="thumb">Choose File</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                    <div id="thumb" class="mt-3">
                      <img src="/public/img/no_avatar.png" width="200px" alt="No Avatar">
                    </div>
                  </div>
									<div class="form-group">
										<label>Status</label>
										<select class="form-control" id="active" name="active">
											<option value="1">Active</option>
											<option value="0">Disabled</option>
										</select>
									</div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Create</button>
                  <button type="button" class="btn btn-default float-right">Cancel</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php include_once('templates/footer.php'); ?>