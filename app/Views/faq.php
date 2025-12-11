<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage FAQ</title>
  <link rel="stylesheet" href="<?= base_url('assets/styles/faqstyle.css'); ?>">
</head>
<body>
  <div class="container">
    <!-- Sidebar -->
    <?= $this->include('layouts/sidebar'); ?>

    <!-- Content -->
    <div class="content">
      <h1 class="page-title">Manage FAQ</h1>

      <div class="faq-grid">
        <?php if (!empty($faqs)): ?>
          <?php foreach ($faqs as $faq): ?>
            <div class="faq-card">
              <h3><?= esc($faq['question']); ?></h3>
              <p><?= esc($faq['answer']); ?></p>
              <?php if (!empty($faq['created_at'])): ?>
                <small class="faq-date"><?= date('F j, Y', strtotime($faq['created_at'])); ?></small>
              <?php endif; ?>
              <div class="faq-actions">
                <a href="<?= base_url('faq/edit/'.$faq['id']); ?>" class="btn-edit">Edit</a>
                <a href="<?= base_url('faq/delete/'.$faq['id']); ?>" 
                   onclick="return confirm('Are you sure you want to delete this FAQ?');" 
                   class="btn-delete">Delete</a>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p>No FAQs available.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</body>
</html>
