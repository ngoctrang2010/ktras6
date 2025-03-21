<?php
class Database {
    private static $instance = null;
    private $conn;
    private $DB_HOST = "localhost";
    private $DB_NAME = "test1";
    private $DB_USER = "root";
    private $DB_PASS = "";

    private function __construct() {
        try {
            $this->conn = new PDO(
                "mysql:host={$this->DB_HOST};dbname={$this->DB_NAME};charset=utf8",
                $this->DB_USER,
                $this->DB_PASS,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        } catch (PDOException $e) {
            die("Lỗi kết nối DB: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>
