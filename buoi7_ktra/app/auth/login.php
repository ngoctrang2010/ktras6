<?php
session_start();
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Sinhvien.php';

$errMsg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $maSV = $_POST['MaSV'] ?? '';

    if (!empty($maSV)) {
        $sinhvienModel = new Sinhvien();
        $sinhvien = $sinhvienModel->findById($maSV);

        if ($sinhvien) {
            $_SESSION['MaSV'] = $sinhvien['MaSV'];
            header("Location: ../views/Sinhvien/index.php");
            exit();
        } else {
            $errMsg = "❌ Mã sinh viên không tồn tại!";
        }
    } else {
        $errMsg = "⚠️ Vui lòng nhập Mã Sinh Viên!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">

    <div class="card shadow-lg p-4 rounded" style="width: 400px;">
        <h3 class="text-center text-primary">🔑 Đăng Nhập</h3>

        <?php if (!empty($errMsg)): ?>
            <div class="alert alert-danger"><?= $errMsg ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label for="MaSV" class="form-label">Mã Sinh Viên</label>
                <input type="text" name="MaSV" id="MaSV" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">🚀 Đăng Nhập</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
