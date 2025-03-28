<?php

session_start();

// تنظیم charset به UTF-8
header('Content-Type: text/html; charset=utf-8');

// لود کردن فایل‌های اصلی
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/auth.php';
// در فایل init.php، بعد از require های موجود این خط را اضافه کنید
require_once __DIR__ . '/jdf.php';

// ایجاد نمونه از کلاس دیتابیس
$db = Database::getInstance();

// تنظیم error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// بررسی وضعیت لاگین کاربر
if (!isset($_SESSION['user_id']) && !in_array(basename($_SERVER['PHP_SELF']), ['login.php', 'register.php'])) {
    header('Location: login.php');
    exit;
}

// مقداردهی متغیرهای مورد نیاز
$auth = new Auth();
$user = $auth->getCurrentUser();
$lowStock = $db->query("SELECT COUNT(*) as total FROM products WHERE quantity <= min_quantity AND status = 'active'")->fetch()['total'];

// چک کردن زمان آخرین پاکسازی لیست مشتریان
$cleanupTime = $db->query("SELECT last_cleanup FROM customer_cleanup ORDER BY id DESC LIMIT 1")->fetchColumn();
$cleanupTime = new DateTime($cleanupTime);
$currentTime = new DateTime();
$interval = $currentTime->diff($cleanupTime);

// اگر بیشتر از یک روز گذشته باشد، لیست مشتریان را پاکسازی کنید
if ($interval->days >= 1) {
    try {
        $db->query("DELETE FROM customers WHERE 1");
        $db->query("INSERT INTO customer_cleanup (last_cleanup) VALUES (NOW())");
    } catch (Exception $e) {
        error_log("خطا در پاکسازی لیست مشتریان: " . $e->getMessage());
    }
}