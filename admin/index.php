<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location:login.php');
}

$timeout = 900; // 15 phút

// Kiểm tra thời gian hoạt động cuối cùng
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout)) {
    // Nếu thời gian không hoạt động vượt quá 15 phút, huỷ phiên đăng nhập
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}
// Cập nhật thời gian hoạt động cuối cùng
$_SESSION['last_activity'] = time();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/styleadmin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" type="image/png" href="/image/admin.jpg">
    <title>Admin</title>
</head>

<body>
    <div class="wrapper">
        <?php
        include("config/config.php");
        include("./modules/menu.php");
        include("./modules/main.php");

        ?>
    </div>
</body>

</html>