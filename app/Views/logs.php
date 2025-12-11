<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Monitor Logs</title>
  <link rel="stylesheet" href="<?= base_url('assets/styles/logsstyle.css') ?>" />
</head>
<body>
  <div class="wrap">
    <!-- Sidebar -->
    <?= $this->include('layouts/sidebar'); ?>

    <!-- Main Content -->
    <div class="main">
      <div class="topbar">
        <h1>Monitor Logs</h1>
        <div class="top-actions">
          <button class="notify-btn">🔔</button>
        </div>
      </div>

      <!-- Logs List -->
      <div class="logs-card">
        <h3>Activity Logs</h3>
        <ul class="logs">
          <li class="logs-header">
            <div class="log-col">ID</div>
            <div class="log-col">User</div>
            <div class="log-col">Action</div>
            <div class="log-col">Date</div>
            <div class="log-col">Actions</div>
          </li>

          <?php if (!empty($logs) && is_array($logs)): ?>
            <?php foreach ($logs as $log): ?>
              <li class="logs-item">
                <div class="log-col"><?= esc($log['id']) ?></div>
                <div class="log-col"><?= esc($log['first_name'] . ' ' . $log['last_name']) ?></div>
                <div class="log-col"><?= esc($log['action']) ?></div>
                <div class="log-col"><?= date('F j, Y', strtotime($log['log_date'])) ?></div>
                <div class="log-col">
                  <button class="delete-btn">Delete</button>
                </div>
              </li>
            <?php endforeach; ?>
            
            <!-- Pagination Links -->
            <div class="pagination">
              <?= $pager->links() ?>
            </div>

          <?php else: ?>
            <div class="no-logs">No logs found.</div>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </div>
</body>
</html>