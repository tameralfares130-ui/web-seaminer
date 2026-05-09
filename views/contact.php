<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['sender_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
    $errors = [];
    if ($name === '') $errors[] = 'Name is required.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required.';
    if (strlen($subject) < 3) $errors[] = 'Subject must be at least 3 characters.';
    if (strlen($message) < 10) $errors[] = 'Message must be at least 10 characters.';
    if (!$errors) {
        $stmt = db()->prepare('INSERT INTO contact_messages (user_id, sender_name, email, subject, message) VALUES (?,?,?,?,?)');
        $stmt->execute([current_user()['id'] ?? null, $name, $email, $subject, $message]);
        $_SESSION['last_contact'] = compact('name','email','subject','message');
        redirect_to('contact_result');
    } else flash('error', implode(' ', $errors));
}
?>
<section class="panel">
  <h2>Contact the owner</h2>
  <p>Send a message about the student grade portal. The data is validated by JavaScript and PHP, then saved in the database.</p>
  <form method="post" class="form-card" id="contactForm" novalidate>
    <label>Name <input name="sender_name" required></label>
    <label>Email <input name="email" required></label>
    <label>Subject <input name="subject" required></label>
    <label>Message <textarea name="message" rows="6" required></textarea></label>
    <button>Send Message</button>
  </form>
</section>
