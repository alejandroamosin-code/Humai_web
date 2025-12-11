<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard</title>
  <link rel="stylesheet" href="<?= base_url('assets/styles/dashboardstyles.css'); ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="wrap">

  <!-- Sidebar -->
  <?= $this->include('layouts/sidebar'); ?>

  <!-- Main -->
  <main class="main">
    <header class="topbar">
      <h1>Dashboard</h1>

      <div class="top-actions">
        <button class="chip"><span>🔎</span> Map</button>
        <button class="icon-btn" aria-label="Notifications">🔔</button>
      </div>
    </header>

    <!-- Stats row -->
    <section class="stat-grid">
      <article class="stat-card">
        <div class="stat-icon">🩺</div>
        <div class="stat-meta">
          <p class="stat-label">Total Diagnoses</p>
          <p class="stat-value"><?= esc($totalDiagnosis ?? 0) ?></p>
          <p class="stat-sub">+15 this week</p>
        </div>
      </article>

      <article class="stat-card">
        <div class="stat-icon">☁️</div>
        <div class="stat-meta">
          <p class="stat-label">Images Uploaded</p>
          <p class="stat-value"><?= esc($imagesUploaded ?? 0) ?></p>
          <p class="stat-sub">Last upload 1 hour ago</p>
        </div>
      </article>

      <article class="stat-card">
        <div class="stat-icon">🧑‍🌾</div>
        <div class="stat-meta">
          <p class="stat-label">Users</p>
          <p class="stat-value"><?= esc($totalUsers ?? 0) ?></p>
          <p class="stat-sub">&nbsp;</p>
        </div>
      </article>
    </section>

    <!-- Middle row -->
    <section class="middle-grid">
      <article class="small-card">
        <div class="small-icon">🌿</div>
        <div>
          <p class="small-title">Leaf Blast Cases</p>
          <p class="small-count"><?= esc($leafBlastCount ?? 58) ?></p>
          <p class="small-sub">Most common disease</p>
        </div>
      </article>

      <article class="chart-card">
        <h3>Bacterial Blight</h3>
        <canvas id="lineChart"></canvas>
      </article>
    </section>

    <!-- Bottom row -->
    <section class="bottom-grid">
      <article class="donut-card">
        <h3>Leaf Blast Cases</h3>
        <div class="donut-wrap">
          <canvas id="donutChart" width="220" height="220"></canvas>
          <div class="donut-center">
            <span><?= esc($leafBlastPct ?? 42) ?>%</span>
          </div>
        </div>
      </article>

      <article class="logs-card">
        <h3>LOGS</h3>
        <ul class="logs">
          <li>SYSTEM UPDATED DIAGNOSIS LIST</li>
          <li>USER K ADDED A NEW FAQ</li>
          <li>USER D SUBMITTED FEEDBACK</li>
          <li>ADMIN UPDATED DIAGNOSIS LIST</li>
        </ul>
      </article>
    </section>
  </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1"></script>
<script>
  // Line chart (Bacterial Blight)
  const lineCtx = document.getElementById('lineChart');
  new Chart(lineCtx, {
    type: 'line',
    data: {
      labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul'],
      datasets: [{
        data: [18,12,19,14,22,30,26],
        tension: 0.35,
        fill: true,
        backgroundColor: 'rgba(244, 217, 169, 0.6)',
        borderColor: '#b08a45',
        borderWidth: 2,
        pointRadius: 0
      }]
    },
    options: {
      plugins: { legend: { display:false } },
      scales: {
        x: { grid: { display:false } },
        y: { grid: { color: 'rgba(0,0,0,0.06)' }, ticks: { stepSize: 5 } }
      }
    }
  });

  // Donut chart (Leaf Blast %)
  const donutCtx = document.getElementById('donutChart');
  new Chart(donutCtx, {
    type: 'doughnut',
    data: {
      labels: ['Leaf Blast', 'Others'],
      datasets: [{
        data: [<?= (int)($leafBlastPct ?? 42) ?>, <?= 100 - (int)($leafBlastPct ?? 42) ?>],
        backgroundColor: ['#e6c15a', '#eee7d9'],
        borderWidth: 0,
        cutout: '70%'
      }]
    },
    options: {
      plugins: { legend: { display:false } }
    }
  });
</script>

</body>
</html>