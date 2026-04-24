<?php
$conn = new mysqli("localhost", "root", "", "student_db");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "INSERT INTO students (name, email, phone) VALUES ('$name', '$email', '$phone')";
    if ($conn->query($sql) === TRUE) {
        header("Location: list.php"); // เพิ่มเสร็จแล้วเด้งกลับหน้าหลัก
    }
}
?>

<form method="post">
    Name: <input type="text" name="name" required><br>
    Email: <input type="email" name="email"><br>
    Phone: <input type="text" name="phone"><br>
    <button type="submit">Save</button>
</form>