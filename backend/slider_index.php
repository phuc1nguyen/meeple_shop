<?php 
  require_once '../inc/functions.inc.php';
  include_once 'templates/header.php';
  include_once 'templates/navbar.php';
  include_once 'templates/sidebar.php';
?>

<?php
  if (isset($_GET['query'])) {
    $search = filteredInput($_GET['query']);
    $data = array(
      ':name' => '%' . $search . '%',
    );

    $query = "SELECT id, name, description, thumb, active";
    $query .= " FROM sliders WHERE name LIKE :name";
    $query .= " ORDER BY id DESC LIMIT 10";
    $sth = $dbh->prepare($query);
    $sth->execute($data);
    $products = $sth->fetchAll(PDO::FETCH_ASSOC);
  } else {
    $query = "SELECT id, name, description, thumb, active";
    $query .= " FROM sliders";
    $query .= " ORDER BY id DESC";
    $query .= " LIMIT 10"; 
    $products = $dbh->query($query, PDO::FETCH_ASSOC);
  }
  
?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="ml-3">Sliders</h1>
        </div>
      </div>
    </div>
  </div> 

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Sliders List</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 200px;">
                  <input type="text" name="table_search" class="form-control float-right" id="table_search" onkeypress="enterSearch(event)" placeholder="Search by name" value="<?= $_GET['query'] ?? '' ?>">

                  <div class="input-group-append">
                    <a onclick="getSearch()" class="btn btn-default text-dark">
                      <i class="fas fa-search"></i>
                    </a>
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
                    <th data-breakpoints="lg">Name</th>
                    <th data-breakpoints="lg">Description</th>
                    <th data-breakpoints="lg">Thumbnail</th>
                    <th data-breakpoints="lg">Status</th>
                    <th data-breakpoints="lg" class="text-right">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($products as $key => $item) { ?>
                  <tr>
                    <td><?= $key + 1; ?></td>
                    <td><?= $item['name']; ?></td>
                    <td><?= $item['description'] ? $item['description'] : "--"; ?></td>
                    <td>
                      <?php if (!empty($item['thumb'])) { ?>
                        <a href="<?= $item['thumb'] ?>" target="_blank">
                          <img src="<?= $item['thumb'] ?>" alt="Thumbnail" width="80px" height="80px">
                        </a>
                      <?php } else { ?>
                        <img src="" alt="No Thumbnail" width="80px" height="80px">
                      <?php } ?>
                    </td>
                    <td>
                      <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-animate bootstrap-switch-on bootstrap-switch-focused" style="width: 86px;">
                        <div class="bootstrap-switch-container" style="width: 126px; margin-left: 0px;">
                          <input type="checkbox" class="active" name="active" onchange="updateSliderStatus(this)" value="<?= $item['id'] ?>" <?php if ($item['active'] === '1') echo "checked";?> data-bootstrap-switch="" data-off-color="danger" data-on-color="success">
                        </div>
                      </div>
                    </td>
                    <td>
                      <a class="btn btn-primary btn-sm" href="prod_edit.php?id=<?= $item['id']; ?>" title="Edit">
                        <i class="bx bxs-edit"></i>
                      </a>
                      <a class="btn btn-danger btn-sm btn-this" onclick="deleteSlider(<?= $item['id']?>)" title="Delete">
                        <i class="bx bxs-trash"></i>
                      </a>
                    </td>
                  </tr>
                  <?php } ?>
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

<?php include_once 'templates/footer.php'; ?>