<?php
$pdo = db();
$students = $pdo->query('SELECT id, sname, class FROM students ORDER BY sname')->fetchAll();
$subjects = $pdo->query('SELECT id, sname FROM subjects ORDER BY sname')->fetchAll();
$id = $_GET['id'] ?? null;
$editing = ($id !== null);
$row = ['studentid'=>'','subjectid'=>'','mdate'=>date('Y-m-d'),'mark'=>'5','type'=>'quiz'];
if ($editing) {
    $stmt = $pdo->prepare('SELECT * FROM marks WHERE id=?'); $stmt->execute([$id]); $row = $stmt->fetch();
    if (!$row) { flash('error','Mark not found.'); redirect_to('crud'); }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentid = (int)($_POST['studentid'] ?? 0);
    $subjectid = (int)($_POST['subjectid'] ?? 0);
    $mdate = $_POST['mdate'] ?? date('Y-m-d');
    $mark = (int)($_POST['mark'] ?? 0);
    $type = trim($_POST['type'] ?? '');
    if ($studentid && $subjectid && preg_match('/^\d{4}-\d{2}-\d{2}$/', $mdate) && $mark >= 1 && $mark <= 5 && $type !== '') {
        if ($editing) {
            $stmt = $pdo->prepare('UPDATE marks SET studentid=?, subjectid=?, mdate=?, mark=?, type=? WHERE id=?');
            $stmt->execute([$studentid,$subjectid,$mdate,$mark,$type,$id]);
            flash('success','Mark updated successfully.');
        } else {
            $stmt = $pdo->prepare('INSERT INTO marks (studentid, subjectid, mdate, mark, type) VALUES (?,?,?,?,?)');
            $stmt->execute([$studentid,$subjectid,$mdate,$mark,$type]);
            flash('success','Mark created successfully.');
        }
        redirect_to('crud');
    } else flash('error','Please fill the form correctly.');
}
?>
<section class="panel">
  <h2><?= $editing ? 'Edit Mark' : 'Create Mark' ?></h2>
  <form method="post" class="form-card">
    <label>Student <select name="studentid" required><?php foreach ($students as $s): ?><option value="<?= h($s['id']) ?>" <?= (int)$row['studentid']===(int)$s['id']?'selected':'' ?>><?= h($s['sname'].' - '.$s['class']) ?></option><?php endforeach; ?></select></label>
    <label>Subject <select name="subjectid" required><?php foreach ($subjects as $s): ?><option value="<?= h($s['id']) ?>" <?= (int)$row['subjectid']===(int)$s['id']?'selected':'' ?>><?= h($s['sname']) ?></option><?php endforeach; ?></select></label>
    <label>Date <input type="date" name="mdate" value="<?= h($row['mdate']) ?>" required></label>
    <label>Type <input name="type" value="<?= h($row['type']) ?>" required></label>
    <label>Mark <select name="mark"><?php for($i=1;$i<=5;$i++): ?><option value="<?= $i ?>" <?= (int)$row['mark']===$i?'selected':'' ?>><?= $i ?></option><?php endfor; ?></select></label>
    <button><?= $editing ? 'Save Changes' : 'Create' ?></button>
    <a class="button secondary" href="index.php?route=crud">Back</a>
  </form>
</section>
