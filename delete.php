<?php
// 1. เชื่อมต่อฐานข้อมูล
$host = "localhost";
$user = "root";
$pass = "";
$db   = "student_db";

$conn = new mysqli($host, $user, $pass, $db);

// เช็คการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 2. รับค่า ID ที่ต้องการลบจาก URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // 3. สร้างคำสั่ง SQL สำหรับลบข้อมูล
    $sql = "DELETE FROM students WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // ลบสำเร็จ ให้เด้งกลับไปหน้า list.php
        header("Location: list.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>