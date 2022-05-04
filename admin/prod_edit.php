<?php 
  require_once("../database/dbconnection.php");
  require_once("../inc/functions.inc.php");

  if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
    $prodId = $_GET['id'];
  } else {
    redirect('admin/prod_index.php');
  }
  
  // query san pham theo id tu csdl
  $query = "SELECT * FROM products WHERE id = ? LIMIT 1"; 
  $sth = $dbh->prepare($query);
  $sth->bindParam(1, $prodId);

  if ($sth->execute()) {
    $product = $sth->fetch(PDO::FETCH_ASSOC);
  } else {
    redirect('admin/prod_index.php');
  }

  // update san pham trong csdl
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

    if (isset($_POST['stock']) && filter_var($_POST['stock'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
      $stock = filteredInput($_POST['stock']);
    } else {
      $errors[] = 'sale';
    }

    // if (isset($_POST['thumbnail'])) {
    //   $thumb = '';
    // } else {
    //   $errors[] = 'thumbnail'; 
    // }

    if (empty($errors)) {
      // neu ko co input trong thi query csdl
      $data = array("name" => $name, "description" => $description, "price" => $price, "sale" => $sale, "stock" => $stock, "id" => $prodId);
      $query = "UPDATE products ";
      $query .= "SET name = :name, description = :description, price = :price, price_sale = :sale, stock = :stock ";
      $query .= "WHERE id = :id LIMIT 1";
      $sth = $dbh->prepare($query);
      
      if ($sth->execute($data)) {
        redirect('admin/prod_index.php');
      } else {
        $msg = "<p class='noti noti-warning'>Failed to update due to server error</p>";
      }
    } else {
      // neu co input trong thi thong bao loi
      $msg = "<p class='noti noti-warning'>Please fill in all fields</p>";
    }
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
          <h1 class="ml-2">Update Product</h1> 
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
              <form class="form-horizontal" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Product Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name" value="<?= isset($product['name']) ? $product['name'] : ''; ?>">
                  </div>
                  <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="5" placeholder="Enter product description"><?= isset($product['description']) ? $product['description'] : ''; ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" name="price" placeholder="Enter product price" value="<?= isset($product['price']) ? $product['price'] : ''; ?>">
                  </div>
                  <div class="form-group">
                    <label for="sale">Price Sale</label>
                    <input type="number" class="form-control" id="sale" name="sale" placeholder="Enter product sale price" value="<?= isset($product['price_sale']) ? $product['price_sale'] : ''; ?>">
                  </div>
                  <div class="form-group">
                    <label for="stock">In Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" placeholder="Enter number of products in stock" value="<?= isset($product['stock']) ? $product['stock'] : ''; ?>">
                  </div>
                  <!-- <div class="form-group">
                    <label for="">Thumbnail</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="thumbnail" name="thumbnail">
                        <label class="custom-file-label" for="">Choose File</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                      <div id="thumb">

                      </div>
                    </div>
                  </div> -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Update</button>
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