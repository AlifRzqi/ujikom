<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Album</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Album Foto</h1>
        <?php if (isset($_SESSION['user_id'])): ?>
            <p>Selamat datang, <?= htmlspecialchars($_SESSION['username']) ?> | <a href="logout.php">Logout</a></p>
        <?php else: ?>
            <p><a href="login.php">Login</a> | <a href="register.php">Registrasi</a></p>
        <?php endif; ?>
    </header>

    <main>
        <h2>Foto di Album</h2>
        <div class="photo-container">
            <?php
            $conn = new mysqli("localhost", "your_username", "your_password", "gallery_db");
            $album_id = intval($_GET['id']);
            $result = $conn->query("SELECT * FROM Photos WHERE album_id = $album_id");

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="photo">';
                    echo '<img src="' . htmlspecialchars($row['file_path']) . '" alt="' . htmlspecialchars($row['description']) . '">';
                    echo '<p>' . htmlspecialchars($row['description']) . '</p>';
                    echo '</div>';
                }
            } else {
                echo '<p>Tidak ada foto dalam album ini.</p>';
            }

            $conn->close();
            ?>
        </div>
    </main>
</body>
</html>
