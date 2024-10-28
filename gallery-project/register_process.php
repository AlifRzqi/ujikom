<?php
session_start();
$conn = new mysqli("localhost", "root", "", "gallery_db");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username already exists
    $stmt = $conn->prepare("SELECT * FROM Users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error'] = "Username sudah digunakan. Silakan pilih yang lain.";
        header("Location: register.php");
        exit();
    } else {
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user into the database
        $stmt = $conn->prepare("INSERT INTO Users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashed_password);
        
        if ($stmt->execute()) {
            // Automatically log in the user
            $_SESSION['user_id'] = $conn->insert_id;
            $_SESSION['username'] = $username;
            header("Location: index.php"); // Redirect to the main page after registration
            exit();
        } else {
            $_SESSION['error'] = "Terjadi kesalahan saat mendaftar. Silakan coba lagi.";
            header("Location: register.php");
            exit();
        }
    }

    $stmt->close();
}

$conn->close();
?>
