<?php 
$current_page = service('uri')->getSegment(1); 
$session = session();
$fullName = session()->get('first_name') . ' ' . session()->get('last_name');
?>

<div class="container">
  <!-- Sidebar -->
  <nav class="sidebar">
    <div class="profile">
      
      <span class="username"><?= esc($fullName) ?></span>
    </div>

    <ul class="menu">
      <li class="<?= ($current_page == 'dashboard') ? 'active' : '' ?>">
        <a href="<?= site_url('dashboard'); ?>">Dashboard</a>
      </li>
      <li class="<?= ($current_page == 'manage') ? 'active' : '' ?>">
        <a href="<?= site_url('manage'); ?>">Manage Image</a>
      </li>
      <li class="<?= ($current_page == 'faq') ? 'active' : '' ?>">
        <a href="<?= site_url('faq'); ?>">Manage FAQ</a>
      </li>      
      <li class="<?= ($current_page == 'feedback') ? 'active' : '' ?>">
        <a href="<?= site_url('feedback'); ?>">View Feedback</a>
      </li>
      <li class="<?= ($current_page == 'logs') ? 'active' : '' ?>">
        <a href="<?= site_url('logs'); ?>">Monitor Logs</a>
      </li>

    </ul>

    <a href="<?= site_url('logout'); ?>" class="logout">Logout</a>
  </nav>
</div>
