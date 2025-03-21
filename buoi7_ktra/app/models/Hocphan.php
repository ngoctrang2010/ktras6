<?php
require_once __DIR__ . '/../config/Database.php';




class Hocphan {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    // Lấy tất cả học phần
    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM HocPhan");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy thông tin học phần theo ID
    public function getById($maHP) {
        $stmt = $this->conn->prepare("SELECT * FROM HocPhan WHERE MaHP = ?");
        $stmt->execute([$maHP]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
