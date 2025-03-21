<?php
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../../controllers/SinhvienController.php';

if (!isset($_SESSION['MaSV'])) {
    header("Location: ../../auth/login.php");
    exit();
}

// Xử lý dữ liệu khi form được submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller = new SinhvienController();
    $data = [
        'MaSV' => $_POST['MaSV'],
        'HoTen' => $_POST['HoTen'],
        'GioiTinh' => $_POST['GioiTinh'],
        'NgaySinh' => $_POST['NgaySinh'],
        'Hinh' => $_POST['Hinh'],
        'MaNganh' => $_POST['MaNganh']
    ];
    $controller->create($data);
    header("Location: index.php"); // Chuyển hướng sau khi thêm thành công
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sinh Viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow p-4">
            <h2 class="text-center text-primary">📌 Thêm Sinh Viên</h2>
            
            <form method="POST" action="create.php">
                <div class="mb-3">
                    <label class="form-label">Mã SV:</label>
                    <input type="text" name="MaSV" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Họ Tên:</label>
                    <input type="text" name="HoTen" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Giới Tính:</label>
                    <select name="GioiTinh" class="form-select">
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Ngày Sinh:</label>
                    <input type="date" name="NgaySinh" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Hình ảnh:</label>
                    <input type="text" name="Hinh" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mã Ngành:</label>
                    <input type="text" name="MaNganh" class="form-control" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success">✅ Thêm Sinh Viên</button>
                    <a href="index.php" class="btn btn-secondary">⬅ Quay Lại</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
