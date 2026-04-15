<?php include 'auth.php'; checkAccess(['admin', 'member']); $role = $_SESSION['role']; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Exclusive Area</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="centered-wrapper">
        <div class="glass-card">
            <h1 style="color: var(--primary);">✨ Exclusive Area</h1>
            <p>Konten rahasia studio ada di sini!</p>
            <hr style="margin: 25px 0; border: 0.5px solid #eee; opacity: 0.5;">

            <?php if($role === 'member'): ?>
                <button class="btn btn-danger" onclick="confirmCancel()">Hentikan Membership</button>
            <?php else: ?>
                <p><em>(Opsi manajemen membership disembunyikan untuk Admin)</em></p>
            <?php endif; ?>
            
            <br><br>
            <a href="page_c.php" class="btn">Kembali ke Home</a>
        </div>
    </div>

    <div id="modalOverlay" class="modal-overlay"></div>
    
    <div id="cancelModal" class="custom-modal">
        <h3>Putus Membership?</h3>
        <p>Tindakan ini tidak bisa dibatalkan. Anda akan kehilangan akses premium.</p>
        <div style="display:flex; gap:10px; justify-content:center; margin-top:20px;">
            <button class="btn btn-danger" onclick="finishCancel()">Ya, Saya Yakin</button>
            <button class="btn" style="background:#9ca3af" onclick="closeModals()">Batal</button>
        </div>
    </div>

    <div id="finalModal" class="custom-modal">
        <h3>Membership Terputus</h3>
        <p>Anda akan dialihkan ke halaman utama dalam 3 detik...</p>
    </div>

    <script>
        function confirmCancel() {
            document.getElementById('modalOverlay').style.display = 'block';
            document.getElementById('cancelModal').classList.add('active');
        }

        function finishCancel() {
            document.getElementById('cancelModal').classList.remove('active');
            document.getElementById('finalModal').classList.add('active');
            setTimeout(() => { 
                window.location.href = 'logout.php'; 
            }, 2000);
        }

        function closeModals() {
            document.getElementById('modalOverlay').style.display = 'none';
            document.getElementById('cancelModal').classList.remove('active');
        }
    </script>
</body>
</html>
