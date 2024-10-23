<?php
session_start();
session_destroy(); // ลบเซสชันทั้งหมด
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ออกจากระบบ</title>
</head>
<body>
    <p>ออกจากระบบแล้ว!! <a href="login.php">ลงชื่อเข้าใช้อีกครั้ง</a></p>
</body>
</html>
