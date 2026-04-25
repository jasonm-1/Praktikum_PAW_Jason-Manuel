<!DOCTYPE html>
<html lang="id">
<head>
    <title>Daftar Akun</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="centered-wrapper">
        <div class="glass-card">
            <h2 style="color: var(--primary); margin-bottom: 5px;">📝 Daftar Akun</h2>
            <p style="margin-bottom: 30px; color: #6b7280; font-size: 14px;">Gabung menjadi bagian Studio kami</p>

            <form action="register_process.php" method="POST">
                <div class="input-group">
                    <input type="text" name="username" placeholder="Buat Username" required 
                           style="background: rgba(255,255,255,0.5); border: 1px solid rgba(139, 92, 246, 0.1);">
                </div>
                <div class="input-group">
                    <input type="password" name="password" placeholder="Buat Password" required
                           style="background: rgba(255,255,255,0.5); border: 1px solid rgba(139, 92, 246, 0.1);">
                </div>
                <div class="input-group">
                    <label style="display: block; text-align: left; font-size: 12px; margin-bottom: 8px; color: #6b7280; margin-left: 5px;">Pilih Tipe Akun</label>
                    <select name="role" class="btn" style="width: 100%; margin-bottom: 20px; background: white; color: var(--text); border: 1px solid #ddd; padding: 12px;">
                        <option value="public">Public (Akses Standar)</option>
                        <option value="member">Member (Akses Eksklusif)</option>
                    </select>
                </div>
                <button type="submit" class="btn" style="width: 100%; padding: 16px;">Daftar Sekarang</button>
            </form>

            <p style="margin-top: 25px; font-size: 13px; color: #6b7280;">
                Sudah punya akun? <a href="index.php" style="color: var(--primary); font-weight: 600; text-decoration: none;">Login di sini</a>
            </p>
        </div>
    </div>
</body>
</html>
