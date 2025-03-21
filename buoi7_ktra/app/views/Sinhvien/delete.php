<?php
require_once __DIR__ . '/../layout/header.php'; 
require_once __DIR__ . '/../../controllers/SinhvienController.php';
// Kiểm tra đăng nhập
if (!isset($_SESSION['MaSV'])) {
    header("Location: ../../auth/login.php");
    exit();
}

$controller = new SinhvienController();
$sinhvien = $controller->detail($_GET['MaSV']);

// Xử lý khi xác nhận xóa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller->delete($_GET['MaSV']);
    header("Location: index.php"); // Chuyển hướng sau khi xóa thành công
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xóa Sinh Viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow p-4">
            <h2 class="text-center text-danger">❌ Xóa Thông Tin Sinh Viên</h2>
            
            <p class="text-center text-warning fw-bold">Bạn có chắc chắn muốn xóa sinh viên này không?</p>
            
            <div class="text-center">
                <p><strong>Họ Tên:</strong> <?= htmlspecialchars($sinhvien['HoTen']) ?></p>
                <p><strong>Giới Tính:</strong> <?= htmlspecialchars($sinhvien['GioiTinh']) ?></p>
                <p><strong>Ngày Sinh:</strong> <?= htmlspecialchars($sinhvien['NgaySinh']) ?></p>
                <p>
                    
                <?php
                    $hinh = !empty($sinhvien['Hinh']) ? htmlspecialchars($sinhvien['Hinh']) : 'images/default.png';
                        ?>


                        <img src="http://localhost:90/SANGT6/buoi7_ktra/<?= $hinh ?>" 
                                alt="Ảnh sinh viên" 
                                class="img-thumbnail" 
                                width="150">
                </p>
                <p><strong>Mã Ngành:</strong> <?= htmlspecialchars($sinhvien['MaNganh']) ?></p>
            </div>

            <form method="POST" class="text-center mt-3">
                <button type="submit" class="btn btn-danger">🗑️ Xóa</button>
                <a href="index.php" class="btn btn-secondary">🚫 Hủy</a>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
