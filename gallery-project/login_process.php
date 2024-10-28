<?php
session_start();
$conn = new mysqli("localhost", "root", "", "gallery_db");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM Users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: index.php"); // Redirect to the main homepage
            exit();
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Pengguna tidak ditemukan.";
    }

    $stmt->close();
}

$conn->close();
?>
