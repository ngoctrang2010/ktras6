<?php
require_once '../config/Database.php';

class DangKy {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM DangKy");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($maDK) {
        $stmt = $this->conn->prepare("SELECT * FROM DangKy WHERE MaDK = ?");
        $stmt->execute([$maDK]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($ngayDK, $maSV) {
        $stmt = $this->conn->prepare("INSERT INTO DangKy (NgayDK, MaSV) VALUES (?, ?)");
        return $stmt->execute([$ngayDK, $maSV]);
    }
}
?>
