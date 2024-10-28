<?php
session_start();
$conn = new mysqli("localhost", "root", "", "gallery_db");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM Users WHERE username = '$username'");
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Pengguna tidak ditemukan.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Login - SMK Negeri 4 Bogor</title>
    <link href="img/smk.ico" rel="icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Poppins" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <style>
        body {
            background-image: url('uploads/smkn4bogor.jpg'); /* Update with your image path */
            background-size: cover;
            background-position: center;
            color: white;
            font-family: 'Poppins', sans-serif;
            height: 100vh; /* Full height for centering */
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgba(0, 0, 0, 0.8); /* Dark overlay */
            display: flex; /* Use flex to center modal content */
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background-color: rgba(255, 255, 255, 0.95); /* Light modal background */
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            width: 400px; 
            color: #333; /* Dark text for contrast */
            text-align: center; /* Center text inside modal */
        }
        .modal h2 {
            margin-bottom: 20px; /* Space below the title */
            font-size: 24px;
        }
        .form-group {
            margin-bottom: 15px; /* Space between fields */
        }
        .btn-primary {
            background-color: #007bff; /* Bootstrap primary color */
            border-color: #007bff; 
            width: 100%; /* Full width button */
        }
        .btn-primary:hover {
            background-color: #0056b3; /* Darker shade on hover */
            border-color: #0056b3;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        footer {
            text-align: center;
            margin-top: 20px;
        }
        @media (max-width: 500px) {
            .modal-content {
                width: 90%; /* Responsive width for smaller screens */
            }
        }
    </style>
</head>
<body>
    <button id="loginBtn" class="btn btn-light" style="display: none;">Login</button> <!-- Hidden button for triggering modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Masuk ke Galeri Foto</h2>
            <form action="login_process.php" method="POST">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <p>Belum punya akun? <a href="register.php" style="color: #007bff;">Registrasi di sini</a></p>
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; <?= date("Y") ?> SMK Negeri 4 Bogor. Semua hak dilindungi.</p>
    </footer>

    <script>
        // Modal
        var modal = document.getElementById("myModal");
        var btn = document.getElementById("loginBtn");
        var span = document.getElementsByClassName("close")[0];

        btn.onclick = function() {
            modal.style.display = "flex"; // Use flex to center modal content
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        // Show modal on page load (for demonstration purposes)
        window.onload = function() {
            btn.click();
        }
    </script>
</body>
</html>
