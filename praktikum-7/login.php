if ($_POST) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $selectedRole = $_GET['role']; 

    if (empty($user) || empty($pass)) {
    } else {
        $_SESSION['username'] = $user;
        $_SESSION['role'] = $selectedRole;
        header("Location: page_c.php");
    }
}
