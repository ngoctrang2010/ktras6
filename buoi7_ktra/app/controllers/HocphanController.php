<?php
session_start();
require_once __DIR__ . '/../models/Hocphan.php';
require_once __DIR__ . '/../config/Database.php';

class HocphanController {
    private $model;

    public function __construct() {
        $this->model = new Hocphan();
    }

    // Hiển thị danh sách học phần
    public function index() {
        return $this->model->getAll();
    }

    // Xử lý đăng ký học phần
    public function register() {
        if (!isset($_SESSION['MaSV'])) {
            die("Bạn cần đăng nhập để đăng ký học phần!");
        }

        if (!isset($_GET['MaHP'])) {
            die("Thiếu mã học phần!");
        }

        $maSV = $_SESSION['MaSV'];
        $maHP = $_GET['MaHP'];
        $db = Database::getInstance()->getConnection();

        // Kiểm tra nếu sinh viên đã đăng ký môn này chưa
        $checkStmt = $db->prepare("SELECT * FROM ChiTietDangKy WHERE MaHP = ? AND MaDK IN (SELECT MaDK FROM DangKy WHERE MaSV = ?)");
        $checkStmt->execute([$maHP, $maSV]);

        if ($checkStmt->rowCount() > 0) {
            die("Bạn đã đăng ký học phần này rồi!");
        }

        // Kiểm tra hoặc tạo bản ghi `DangKy`
        $stmt = $db->prepare("INSERT INTO DangKy (NgayDK, MaSV) VALUES (NOW(), ?) ON DUPLICATE KEY UPDATE NgayDK = NOW()");
        $stmt->execute([$maSV]);

        // Lấy `MaDK`
        $maDK = $db->lastInsertId();
        if (!$maDK) {
            $stmt = $db->prepare("SELECT MaDK FROM DangKy WHERE MaSV = ?");
            $stmt->execute([$maSV]);
            $maDK = $stmt->fetchColumn();
        }

        if (!$maDK) {
            die("Lỗi khi lấy MaDK!");
        }

        // Thêm vào bảng `ChiTietDangKy`
        $stmt = $db->prepare("INSERT INTO ChiTietDangKy (MaDK, MaHP) VALUES (?, ?)");
        if ($stmt->execute([$maDK, $maHP])) {
            header("Location: ../views/Hocphan/registered_courses.php");
            exit();
        } else {
            die("Lỗi khi đăng ký học phần!");
        }
    }

    // Xóa một học phần khỏi danh sách đăng ký
    public function remove() {
        if (!isset($_SESSION['MaSV'])) {
            die("Bạn cần đăng nhập!");
        }
    
        if (!isset($_GET['MaHP'])) {
            die("Thiếu mã học phần!");
        }
    
        $maSV = $_SESSION['MaSV'];
        $maHP = $_GET['MaHP'];
        $db = Database::getInstance()->getConnection();
    
        // Xóa học phần đã đăng ký
        $stmt = $db->prepare("
            DELETE FROM ChiTietDangKy 
            WHERE MaHP = ? 
            AND MaDK IN (SELECT MaDK FROM DangKy WHERE MaSV = ?)
        ");
        
        if ($stmt->execute([$maHP, $maSV])) {
            header("Location: ../views/Hocphan/registered_courses.php");
            exit();
        } else {
            die("❌ Lỗi khi hủy học phần!");
        }
    }
    
    // Xóa toàn bộ học phần đã đăng ký
    public function clear() {
        if (!isset($_SESSION['MaSV'])) {
            die("Bạn cần đăng nhập!");
        }

        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("DELETE FROM ChiTietDangKy WHERE MaDK IN (SELECT MaDK FROM DangKy WHERE MaSV = ?)");
        $stmt->execute([$_SESSION['MaSV']]);

        header("Location: ../views/Hocphan/registered_courses.php");
        exit();
    }
}

// Kiểm tra URL để gọi đúng phương thức
if (isset($_GET['action'])) {
    $controller = new HocphanController();

    switch ($_GET['action']) {
        case 'register':
            $controller->register();
            break;
        case 'remove':
            $controller->remove();
            break;
        case 'clear':
            $controller->clear();
            break;
        default:
            die("Hành động không hợp lệ!");
    }
}
