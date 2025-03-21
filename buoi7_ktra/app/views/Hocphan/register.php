<?php
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../../config/Database.php';
session_start();

// Hiển thị lỗi (chỉ bật khi dev)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Kiểm tra đăng nhập
if (!isset($_SESSION['MaSV'])) {
    die('<div class="alert alert-danger text-center">Bạn cần đăng nhập để đăng ký học phần!</div>');
}

// Kiểm tra mã học phần
if (!isset($_GET['MaHP'])) {
    die('<div class="alert alert-warning text-center">Thiếu mã học phần!</div>');
}

$maSV = $_SESSION['MaSV'];
$maHP = $_GET['MaHP'];

try {
    $db = Database::getInstance()->getConnection();

    // Kiểm tra nếu sinh viên đã đăng ký môn này
    $checkStmt = $db->prepare("
        SELECT 1 FROM ChiTietDangKy 
        WHERE MaHP = ? AND MaDK IN (SELECT MaDK FROM DangKy WHERE MaSV = ?)
    ");
    $checkStmt->execute([$maHP, $maSV]);

    if ($checkStmt->rowCount() > 0) {
        throw new Exception("⚠️ Bạn đã đăng ký học phần này rồi!");
    }

    // Tạo hoặc cập nhật `DangKy`
    $stmt = $db->prepare("
        INSERT INTO DangKy (NgayDK, MaSV) 
        VALUES (NOW(), ?) 
        ON DUPLICATE KEY UPDATE NgayDK = NOW()
    ");
    $stmt->execute([$maSV]);

    // Lấy `MaDK`
    $maDK = $db->lastInsertId();
    if (!$maDK) {
        $stmt = $db->prepare("SELECT MaDK FROM DangKy WHERE MaSV = ?");
        $stmt->execute([$maSV]);
        $maDK = $stmt->fetchColumn();
    }

    if (!$maDK) {
        throw new Exception("❌ Lỗi khi lấy MaDK!");
    }

    // Thêm vào bảng `ChiTietDangKy`
    $stmt = $db->prepare("INSERT INTO ChiTietDangKy (MaDK, MaHP) VALUES (?, ?)");
    if ($stmt->execute([$maDK, $maHP])) {
        $message = '<div class="alert alert-success text-center">✅ Đăng ký học phần thành công!</div>';
    } else {
        throw new Exception("❌ Lỗi khi đăng ký học phần!");
    }
} catch (Exception $e) {
    $message = '<div class="alert alert-danger text-center">' . $e->getMessage() . '</div>';
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Học Phần</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="text-center">
        <?= $message ?>
        <a href="index.php" class="btn btn-primary mt-3">🔙 Quay lại</a>
    </div>
</body>
</html>
