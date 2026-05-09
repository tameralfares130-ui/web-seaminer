<?php
$pdo = db();
$q = trim($_GET['q'] ?? '');
$where = '';
$params = [];
if ($q !== '') { $where = "WHERE st.sname LIKE ? OR sub.sname LIKE ? OR m.type LIKE ? OR st.class LIKE ?"; $like = "%$q%"; $params = [$like,$like,$like,$like]; }
$stmt = $pdo->prepare("SELECT m.id, m.mdate, m.mark, m.type, st.sname AS student, st.class, sub.sname AS subject, sub.category
FROM marks m JOIN students st ON st.id=m.studentid JOIN subjects sub ON sub.id=m.subjectid $where ORDER BY m.mdate DESC, m.id DESC LIMIT 100");
$stmt->execute($params);
$rows = $stmt->fetchAll();
?>
<section class="panel">
  <h2>CRUD - Marks Table</h2>
  <p>This page uses the uploaded students, subjects and marks database. It shows the newest 100 marks and allows creating, editing and deleting rows.</p>
  <form method="get" class="searchbar"><input type="hidden" name="route" value="crud"><input name="q" value="<?= h($q) ?>" placeholder="Search student, subject, class or type"><button>Search</button><a class="button" href="index.php?route=mark_create">Create New Mark</a></form>
  <div class="table-wrap"><table><thead><tr><th>ID</th><th>Date</th><th>Student</th><th>Class</th><th>Subject</th><th>Category</th><th>Type</th><th>Mark</th><th>Action</th></tr></thead><tbody>
  <?php foreach ($rows as $r): ?><tr><td><?= h($r['id']) ?></td><td><?= h($r['mdate']) ?></td><td><?= h($r['student']) ?></td><td><?= h($r['class']) ?></td><td><?= h($r['subject']) ?></td><td><?= h($r['category']) ?></td><td><?= h($r['type']) ?></td><td><strong><?= h($r['mark']) ?></strong></td><td><a href="index.php?route=mark_edit&id=<?= h($r['id']) ?>">Edit</a> | <a href="index.php?route=mark_delete&id=<?= h($r['id']) ?>" onclick="return confirm('Delete this mark?')">Delete</a></td></tr><?php endforeach; ?>
  </tbody></table></div>
</section>
