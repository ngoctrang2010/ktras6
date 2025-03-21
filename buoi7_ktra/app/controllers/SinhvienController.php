<?php
require_once __DIR__ . '/../models/Sinhvien.php';

class SinhvienController {
    private $model;

    public function __construct() {
        $this->model = new Sinhvien();
    }

    public function index() {
        return $this->model->getAll();
    }

    public function detail($maSV) {
        return $this->model->findById($maSV);
    }

    public function create($data) {
        if ($this->model->insert(...array_values($data))) {
            header("Location: ../Sinhvien/index.php");
            exit();
            
        }
    }

    public function edit($maSV, $data) {
        if ($this->model->update($maSV, ...array_values($data))) {
            header("Location: index.php");
            exit();
            
        }
    }

    public function delete($maSV) {
        if ($this->model->delete($maSV)) {
            header("Location: ../Sinhvien/index.php");
            exit();

        }
    }
    public function login($MaSV) {
        return $this->model->findById($MaSV); // Gọi model để tìm sinh viên
    }
}
?>
