<?php
define('BASE_PATH', __DIR__ . '/');
require_once 'Config/app.php';
// routing
require_once 'Helpers/Routing.php';
require 'vendor/autoload.php';
// set routing
$routing = new Routing();
$routing->set('/', 'AuthController', 'index', 'GET');
$routing->set('/login', 'AuthController', 'login', 'POST');
$routing->set('/logout', 'AuthController', 'logout', 'GET');
$routing->set('/dashboard', 'DashboardController', 'index', 'GET');

// Mahasiswa Routing
$routing->set('/mahasiswa/matkul', 'MahasiswaController', 'manage_matkul_index', 'GET');
$routing->set('/mahasiswa/matkul/materi/([0-9]+)', 'MahasiswaController', 'manage_matkul_materi', 'GET');
$routing->set('/mahasiswa/matkul/materi/download/([0-9]+)', 'MahasiswaController', 'manage_matkul_materi_download', 'GET');
$routing->set('/mahasiswa/matkul/tugas/([0-9]+)', 'MahasiswaController', 'manage_matkul_tugas', 'GET');
$routing->set('/mahasiswa/matkul/tugas/submit', 'MahasiswaController', 'manage_matkul_tugas_submit', 'POST');
$routing->set('/mahasiswa/matkul/tugas/download/([0-9]+)', 'MahasiswaController', 'manage_matkul_tugas_download', 'GET');

// Dosen Routing
$routing->set('/dosen/matkul', 'DosenController', 'manage_matkul_index', 'GET');
$routing->set('/dosen/matkul/materi/([0-9]+)', 'DosenController', 'manage_matkul_materi', 'GET');
$routing->set('/dosen/matkul/materi/create', 'DosenController', 'manage_matkul_materi_add', 'POST');
$routing->set('/dosen/matkul/materi/download/([0-9]+)', 'DosenController', 'manage_matkul_materi_download', 'GET');
$routing->set('/dosen/matkul/materi/edit/([0-9]+)', 'DosenController', 'manage_matkul_materi_edit', 'POST');
$routing->set('/dosen/matkul/materi/delete-materi/([0-9]+)', 'DosenController', 'manage_matkul_materi_delete', 'GET');

$routing->set('/dosen/matkul/tugas/([0-9]+)', 'DosenController', 'manage_matkul_tugas', 'GET');
$routing->set('/dosen/matkul/tugas/create', 'DosenController', 'manage_matkul_tugas_add', 'POST');
$routing->set('/dosen/matkul/tugas/edit/([0-9]+)', 'DosenController', 'manage_matkul_tugas_edit', 'POST');
$routing->set('/dosen/matkul/tugas/delete-tugas/([0-9]+)', 'DosenController', 'manage_matkul_tugas_delete', 'GET');
$routing->set('/dosen/matkul/tugas/submit/([0-9]+)', 'DosenController', 'manage_matkul_tugas_submit', 'GET');
$routing->set('/dosen/matkul/tugas/submit/nilai/([0-9]+)', 'DosenController', 'manage_matkul_tugas_submit_nilai', 'POST');
$routing->set('/dosen/matkul/tugas/download/([0-9]+)', 'DosenController', 'manage_matkul_tugas_download', 'GET');

// Admin Routing
$routing->set('/admin/manage-user', 'AdminController', 'manage_user_index', 'GET');
$routing->set('/admin/manage-user/create', 'AdminController', 'manage_user_add', 'POST');
$routing->set('/admin/manage-user/edit/([0-9]+)', 'AdminController', 'manage_user_edit', 'POST');
$routing->set('/admin/manage-user/delete-user/([0-9]+)', 'AdminController', 'manage_user_delete', 'GET');

$routing->set('/admin/matkul', 'AdminController', 'manage_matkul_index', 'GET');
$routing->set('/admin/matkul/create', 'AdminController', 'manage_matkul_add', 'POST');
$routing->set('/admin/matkul/edit/([0-9]+)', 'AdminController', 'manage_matkul_edit', 'POST');
$routing->set('/admin/matkul/delete-matkul/([0-9]+)', 'AdminController', 'manage_matkul_delete', 'GET');

$routing->set('/admin/enroll', 'AdminController', 'manage_enroll_index', 'GET');
$routing->set('/admin/enroll/create', 'AdminController', 'manage_enroll_add', 'POST');
$routing->set('/admin/enroll/edit/([0-9]+)', 'AdminController', 'manage_enroll_edit', 'POST');
$routing->set('/admin/enroll/delete-enroll/([0-9]+)', 'AdminController', 'manage_enroll_delete', 'GET');


$routing->run();
