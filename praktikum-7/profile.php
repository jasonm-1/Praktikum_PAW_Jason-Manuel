<?php
include 'auth.php';
require 'db.php';
$id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $id]);
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Pengaturan Profil</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="centered-wrapper">
        <div class="glass-card">
            <h2 style="color: var(--primary);">⚙️ Pengaturan Profil</h2>
            
            <form action="profile_process.php" method="POST">
                <input type="hidden" name="action" value="update">
                <div class="input-group">
                    <label style="display:block; text-align:left; font-size: 12px; margin-bottom:5px; color: #6b7280;">Username Baru:</label>
                    <input type="text" name="new_username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                </div>
                <button type="submit" class="btn" style="width: 100%;">Simpan Perubahan</button>
            </form>

            <hr style="margin: 30px 0; opacity: 0.2;">

            <h4 style="color: var(--danger); margin-bottom: 5px;">Zona Berbahaya</h4>
            <p style="font-size: 12px; color: #6b7280; margin-bottom: 20px;">Menghapus akun akan menghilangkan semua data Anda secara permanen.</p>
            
            <form action="profile_process.php" method="POST" onsubmit="return confirm('Yakin ingin hapus akun selamanya?')">
                <input type="hidden" name="action" value="delete">
                <button type="submit" class="btn btn-danger" style="width: 100%; background: #fda4af; color: #be123c;">Hapus Akun Saya</button>
            </form>
            
            <div style="margin-top: 25px; border-top: 1px solid rgba(0,0,0,0.05); padding-top: 20px;">
                <a href="page_c.php" class="btn" style="background: rgba(0,0,0,0.05); color: #6b7280; width: 80%;">← Kembali ke Home</a>
            </div>
        </div>
    </div>
</body>
</html>
