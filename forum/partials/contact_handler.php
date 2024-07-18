<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '_dbconnect.php';

    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

    $sql = "INSERT INTO `contact` (`name`, `email`, `message`, `timedate`) VALUES ('$name', '$email', '$message', current_timestamp())";
    $res = $conn->query($sql);

    if ($res) {
        header("Location:/forum/contact.php?status=success");
    } else {
        header("Location:/forum/contact.php?status=error");
    }
    exit();
} else {
    header("Location:/forum/contact.php");
    exit();
}
?>
