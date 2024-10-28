<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Foto - Beranda</title>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-image: url('uploads/smkn4bogor.jpg'); /* Update with your desired background */
            background-size: cover;
            color: white;
            font-family: 'Poppins', sans-serif;
            text-align: center;
        }
        header, footer {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 10px;
        }
        .navbar {
            margin-bottom: 20px;
        }
        .nav-link {
            color: white; /* Link color */
        }
        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.2); /* Background color on hover */
        }
        .album-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .album {
            background-color: rgba(255, 255, 255, 0.8);
            color: black;
            margin: 15px;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body>
    <header>
        <h1>Galeri Foto</h1>
        <?php if (isset($_SESSION['user_id'])): ?>
            <p>Selamat datang, <?= htmlspecialchars($_SESSION['username']) ?> | <a href="logout.php" style="color: white;">Logout</a></p>
        <?php else: ?>
            <p><a href="login.php" style="color: white;">Login</a> | <a href="register.php" style="color: white;">Registrasi</a></p>
        <?php endif; ?>
    </header>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Galeri Foto</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php"><i class="fas fa-home"></i> Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="upload.php"><i class="fas fa-upload"></i> Unggah Foto</a></li>
                    <li class="nav-item"><a class="nav-link" href="albums.php"><i class="fas fa-images"></i> Album</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <h2>Daftar Album</h2>
        <div class="album-container">
            <?php
            $conn = new mysqli("localhost", "root", "", "gallery_db");
            if ($conn->connect_error) {
                die("Koneksi gagal: " . $conn->connect_error);
            }

            $result = $conn->query("SELECT * FROM Albums");
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="album">';
                    echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
                    echo '<p>' . htmlspecialchars($row['description']) . '</p>';
                    echo '<a href="album.php?id=' . $row['id'] . '" class="btn btn-info">Lihat Album</a>';
                    echo '</div>';
                }
            } else {
                echo '<p>Tidak ada album tersedia.</p>';
            }

            $conn->close();
            ?>
        </div>
    </main>

    <footer>
        <p>&copy; <?= date("Y") ?> Galeri Foto. Semua hak dilindungi.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
