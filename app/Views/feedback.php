<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Feedback</title>
  <link rel="stylesheet" href="<?= base_url('assets/styles/feedbackstyle.css'); ?>">
</head>
<body>
  <div class="container">
    <!-- Sidebar -->
    <?= $this->include('layouts/sidebar'); ?>

    <!-- Content -->
    <div class="content">
      <div class="feedback-header">
        <h1 class="page-title">View Feedback</h1>
        <div class="search-box">
          <form action="<?= base_url('feedback/search'); ?>" method="post">
            <input type="text" name="keyword" placeholder="Search Feedback">
            <button type="submit">🔍</button>
          </form>
        </div>
      </div>

      <!-- Dropdown Filter -->
      <!-- <select class="feedback-filter">
        <option value="all">All</option>
        <option value="positive">Positive</option>
        <option value="negative">Negative</option>
      </select> -->

      <!-- Feedback List -->
      <div class="feedback-list">
        <?php if (!empty($feedbacks)): ?>
          <?php foreach ($feedbacks as $fb): ?>
            <div class="feedback-card">
              <p class="feedback-text"><strong><?= esc($fb['comments']); ?></strong></p>
              <span class="feedback-author">
                <?= esc(($fb['first_name'] ?? '') . ' ' . ($fb['last_name'] ?? '')) ?>
              </span>
              <div class="feedback-meta">
                <a href="<?= base_url('feedback/delete/'.$fb['id']); ?>" 
                   onclick="return confirm('Are you sure you want to delete this feedback?');" 
                   class="btn-delete">Delete</a>
                <span class="feedback-date">
                  <?= date('F j, Y', strtotime($fb['created_at'])); ?>
                </span>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p>No feedback available.</p>
        <?php endif; ?>
      </div>

      <!-- Pagination -->
      <div class="pagination" style="margin-top:20px;">
        <?= $pager->links(); ?>
      </div>

    </div>
  </div>
</body>
</html>
