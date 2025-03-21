
<!-- Thanh menu -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/index.php">🎓 Quản Lý Sinh Viên</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="sinhvienDropdown" role="button" data-bs-toggle="dropdown">
                        👨‍🎓 Sinh Viên
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="./../Sinhvien/index.php">Danh Sách</a></li>
                        <li><a class="dropdown-item" href="./../Sinhvien/create.php">Thêm Sinh Viên</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="hocphanDropdown" role="button" data-bs-toggle="dropdown">
                        📚 Học Phần
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="./../Hocphan/index.php">Danh Sách</a></li>
                        <li><a class="dropdown-item" href="./../Hocphan/registered_courses.php">Học Phần Đã Đăng Ký</a></li>
                    </ul>
                </li>
            </ul>

            <ul class="navbar-nav">
                <?php if (isset($_SESSION['MaSV'])): ?>
                    <li class="nav-item">
                        <span class="nav-link text-light">👋 Xin chào, <?= htmlspecialchars($_SESSION['MaSV']) ?></span>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-danger btn-sm" href="./../../auth/logout.php">🚪 Đăng Xuất</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="btn btn-success btn-sm" href="./../../auth/login.php">🔑 Đăng Nhập</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
