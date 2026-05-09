<?php $data = $_SESSION['last_contact'] ?? null; ?>
<section class="panel">
  <h2>Message sent successfully</h2>
  <?php if ($data): ?>
    <table class="details-table">
      <tr><th>Name</th><td><?= h($data['name']) ?></td></tr>
      <tr><th>Email</th><td><?= h($data['email']) ?></td></tr>
      <tr><th>Subject</th><td><?= h($data['subject']) ?></td></tr>
      <tr><th>Message</th><td><?= nl2br(h($data['message'])) ?></td></tr>
    </table>
  <?php else: ?><p>No submitted data found.</p><?php endif; ?>
</section>
