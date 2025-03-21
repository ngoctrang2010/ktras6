<?php
require_once '../config/Database.php';

class Nganhhoc {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM NganhHoc");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($maNganh) {
        $stmt = $this->conn->prepare("SELECT * FROM NganhHoc WHERE MaNganh = ?");
        $stmt->execute([$maNganh]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($maNganh, $tenNganh) {
        $stmt = $this->conn->prepare("INSERT INTO NganhHoc (MaNganh, TenNganh) VALUES (?, ?)");
        return $stmt->execute([$maNganh, $tenNganh]);
    }
}
?>
