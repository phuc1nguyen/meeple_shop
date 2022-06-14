<?php 
  require_once '../inc/functions.inc.php';
  include_once 'templates/header.php';
  include_once 'templates/navbar.php';
  include_once 'templates/sidebar.php';
?>

<?php
  $display = 5;
  if (isset($_GET['s']) && filter_var($_GET['s'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
    $start = $_GET['s'];
  } else {
    $start = 0;
  }

  if (isset($_GET['query'])) {
    $search = filteredInput($_GET['query']);
    $data = array(
      ':title' => '%' . $search . '%',
    );

    $query = "SELECT id, title, link, thumb, active";
    $query .= " FROM tutorials WHERE title LIKE :title";
    $query .= " ORDER BY id DESC LIMIT 0, 10";
    $sth = $dbh->prepare($query);
    $sth->execute($data);
    $tutorials = $sth->fetchAll(PDO::FETCH_ASSOC);
  } else {
    $query = "SELECT id, title, link, thumb, active";
    $query .= " FROM tutorials";
    $query .= " ORDER BY id DESC";
    $query .= " LIMIT 0, 10"; 
    $tutorials = $dbh->query($query, PDO::FETCH_ASSOC);
  }
  
?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="ml-3">Tutorials</h1>
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
              <h3 class="card-title">Tutorials List</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 200px;">
                  <input type="text" name="table_search" class="form-control float-right" id="table_search" onkeypress="enterSearch(event)" placeholder="Search by title" value="<?= $_GET['query'] ?? '' ?>">

                  <div class="input-group-append">
                    <a onclick="getSearch()" class="btn btn-default text-dark">
                      <i class="fas fa-search"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>#</th>
                    <th data-breakpoints="lg">Title</th>
                    <th data-breakpoints="lg">Preview</th>
                    <th data-breakpoints="lg">Thumbnail</th>
                    <th data-breakpoints="lg">Status</th>
                    <th data-breakpoints="lg" class="text-right">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($tutorials as $key => $item) { ?>
                  <tr>
                    <td><?= $key + 1; ?></td>
                    <td><?= $item['title']; ?></td>
                    <td>
                      <iframe src="<?= $item['link']; ?>" frameborder="0" allowfullscreen></iframe>
                    </td>
                    <td>
                      <img src="<?= $item['thumb']; ?>" alt="" width="142.6px" height="80px">
                    </td>
                    <td>
                      <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-animate bootstrap-switch-on bootstrap-switch-focused" style="width: 86px;">
                        <div class="bootstrap-switch-container" style="width: 126px; margin-left: 0px;">
                          <input type="checkbox" class="active" name="active" onchange="updateTutorialStatus(this)" value="<?= $item['id'] ?>" <?php if ($item['active'] === '1') echo "checked";?> data-bootstrap-switch="" data-off-color="danger" data-on-color="success">
                        </div>
                      </div>
                    </td>
                    <td class="text-right">
                      <a class="btn btn-primary btn-sm" href="tutorial_edit.php?id=<?= $item['id']; ?>" title="Edit">
                        <i class="bx bxs-edit"></i>
                      </a>
                      <a class="btn btn-danger btn-sm btn-this" onclick="deleteTutorial(<?= $item['id']?>)" title="Delete">
                        <i class="bx bxs-trash"></i>
                      </a>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              <?= pagination('tutorials'); ?>
            </div>
          </div>
        </div>
      </div> 
    </div>
  </section>
</div>

<?php include_once 'templates/footer.php'; ?>

