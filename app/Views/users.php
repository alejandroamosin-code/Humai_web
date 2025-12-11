<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="<?= base_url('assets/styles/userstyles.css'); ?>">
</head>
<body>
<?= $this->include('layouts/sidebar') ?>

<div class="listed-users">
  <h1 class="text-wrapper">Users</h1>

  <div class="navbar header-row">
    <div class="col name">Name</div>
    <div class="col id">ID</div>
    <div class="col email">Email</div>
    <div class="col municipality">User Type</div>
    <div class="col phone">Phone</div>
    <div class="col actions">Actions</div>
  </div>

  <?php if (!empty($users) && is_array($users)): ?>
    <?php foreach ($users as $i => $user): ?>
      <div class="navbar-row">
        <div class="col name"><?= esc($user['first_name'] . ' ' . ($user['last_name'] ?? '')) ?></div>
        <div class="col id"><?= esc($user['id']) ?></div>
        <div class="col email"><?= esc($user['email'] ?? '') ?></div>
        <div class="col municipality"><?= esc($user['user_type_id'] ?? '') ?></div>
        <div class="col phone"><?= esc($user['contact_number'] ?? '') ?></div>
        <div class="col actions">
          <a href="<?= site_url('users/edit/' . $user['id']) ?>" class="btn btn-edit">Edit</a>
        </div>
      </div>
    <?php endforeach; ?>

    <!-- Pagination Links -->
    <div class="pagination">
      <?= $pager->links() ?>
    </div>

  <?php else: ?>
    <div class="navbar-row">
      <div class="col" colspan="6" style="text-align:center;">
        No users found.
      </div>
    </div>
  <?php endif; ?>
</div>
</body>
</html>
