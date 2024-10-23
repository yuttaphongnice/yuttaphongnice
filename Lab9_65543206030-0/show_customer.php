<?php
session_start();

// ตรวจสอบว่าผู้ใช้ล็อกอินแล้วหรือยัง
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// ดึงข้อมูลชื่อผู้ใช้จากเซสชัน
$firstname = $_SESSION['Customer_Name'];
$lastname = $_SESSION['Customer_Lastname'];

echo "<p style='text-align: left;'>ชื่อผู้ใช้ : $firstname $lastname</p>";
echo "<p style='text-align: right;'><a href='logout.php' style='color: red;'>Log out</a></p>";
?>

<?php

echo "<p style='text-align: center;'>ข้อมูลลูกค้า</p>";
echo "<p style='text-align: right; color: red;'><a href='add_customer.php'><img src='3.png' alt='แก้ไข' style='width:16px; height:16px;'>เพิ่มข้อมูลลูกค้า</a></p>";

// เชื่อมต่อฐานข้อมูล
$conn = mysqli_connect("localhost", "root", "1234", "mystore");

// ตรวจสอบการเชื่อมต่อ
if (!$conn) {
    die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . mysqli_connect_error());
}

// คำสั่ง SQL ที่ถูกต้อง
$sql = "SELECT Customer_id, Customer_Name, Customer_Lastname, Province, Telephone FROM costomer WHERE status = 0";

// รันคำสั่ง SQL
$result = mysqli_query($conn, $sql);

// ตรวจสอบการดึงข้อมูล
if (mysqli_num_rows($result) > 0) {
    echo "<table style='margin: auto; border-collapse: collapse; width: 80%; border: 1px solid black;'>";
    echo "<tr style='background-color: #f2f2f2;'>
            <th style='border: 1px solid black; padding: 10px;'>ID</th>
            <th style='border: 1px solid black; padding: 10px;'>ชื่อ-นามสกุล</th>
            <th style='border: 1px solid black; padding: 10px;'>จังหวัด</th>
            <th style='border: 1px solid black; padding: 10px;'>โทรศัพท์</th>
            <th style='border: 1px solid black; padding: 10px;'>แก้ไข</th>
            <th style='border: 1px solid black; padding: 10px;'>ลบ</th>
          </tr>";

    // วนลูปเพื่อแสดงผลข้อมูล
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td style='border: 1px solid black; padding: 10px;'>".$row["Customer_id"]."</td>";
        echo "<td style='border: 1px solid black; padding: 10px;'>".$row["Customer_Name"]." ".$row["Customer_Lastname"]."</td>";
        echo "<td style='border: 1px solid black; padding: 10px;'>".$row["Province"]."</td>";
        echo "<td style='border: 1px solid black; padding: 10px;'>".$row["Telephone"]."</td>";
        
        // แก้ไขและลบลิงก์
        echo "<td style='border: 1px solid black; padding: 10px;'><a href='update_customer.php?id=".$row['Customer_id']."'><img src='0.png' alt='แก้ไข' style='width:16px; height:16px;'></a></td>";
        echo "<td style='border: 1px solid black; padding: 10px;'><a href='show_customer.php?id=".$row['Customer_id']."' onclick='return confirm(\"ต้องการลบลูกค้าคนนี้?\");'><img src='2.png' alt='ลบ' style='width:16px; height:16px;'></a></td>";
        echo "</tr>";
    }
    echo "</table>";
    mysqli_free_result($result);
} else {
    echo "ไม่มีข้อมูลลูกค้า";
}

// ปิดการเชื่อมต่อฐานข้อมูล
mysqli_close($conn);
?>

<?php 
// ฟังก์ชันการลบข้อมูลลูกค้า (soft delete)
$conn = mysqli_connect("localhost", "root", "1234", "mystore");

// ตรวจสอบการเชื่อมต่อ
if (!$conn) {
    die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $customer_id = $_GET['id'];

    // คำสั่ง SQL ที่ถูกต้องเพื่อเปลี่ยนสถานะเป็น 1 (ลบข้อมูล)
    $sql = "UPDATE costomer SET status = '1' WHERE Customer_id = '$customer_id'";

    if (mysqli_query($conn, $sql)) {
        echo "อัปเดตข้อมูลลูกค้าสำเร็จ!";
        header("Location: show_customer.php"); // การเปลี่ยนเส้นทางไปที่ show_customer.php
        exit(); // หยุดการทำงานหลังจาก redirect
    } else {
        echo "เกิดข้อผิดพลาด: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายชื่อลูกค้า</title>
</head>
<body>
    <!-- PHP code จะแสดงตารางที่นี่ -->
</body>
</html>
