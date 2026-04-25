<?php 
include 'auth.php'; 
checkAccess(['admin']); 
require 'db.php';

$stmt = $conn->prepare("SELECT id, username, role FROM users WHERE role = 'member'");
$stmt->execute();
$members = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="centered-wrapper">
        <div class="glass-card" style="max-width: 750px;">
            <h1 style="color: var(--primary);">🛡️ Dashboard Admin</h1>
            <table>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($members as $m): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($m['username']); ?></td>
                        <td><span style="color: #10b981; font-weight: bold;"><?php echo $m['role']; ?></span></td>
                        <td>
                            <a href="delete_user.php?id=<?php echo $m['id']; ?>" class="btn btn-danger" onclick="return confirm('Hapus member ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <a href="page_c.php" class="btn">Kembali ke Home</a>
        </div>
    </div>
</body>
</html>
