<?php
$pdo = db();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_login();
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $allowed = ['image/jpeg'=>'jpg','image/png'=>'png','image/gif'=>'gif','image/webp'=>'webp'];
        $mime = mime_content_type($_FILES['image']['tmp_name']);
        if (isset($allowed[$mime])) {
            $name = uniqid('img_', true) . '.' . $allowed[$mime];
            move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../assets/uploads/' . $name);
            $stmt = $pdo->prepare('INSERT INTO images (filename, original_name, uploaded_by) VALUES (?,?,?)');
            $stmt->execute([$name, $_FILES['image']['name'], current_user()['id']]);
            flash('success','Image uploaded successfully.'); redirect_to('images');
        } else flash('error','Only JPG, PNG, GIF and WEBP images are allowed.');
    }
}
$images = $pdo->query('SELECT images.*, users.login_name FROM images LEFT JOIN users ON users.id=images.uploaded_by ORDER BY uploaded_at DESC')->fetchAll();
?>
<section class="panel">
  <h2>Image Gallery</h2>
  <?php if (is_logged_in()): ?>
  <form method="post" enctype="multipart/form-data" class="upload-box">
    <input type="file" name="image" accept="image/*" required>
    <button>Upload Image</button>
  </form>
  <?php else: ?>
  <p class="alert info">Only logged-in users can upload images. You can still view the gallery.</p>
  <?php endif; ?>
</section>
<section class="gallery">
  <figure><img src="assets/images/classroom.svg" alt="Classroom"><figcaption>Classroom</figcaption></figure>
  <figure><img src="assets/images/books.svg" alt="Books"><figcaption>Study materials</figcaption></figure>
  <figure><img src="assets/images/grades.svg" alt="Grades"><figcaption>Marks dashboard</figcaption></figure>
  <?php foreach ($images as $img): ?>
    <figure><img src="assets/uploads/<?= h($img['filename']) ?>" alt="Uploaded image"><figcaption><?= h($img['original_name']) ?> by <?= h($img['login_name'] ?? 'Unknown') ?></figcaption></figure>
  <?php endforeach; ?>
</section>
