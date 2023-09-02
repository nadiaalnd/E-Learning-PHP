<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
        <div class="sidebar-brand-icon">
            <img src="/assets/img/penswhite.png" style="max-width:50px;" alt="Pens Logo White">
        </div>
        <div class="sidebar-brand-text mx-3">
            <?= APP_NAME ?>
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <?php if (session()->get('user')['role'] == 'dosen') : ?>
        <div class="sidebar-heading">
            Dosen Menu
        </div>
        <li class="nav-item">
            <a href="/dosen/matkul" class="nav-link">
                <i class="fas fa-book"></i>
                <span>Mata Kuliah</span>
            </a>
        </li>
    <?php endif; ?>
    <?php if (session()->get('user')['role'] == 'mahasiswa') : ?>
        <div class="sidebar-heading">
            Mahasiswa Menu
        </div>
        <li class="nav-item">
            <a href="/mahasiswa/matkul" class="nav-link">
                <i class="fas fa-book"></i>
                <span>Mata Kuliah</span>
            </a>
        </li>
    <?php endif; ?>
    <?php if (session()->get('user')['role'] == 'admin') : ?>
        <div class="sidebar-heading">
            Admin Menu
        </div>

        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="/admin/manage-user">
                <i class="fas fa-users"></i>
                <span>Users Management</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/admin/matkul">
                <i class="fas fa-book"></i>
                <span>Mata Kuliah Management</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/admin/enroll">
                <i class="fas fa-book"></i>
                <span>Enroll Management</span></a>
        </li>
    <?php endif ?>
    <li class="nav-item">
        <a class="nav-link" href="/logout">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>
</ul>