<?php
require_once '../config/Database.php';

class ChiTietDangKy {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM ChiTietDangKy");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByDangKy($maDK) {
        $stmt = $this->conn->prepare("SELECT * FROM ChiTietDangKy WHERE MaDK = ?");
        $stmt->execute([$maDK]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($maDK, $maHP) {
        $stmt = $this->conn->prepare("INSERT INTO ChiTietDangKy (MaDK, MaHP) VALUES (?, ?)");
        return $stmt->execute([$maDK, $maHP]);
    }
}
?>
