<?php
require_login();
$rows = db()->query("SELECT cm.*, COALESCE(CONCAT(u.family_name,' ',u.surname,' (',u.login_name,')'), 'Guest') AS sender
FROM contact_messages cm LEFT JOIN users u ON u.id=cm.user_id ORDER BY cm.sent_at DESC")->fetchAll();
?>
<section class="panel">
  <h2>Messages</h2>
  <div class="table-wrap"><table><thead><tr><th>Time</th><th>Sender</th><th>Email</th><th>Subject</th><th>Message</th></tr></thead><tbody>
  <?php foreach ($rows as $r): ?><tr><td><?= h($r['sent_at']) ?></td><td><?= h($r['sender']) ?></td><td><?= h($r['email']) ?></td><td><?= h($r['subject']) ?></td><td><?= h($r['message']) ?></td></tr><?php endforeach; ?>
  </tbody></table></div>
</section>
