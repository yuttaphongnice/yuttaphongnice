<?php
// index2.php

// ฟังก์ชันที่สร้างขึ้นเองเพื่อแสดงข้อมูล
function displayUserInfo($userInfo) {
    foreach ($userInfo as $key => $value) {
        echo "<p>$key: $value</p>";
    }
}

// รับข้อมูลจากฟอร์ม
$userInfo = [
    'ชื่อ-สกุล' => $_POST['first-name'] . ' ' . $_POST['last-name'],
    'เพศ' => $_POST['gender'],
    'วันเกิด' => $_POST['day'] . '/' . $_POST['month'] . '/' . ($_POST['year'] - 543), // แสดงเป็น ค.ศ.
    'Username' => $_POST['username'],
    'Password' => $_POST['password'],
    'E-mail' => $_POST['email'],
];

// ฟังก์ชันแสดงวันที่และเวลาในรูปแบบที่ละเอียด
function getCurrentDateTime() {
    date_default_timezone_set('Asia/Bangkok'); // ตั้งโซนเวลาให้ถูกต้อง
    return date('l, d F Y h:i:s A'); // ตัวอย่าง: Sunday, 07 October 2024 04:15:23 PM
}

// แสดงข้อมูลผู้ใช้
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Info</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #2c2c2c;
            color: #f1f1f1;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
            margin: 0;
        }

        .info-container {
            background-color: #3c3c3c;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        p {
            font-size: 18px;
            margin: 5px 0;
        }
    </style>
</head>
<body>

<div class="info-container">
    <h1>User Information</h1>
    <?php displayUserInfo($userInfo); ?>
    <p>วันที่ลงทะเบียน: <?php echo getCurrentDateTime(); ?></p>
</div>

</body>
</html>
