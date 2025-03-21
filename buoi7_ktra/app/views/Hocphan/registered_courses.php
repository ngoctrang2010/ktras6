<?php
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../../config/Database.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Kiểm tra đăng nhập
if (!isset($_SESSION['MaSV'])) {
    die('<div class="alert alert-danger text-center">⚠️ Bạn cần đăng nhập để xem học phần đã đăng ký!</div>');
}

$maSV = $_SESSION['MaSV'];
$db = Database::getInstance()->getConnection();

// Lấy danh sách học phần đã đăng ký
$query = "
    SELECT hp.MaHP, hp.TenHP, hp.SoTinChi 
    FROM ChiTietDangKy ctdk
    JOIN DangKy dk ON ctdk.MaDK = dk.MaDK
    JOIN HocPhan hp ON ctdk.MaHP = hp.MaHP
    WHERE dk.MaSV = ?
";
$stmt = $db->prepare($query);
$stmt->execute([$maSV]);
$registeredCourses = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Học Phần Đã Đăng Ký</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center text-primary">📖 Học Phần Đã Đăng Ký</h2>

        <?php if (empty($registeredCourses)): ?>
            <div class="alert alert-warning text-center mt-4">❌ Bạn chưa đăng ký học phần nào.</div>
        <?php else: ?>
            <table class="table table-bordered table-hover mt-4">
                <thead class="table-dark">
                    <tr>
                        <th>Mã Học Phần</th>
                        <th>Tên Học Phần</th>
                        <th>Số Tín Chỉ</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($registeredCourses as $hp): ?>
                    <tr>
                        <td><?= htmlspecialchars($hp['MaHP']) ?></td>
                        <td><?= htmlspecialchars($hp['TenHP']) ?></td>
                        <td><?= htmlspecialchars($hp['SoTinChi']) ?></td>
                        <td class="text-center">
                            <a href="../../controllers/HocphanController.php?action=remove&MaHP=<?= urlencode($hp['MaHP']) ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Bạn có chắc chắn muốn hủy học phần này?');">
                                ❌ Hủy
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-secondary">⬅️ Quay lại</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
