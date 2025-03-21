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
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Sinh Viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow p-4">
            <h2 class="text-center text-primary">📌 Thông Tin Sinh Viên</h2>
            <table class="table table-bordered mt-3">
                <tr>
                    <th>Mã SV:</th>
                    <td><?= htmlspecialchars($sinhvien['MaSV']) ?></td>
                </tr>
                <tr>
                    <th>Họ Tên:</th>
                    <td><?= htmlspecialchars($sinhvien['HoTen']) ?></td>
                </tr>
                <tr>
                    <th>Giới Tính:</th>
                    <td><?= htmlspecialchars($sinhvien['GioiTinh']) ?></td>
                </tr>
                <tr>
                    <th>Ngày Sinh:</th>
                    <td><?= htmlspecialchars($sinhvien['NgaySinh']) ?></td>
                </tr>
                <tr>
                    <th>Hình:</th>
                    <?php
                    $hinh = !empty($sinhvien['Hinh']) ? htmlspecialchars($sinhvien['Hinh']) : 'images/default.png';
                        ?>

                        <td>
                            <img src="http://localhost:90/SANGT6/buoi7_ktra/<?= $hinh ?>" 
                                alt="Ảnh sinh viên" 
                                class="img-thumbnail" 
                                width="150">
                        </td>

                </tr>
                <tr>
                    <th>Mã Ngành:</th>
                    <td><?= htmlspecialchars($sinhvien['MaNganh']) ?></td>
                </tr>
            </table>
            <div class="text-center mt-3">
                <a href="index.php" class="btn btn-secondary">⬅️ Quay Lại</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
