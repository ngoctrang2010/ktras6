<?php
require_once __DIR__ . '/../config/Database.php';

class Sinhvien {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM SinhVien");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($maSV) {
        $stmt = $this->conn->prepare("SELECT * FROM SinhVien WHERE MaSV = ?");
        $stmt->execute([$maSV]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh) {
        $stmt = $this->conn->prepare("INSERT INTO SinhVien VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh]);
    }

    public function update($MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh) {
        $stmt = $this->conn->prepare("UPDATE SinhVien SET HoTen = ?, GioiTinh = ?, NgaySinh = ?, Hinh = ?, MaNganh = ? WHERE MaSV = ?");
        return $stmt->execute([$HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh, $MaSV]);
    }

    public function delete($MaSV) {
        $stmt = $this->conn->prepare("DELETE FROM SinhVien WHERE MaSV = ?");
        return $stmt->execute([$MaSV]);
    }
    
}
?>
