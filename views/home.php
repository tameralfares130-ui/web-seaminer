<?php
$pdo = db();
$totalStudents = $pdo->query('SELECT COUNT(*) c FROM students')->fetch()['c'];
$totalSubjects = $pdo->query('SELECT COUNT(*) c FROM subjects')->fetch()['c'];
$totalMarks = $pdo->query('SELECT COUNT(*) c FROM marks')->fetch()['c'];
$avgMark = $pdo->query('SELECT ROUND(AVG(mark),2) c FROM marks')->fetch()['c'];
?>
<section class="hero">
  <div>
    <h2>Welcome to the Student Grade Management System</h2>
    <p>This website uses the uploaded school database: students, subjects and marks. It demonstrates PHP routing, database access, sessions, upload handling, forms, CRUD, responsive design and JavaScript validation.</p>
    <a class="button" href="index.php?route=crud">Open CRUD Table</a>
  </div>
</section>
<section class="cards">
  <article><h3><?= h($totalStudents) ?></h3><p>Students imported</p></article>
  <article><h3><?= h($totalSubjects) ?></h3><p>Subjects available</p></article>
  <article><h3><?= h($totalMarks) ?></h3><p>Marks stored</p></article>
  <article><h3><?= h($avgMark) ?></h3><p>Average mark</p></article>
</section>
<section class="grid two">
  <article class="panel">
    <h2>Own library video</h2>
    <video controls width="100%" muted>
      <source src="assets/videos/school-demo.mp4" type="video/mp4">
      Your browser does not support the video element.
    </video>
    <p>The local video is intentionally short and suitable for hosting upload limits.</p>
  </article>
  <article class="panel">
    <h2>Service provider video</h2>
    <iframe class="video-frame" src="https://www.youtube.com/embed/ok-plXXHlWw" title="Education video" allowfullscreen></iframe>
  </article>
</section>
<section class="panel">
  <h2>School location on Google Map</h2>
  <p>Example address: John von Neumann University, Kecskemét, Hungary.</p>
  <iframe class="map-frame" loading="lazy" src="https://www.google.com/maps?q=John%20von%20Neumann%20University%20Kecskemet%20Hungary&output=embed"></iframe>
</section>
