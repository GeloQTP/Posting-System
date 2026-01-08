<?php
session_start();
require("../includes/db_connect.php");

mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $userID = (int) $_SESSION['userID'];
    $post_id = (int) $_POST['post_id'];
    $comment = $_POST['comment_input'] ?? '';

    if (!isset($userID)) {
        header("Location: login.php");
        exit;
    }

    if (!isset($post_id)) {
        header("Location: login.php");
        exit;
    }

    if (!isset($comment)) {
        header("Location: login.php");
        exit;
    }

    $comment = trim($comment);

    if ($comment === '') {
        echo 'empty comment';
    }

    try {
        $stmt = $conn->prepare("INSERT INTO comments (postID, userID, comment) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $post_id, $userID, $comment);
        $stmt->execute();

        $conn->close();
        $stmt->close();
    } catch (Exception) {
        header("Location: dashboard.php");
        exit;
    }
    header('Location: dashboard.php');
    exit;
}
