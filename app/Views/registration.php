<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <title>CacaoDx Registration</title>

  <!-- Custom CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/styles/registrationstyles.css'); ?>">
  
  <style>
    .alert {
      padding: 15px;
      margin-bottom: 20px;
      border: 1px solid transparent;
      border-radius: 4px;
    }
    .alert-danger {
      color: #721c24;
      background-color: #f8d7da;
      border-color: #f5c6cb;
    }
    .alert-success {
      color: #155724;
      background-color: #d4edda;
      border-color: #c3e6cb;
    }
  </style>
</head>
<body>
<section class="vh-100 gradient-custom d-flex align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-9 col-xl-7">
      
        <div class="card shadow-lg card-registration">
          <div class="card-body p-5">
            <!-- Back Button -->
            <div class="mb-3">
              <a href="<?= site_url('/login'); ?>" class="btn-back">
                ← Back to Login
              </a>
            </div>

            <!-- Error Message -->
            <?php if (session()->getFlashdata('error')): ?>
              <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
              </div>
            <?php endif; ?>

            <!-- Success Message -->
            <?php if (session()->getFlashdata('success')): ?>
              <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
              </div>
            <?php endif; ?>

            <h3 class="text-center mb-5">Registration Form</h3>
            
            <!-- CI Form -->
            <form action="<?= site_url('register'); ?>" method="post">
              
              <div class="row">
                <div class="col-md-6 mb-4">
                  <label for="firstName" class="form-label">First Name</label>
                  <input type="text" name="first_name" id="firstName" class="form-control form-control-lg" value="<?= old('first_name') ?>" required>
                </div>
                <div class="col-md-6 mb-4">
                  <label for="lastName" class="form-label">Last Name</label>
                  <input type="text" name="last_name" id="lastName" class="form-control form-control-lg" value="<?= old('last_name') ?>" required>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-4">
                  <label for="emailAddress" class="form-label">Email</label>
                  <input type="email" name="email" id="emailAddress" class="form-control form-control-lg" value="<?= old('email') ?>" required>
                </div>
                <div class="col-md-6 mb-4">
                  <label for="phoneNumber" class="form-label">Phone Number</label>
                  <input type="tel" name="phone" id="phoneNumber" class="form-control form-control-lg" value="<?= old('phone') ?>" placeholder="09957647823" pattern="[0-9]{10,11}" required>
                  <small class="text-muted">Enter 10 or 11 digits (e.g., 09957647823)</small>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-4">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" name="password" id="password" class="form-control form-control-lg" required>
                </div>
              </div>

              <div class="mt-4 text-center">
                <button class="btn btn-primary btn-lg px-5" type="submit">Register</button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>