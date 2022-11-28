<?php
include('connection.php');
$name = $_POST['name'];
$email = $_POST['email'];
$website = $_POST['website'];
$comment = $_POST['comment'];

$sql = "INSERT INTO book (`name`,`email`,`website`,`comment`) values ('$name', '$email', '$website', '$comment' )";
$query = mysqli_query($con, $sql);
$lastId = mysqli_insert_id($con);
if ($query == true) {
    $data = array(
        'status' => 'true',
    );
    echo json_encode($data);
} else {
    $data = array(
        'status' => 'false',
    );
    echo json_encode($data);
}