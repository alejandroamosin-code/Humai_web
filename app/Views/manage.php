<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Images</title>
  <link rel="stylesheet" href="<?= base_url('assets/styles/imagestyle.css'); ?>">
</head>
<body>
  <div class="container">
    <!-- Sidebar -->
    <?= $this->include('layouts/sidebar'); ?>

    <!-- Content -->
    <div class="content">
      <div class="header">
        <h1>Manage Images</h1>
        <div class="search-box">
          <input type="text" placeholder="Search Images">
          <button>🔍</button>
        </div>
      </div>

      <div class="image-grid">
        <!-- Upload Card -->
        <div class="image-card upload-card">
          <form action="<?= base_url('images/upload'); ?>" method="post" enctype="multipart/form-data">
            <label for="image-upload" class="upload-label">
              ⬇ Upload Image
            </label>
            <input type="file" name="image" id="image-upload" style="display:none" onchange="this.form.submit()">
          </form>
        </div>

        <!-- Existing Images -->
        <?php if (!empty($files)): ?>
          <?php foreach ($files as $img): ?>
            <div class="image-card">
              <img src="<?= base_url('uploads/'.$img); ?>" alt="Uploaded Image">
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="image-card empty-card">Add Image +</div>
          <div class="image-card empty-card">Add Image +</div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</body>
</html>
