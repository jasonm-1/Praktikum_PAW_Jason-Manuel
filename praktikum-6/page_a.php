<?php include 'auth.php'; checkAccess(['admin']); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="centered-wrapper">
        <div class="glass-card" style="max-width: 750px;">
            <h1 style="color: var(--primary);">🛡️ Dashboard Admin</h1>
            <p>Manajemen Daftar Member Aktif</p>
            
            <table>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>User_Member_01</td>
                        <td><span style="color: #10b981; font-weight: bold;">Aktif</span></td>
                        <td><button class="btn btn-danger" onclick="confirmDelete()">Hentikan</button></td>
                    </tr>
                </tbody>
            </table>
            
            <a href="page_c.php" class="btn">Kembali ke Home</a>
        </div>
    </div>

    <div id="modalOverlay" class="modal-overlay"></div>
    
    <div id="confirmModal" class="custom-modal">
        <h3>Hentikan Akses?</h3>
        <p>Anda yakin ingin mencabut membership user ini?</p>
        <div style="display:flex; gap:10px; justify-content:center; margin-top:20px;">
            <button class="btn btn-danger" onclick="executeDelete()">Ya, Hentikan</button>
            <button class="btn" style="background:#9ca3af" onclick="closeModals()">Batal</button>
        </div>
    </div>

    <div id="successModal" class="custom-modal">
        <h3 style="color: #10b981;">✅ Berhasil</h3>
        <p>Membership akun tersebut telah dihentikan.</p>
        <button class="btn" onclick="closeModals()">Selesai</button>
    </div>

    <script>
        function confirmDelete() {
            document.getElementById('modalOverlay').style.display = 'block';
            document.getElementById('confirmModal').classList.add('active');
        }

        function executeDelete() {
            document.getElementById('confirmModal').classList.remove('active');
            document.getElementById('successModal').classList.add('active');
        }

        function closeModals() {
            document.getElementById('modalOverlay').style.display = 'none';
            document.getElementById('confirmModal').classList.remove('active');
            document.getElementById('successModal').classList.remove('active');
        }
    </script>
</body>
</html>
