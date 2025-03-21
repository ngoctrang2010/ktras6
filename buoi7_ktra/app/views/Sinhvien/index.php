<?php
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../../controllers/SinhvienController.php';

$controller = new SinhvienController();
$sinhviens = $controller->index();

if (!isset($_SESSION['MaSV'])) {
    header("Location: ../../auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Sinh Viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center text-primary">👨‍🎓 Danh Sách Sinh Viên</h2>

        <div class="text-end mb-3">
            <a href="create.php" class="btn btn-success">➕ Thêm Mới</a>
        </div>

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Mã SV</th>
                    <th>Họ Tên</th>
                    <th>Giới Tính</th>
                    <th>Hình sinh viên</th>
                    <th>Ngày Sinh</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sinhviens as $sv): ?>
                <tr>
                    <td><?= htmlspecialchars($sv['MaSV']) ?></td>
                    <td><?= htmlspecialchars($sv['HoTen']) ?></td>
                    <td><?= htmlspecialchars($sv['GioiTinh']) ?></td>
                    
                    <?php
                    // Đúng biến: sử dụng $sv thay vì $sinhvien
                    $hinh = !empty($sv['Hinh']) ? htmlspecialchars($sv['Hinh']) : 'images/default.png';
                    ?>

                    <td>
                        <img src="http://localhost:90/SANGT6/buoi7_ktra/<?= $hinh ?>" 
                            alt="Ảnh sinh viên" 
                            class="img-thumbnail" 
                            width="150">
                    </td>
                    <td><?= htmlspecialchars($sv['NgaySinh']) ?></td>
                    <td class="text-center">
                        <a href="detail.php?MaSV=<?= urlencode($sv['MaSV']) ?>" class="btn btn-info btn-sm">👁 Xem</a>
                        <a href="edit.php?MaSV=<?= urlencode($sv['MaSV']) ?>" class="btn btn-warning btn-sm">✏ Sửa</a>
                        <a href="delete.php?MaSV=<?= urlencode($sv['MaSV']) ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Bạn có chắc muốn xóa sinh viên này?');">
                            ❌ Xóa
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="text-center mt-3">
            <a href="./../../auth/logout.php" class="btn btn-secondary">⬅ Quay lại</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
