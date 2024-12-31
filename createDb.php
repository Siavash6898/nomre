<?php
// اطلاعات اتصال به MySQL test7
$host = 'localhost'; // نام host
$username = 'root'; // نام کاربری MySQL
$password = 'a'; // رمز عبور MySQL
$dbname = 'my_new_database'; // نام دیتابیس مورد نظر

try {
    // اتصال به سرور MySQL
    $pdo = new PDO("mysql:host=$host", $username, $password);
    // تنظیمات PDO برای گزارش خطا
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // ساخت دیتابیس
    $sql = "CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
    $pdo->exec($sql);

    echo "Database '$dbname' created successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
