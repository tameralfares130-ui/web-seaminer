<?php
$id = (int)($_GET['id'] ?? 0);
if ($id) { $stmt = db()->prepare('DELETE FROM marks WHERE id=?'); $stmt->execute([$id]); flash('success','Mark deleted successfully.'); }
redirect_to('crud');
?>
