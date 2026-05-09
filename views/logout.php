<?php
session_destroy();
session_start();
flash('success','You have logged out.');
redirect_to('home');
?>
