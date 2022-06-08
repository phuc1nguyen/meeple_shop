<?php 
  require_once '../inc/functions.inc.php';

  // create product
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // product description and sale price are not required
    $errors = array();

    if (!empty($_POST['name'])) {
      $name = filteredInput($_POST['name']);
    } else {
      $errors[] = 'name';
    }

    if (!empty($_POST['description'])) {
      $description = filteredInput($_POST['description']);
    } else {
      $description = "";
    }

    if (isset($_POST['price']) && filter_var($_POST['price'], FILTER_VALIDATE_FLOAT, array('min_range' => 1))) {
      $price = filteredInput($_POST['price']);
    } else {
      $errors[] = 'price';
    }

    if (isset($_POST['sale']) && filter_var($_POST['sale'], FILTER_VALIDATE_FLOAT, array('min_range' => 1))) {
      if ($_POST['sale'] > $price) {
        $errors[] = 'sale over price'; 
      } else {
        $sale = filteredInput($_POST['sale']);
      }
    } else {
      // should be 0 instead of null because these prices might need to be computed
      $sale = 0;
    }

    if (isset($_POST['stock']) && filter_var($_POST['stock'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
      $stock = filteredInput($_POST['stock']);
    } else {
      $errors[] = 'stock';
    }

    if (!empty($_POST['thumbPath'])) {
      $path = filteredInput($_POST['thumbPath']);
    } else {
      $errors[] = 'thumb';
    }

    if (isset($_POST['active'])) {
      $active = $_POST['active'];
    } else {
      $active = 1;
    }

    if (empty($errors)) {
      // if all inputs are filled in
      $slug = slugify($name);
      $data = array(
        'name' => $name, 
        'description' => $description, 
        'price' => $price, 
        'sale' => $sale, 
        'slug' => $slug, 
        'stock' => $stock, 
        'thumb' => $path,
        'active' => $active,
        'date' => (new DateTime())->format("Y-m-d H:i:s"),
      );
      $query = "INSERT INTO products";
      $query .= " (name, cate_id, description, thumb, price, price_sale, slug, stock, active, add_date)";
      $query .= " VALUES (:name, 1, :description, :thumb, :price, :sale, :slug, :stock, :active, :date);";
      $sth = $dbh->prepare($query);
      
      if ($sth->execute($data)) {
        redirect('backend/prod_index.php');
      } else {
        $msg = "<script type='text/javascript'> toastr.error('Failed to update due to server error'); </script>";
      }
    } else {
      // missing inputs alert
      $msg = "<script type='text/javascript'> toastr.error('Please fill in all fields'); </script>";
    }
  }

?>
  
<?php
  include_once 'templates/header.php';
  include_once 'templates/navbar.php';
  include_once 'templates/sidebar.php';
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
              <form class="form-horizontal" id="myForm" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name<sup>*</sup></label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name" value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                    <?php if (isset($errors) && in_array('name', $errors)) echo "<p class='red-alert'>Please fill in product name</p>"; ?>
                  </div>
                  <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="5" placeholder="Enter product description"><?= isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''; ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="price">Price<sup>*</sup></label>
                    <input type="number" class="form-control" id="price" name="price" placeholder="Enter product price" step="0.01" value="<?= htmlspecialchars($_POST['price']) ?? ''; ?>">
                    <?php if (isset($errors) && in_array('price', $errors)) echo "<p class='red-alert'>Please fill in product price</p>"; ?>
                  </div>
                  <div class="form-group">
                    <label for="sale">Price Sale</label>
                    <input type="number" class="form-control" id="sale" name="sale" placeholder="Enter product sale price" step="0.01" value="<?= htmlspecialchars($_POST['sale']) ?? ''; ?>">
                    <?php if (isset($errors) && in_array('sale over price', $errors)) echo "<p class='red-alert'>Sale price must be smaller than actual price</p>"; ?>
                  </div>
                  <div class="form-group">
                    <label for="stock">In Stock<sup>*</sup></label>
                    <input type="number" class="form-control" id="stock" name="stock" placeholder="Enter number of products in stock" value="<?= htmlspecialchars($_POST['stock']) ?? ''; ?>">
                    <?php if (isset($errors) && in_array('stock', $errors)) echo "<p class='red-alert'>Please fill in product stock</p>"; ?>
                  </div>
                  <div class="form-group">
                    <label for="">Thumbnail<sup>*</sup></label>
                    <div class="input-group" style="display: flex;">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" onchange="uploadThumb()" id="thumb" name="thumb">
                        <input type="hidden" class="" id="thumbPath" name="thumbPath" value="<?= htmlspecialchars($_POST['thumbPath']) ?? ''; ?>">
                        <label class="custom-file-label" for="thumb">Choose File</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                    <?php if (isset($errors) && in_array('thumb', $errors)) echo "<p class='red-alert'>Please upload a thumbnail for this product</p>"; ?>
                    <div id="thumbPreview" class="mt-3">
                      <img src="<?= (!empty($_POST['thumbPath'])) ? $_POST['thumbPath'] : "public/img/no_avatar.jpg" ?>" alt="No Thumbnail" width="100px" height="100px">
                    </div>
                  </div>
									<div class="form-group">
										<label for="active">Status</label>
										<select class="form-control" id="active" name="active">
											<option value="1">Active</option>
											<option value="0">Disabled</option>
										</select>
									</div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Create</button>
                  <button type="button" class="btn btn-default float-right">Cancel</button>
                </div>
              </form>
            </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php include_once 'templates/footer.php'; ?>