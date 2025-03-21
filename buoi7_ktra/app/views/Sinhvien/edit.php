<?php 
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../../controllers/SinhvienController.php';
session_start();
if (!isset($_SESSION['MaSV'])) {
    header("Location: ../../auth/login.php");
    exit();
}

$controller = new SinhvienController();
$sinhvien = $controller->detail($_GET['MaSV']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller->edit($_GET['MaSV'], $_POST);
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Sinh Viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow p-4">
            <h2 class="text-center text-primary">✏️ Chỉnh Sửa Thông Tin Sinh Viên</h2>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Họ Tên:</label>
                    <input type="text" name="HoTen" class="form-control" value="<?= htmlspecialchars($sinhvien['HoTen']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Giới Tính:</label>
                    <select name="GioiTinh" class="form-select">
                        <option value="Nam" <?= $sinhvien['GioiTinh'] == 'Nam' ? 'selected' : '' ?>>Nam</option>
                        <option value="Nữ" <?= $sinhvien['GioiTinh'] == 'Nữ' ? 'selected' : '' ?>>Nữ</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Ngày Sinh:</label>
                    <input type="date" name="NgaySinh" class="form-control" value="<?= $sinhvien['NgaySinh'] ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Hình:</label>
                    <input type="text" name="Hinh" class="form-control" value="<?= htmlspecialchars($sinhvien['Hinh']) ?>">
                    <div class="mt-2">
                    <?php
                    $hinh = !empty($sinhvien['Hinh']) ? htmlspecialchars($sinhvien['Hinh']) : 'images/default.png';
                        ?>


                        <img src="http://localhost:90/SANGT6/buoi7_ktra/<?= $hinh ?>" 
                                alt="Ảnh sinh viên" 
                                class="img-thumbnail" 
                                width="150">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mã Ngành:</label>
                    <input type="text" name="MaNganh" class="form-control" value="<?= htmlspecialchars($sinhvien['MaNganh']) ?>" required>
                </div>

                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary">💾 Lưu</button>
                    <a href="index.php" class="btn btn-secondary">⬅️ Quay Lại</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
