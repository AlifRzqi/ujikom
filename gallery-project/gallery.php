<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not authenticated
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gallery - SMK Negeri 4 Bogor</title>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <h1>Welcome to the Gallery, <?= htmlspecialchars($_SESSION['username']); ?></h1>
    <p>Your gallery content goes here...</p>
    <a href="logout.php">Logout</a>
</body>
</html>
