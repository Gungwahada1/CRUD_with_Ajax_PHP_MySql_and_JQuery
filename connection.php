<?php
$con  = mysqli_connect('localhost', 'root', '', 'guestbook');
if (mysqli_connect_errno()) {
    echo 'Database Connection Error';
}