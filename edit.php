<?php
// 1. เชื่อมต่อฐานข้อมูล
$conn = new mysqli("localhost", "root", "", "student_db");

// 2. ส่วนของการดึงข้อมูลเก่ามาโชว์ในฟอร์ม
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $res = $conn->query("SELECT * FROM students WHERE id = $id");
    $data = $res->fetch_assoc();
}

// 3. ส่วนของการบันทึกข้อมูลเมื่อมีการกดปุ่ม Save
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id    = $_POST['id'];
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "UPDATE students SET name='$name', email='$email', phone='$phone' WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: list.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <style>
        body { font-family: Arial; margin: 40px; line-height: 1.6; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; }
        input { width: 300px; padding: 8px; border: 1px solid #ccc; }
        .btn-save { background: #28a745; color: white; padding: 10px 20px; border: none; cursor: pointer; }
        .btn-cancel { color: #666; text-decoration: none; margin-left: 10px; }
    </style>
</head>
<body>

<h2>✏️ Edit Student Information</h2>

<form method="post">
    <input type="hidden" name="id" value="<?= $data['id'] ?>">

    <div class="form-group">
        <label>Name:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($data['name']) ?>" required>
    </div>

    <div class="form-group">
        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($data['email']) ?>">
    </div>

    <div class="form-group">
        <label>Phone:</label>
        <input type="text" name="phone" value="<?= htmlspecialchars($data['phone']) ?>">
    </div>

    <button type="submit" class="btn-save">Save Changes</button>
    <a href="list.php" class="btn-cancel">Cancel</a>
</form>

</body>
</html>