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
      ':name' => "%{$search}%",
      ':email' => "%{$search}%",
    );

    $query = "SELECT id, name, email, avatar, registration_date, active FROM users WHERE type <> 0 AND (name LIKE :name OR email LIKE :email) ORDER BY id DESC LIMIT 10";
    $sth = $dbh->prepare($query);
    $sth->execute($data);
    $users = $sth->fetchAll(PDO::FETCH_ASSOC);
  } else {
    $query = "SELECT id, name, email, avatar, registration_date, active FROM users WHERE type <> 0 ORDER BY id DESC LIMIT 10";
    $users = $dbh->query($query);
  }

?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="ml-3">Users</h1> 
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
              <h3 class="card-title">Users List</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 200px;">
                  <input type="text" name="table_search" class="form-control float-right" id="table_search" onkeypress="enterSearch(event)" placeholder="Search by name and email" value="<?= $_GET['query'] ?? '' ?>">

                  <div class="input-group-append">
                    <a onclick="getUserSearch()" class="btn btn-default">
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
                    <th data-breakpoints="lg">Email</th>
                    <th data-breakpoints="lg">Profile Picture</th>
                    <th data-breakpoints="lg">Created Time</th>
                    <th data-breakpoints="lg">Status</th>
                    <th data-breakpoints="lg" class="text-right">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($users as $key => $user) { ?>
                    <tr>
                      <td><?= $key + 1; ?></td>
                      <td><?= $user['name']; ?></td>
                      <td><?= $user['email']; ?></td>
                      <td>
                        <?php if (!empty($user['avatar'])) { ?>
                          <a href="<?= $user['avatar'] ?>" target="_blank">
                            <img src="<?= $user['avatar'] ?>" alt="Avatar" width="80px" height="80px">
                          </a>
                        <?php } else { ?>
                          <img src="public/img/no_avatar.jpg" alt="No Avatar" width="80px" height="80px">
                        <?php } ?>
                      </td>
                      <td><?= $user['registration_date']; ?></td>
                      <td>
                        <div class="bootstrap-switch" style="width: 86px;">
                          <div class="bootstrap-switch-container" style="width: 126px; margin-left: 0px;">
                            <input type="checkbox" class="active" name="active" onchange="updateUserStatus(this)" value="<?= $user['id'] ?>" <?php if ($user['active'] === '1') echo "checked"; ?> data-bootstrap-switch="" data-off-color="danger" data-on-color="success">
                          </div>
                        </div>
                      </td>
                      <td class="text-right">
                        <?php if (strlen($user['active']) === 32) { ?>
                          <a class="btn btn-success btn-sm" onclick="verify_user(<?= $user['id'] ?>)" title="Verify">
                            <i class='bx bx-check-square'></i>
                          </a>
                        <?php } else { ?>
                          <a class="btn btn-primary btn-sm" href="user_edit.php?id=<?= $user['id']; ?>" title="Edit">
                            <i class="bx bxs-edit"></i>
                          </a>
                        <?php } ?>
                        <a class="btn btn-danger btn-sm" onclick="deleteUser(<?= $user['id'] ?>)" title="Delete">
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


<?php include 'templates/footer.php'; ?>
