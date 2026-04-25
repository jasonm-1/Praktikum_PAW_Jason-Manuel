<?php 
include 'auth.php'; 
checkAccess(['admin', 'member']); 
$role = $_SESSION['role']; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Exclusive Area</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="centered-wrapper">
        <div class="glass-card">
            <h1 style="color: var(--primary);">✨ Exclusive Area</h1>
            <p>Konten premium hanya untuk Member.</p>
            <hr style="margin: 25px 0; border: 0.5px solid #eee; opacity: 0.5;">

            <?php if($role === 'member'): ?>
                <form action="profile_process.php" method="POST">
                    <input type="hidden" name="action" value="cancel_membership">
                    <button type="submit" class="btn btn-danger">Hentikan Membership</button>
                </form>
            <?php endif; ?>
            
            <br>
            <a href="page_c.php" class="btn">Kembali ke Home</a>
        </div>
    </div>
</body>
</html>
